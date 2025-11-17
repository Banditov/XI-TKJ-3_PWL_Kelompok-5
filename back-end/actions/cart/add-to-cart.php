<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    session_start();

    header('Content-Type: application/json');

    if (!isset($_SESSION['accounts']) && !isset($_SESSION['user'])) {
        echo json_encode(['success' => false, 'message' => 'Please log in first.']);
        exit;
    }

    if (isset($_SESSION['accounts'])) {
        $user_id = $_SESSION['accounts']['id'];
    } else if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found in session.']);
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $product_id = isset($input['product_id']) ? intval($input['product_id']) : null;
    $color = isset($input['color']) ? $input['color'] : 'None';
    $quantity = isset($input['quantity']) ? intval($input['quantity']) : 1;

    if (!$product_id || $product_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID.']);
        exit;
    }

    if ($quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid quantity.']);
        exit;
    }

    try {
        $pdo = Database::getPDO();
        
        $productQuery = "SELECT id, stock, product_name, price FROM products WHERE product_id = ? AND color = ?";
        $productStmt = $pdo->prepare($productQuery);
        $productStmt->execute([$product_id, $color]);
        $product = $productStmt->fetch();

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Product not found for the selected color.']);
            exit;
        }

        if ($product['stock'] < $quantity) {
            echo json_encode([
                'success' => false, 
                'message' => 'Insufficient stock. Only ' . $product['stock'] . ' items available for ' . $product['product_name']
            ]);
            exit;
        }

        $checkQuery = "SELECT id, quantity FROM cart_items WHERE account_id = ? AND product_id = ?";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$user_id, $product['id']]);
        $existingItem = $checkStmt->fetch();

        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + $quantity;
            
            if ($product['stock'] < $newQuantity) {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Cannot add more than available stock. You already have ' . $existingItem['quantity'] . ' in cart.'
                ]);
                exit;
            }
            
            $updateQuery = "UPDATE cart_items SET quantity = ? WHERE id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$newQuantity, $existingItem['id']]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Cart updated successfully',
                'product_name' => $product['product_name'],
                'color' => $color,
                'quantity' => $newQuantity,
                'action' => 'updated'
            ]);
        } else {
            $insertQuery = "INSERT INTO cart_items (account_id, product_id, quantity) VALUES (?, ?, ?)";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->execute([$user_id, $product['id'], $quantity]);
            
            $cart_item_id = $pdo->lastInsertId();
            
            echo json_encode([
                'success' => true, 
                'message' => 'Item added to cart successfully',
                'product_name' => $product['product_name'],
                'color' => $color,
                'quantity' => $quantity,
                'cart_item_id' => $cart_item_id,
                'action' => 'added'
            ]);
        }
        
    } catch (PDOException $e) {
        error_log("Database error in add-to-cart: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred. Please try again.']);
    } catch (Exception $e) {
        error_log("General error in add-to-cart: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An unexpected error occurred.']);
    }
?>