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

    if (!$product_id) {
        echo json_encode(['success' => false, 'message' => 'Product ID is required.']);
        exit;
    }

    try {
        $productQuery = "SELECT id, stock, product_name FROM products WHERE product_id = ? AND color = ?";
        $productStmt = $pdo->prepare($productQuery);
        $productStmt->execute([$product_id, $color]);
        $product = $productStmt->fetch();

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Product not found.']);
            exit;
        }

        if ($product['stock'] < $quantity) {
            echo json_encode(['success' => false, 'message' => 'Insufficient stock for ' . $product['product_name']]);
            exit;
        }

        $checkQuery = "SELECT id, quantity FROM cart_items WHERE account_id = ? AND product_id = ?";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$user_id, $product['id']]);
        $existingItem = $checkStmt->fetch();

        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + $quantity;
            
            if ($product['stock'] < $newQuantity) {
                echo json_encode(['success' => false, 'message' => 'Cannot add more than available stock for ' . $product['product_name']]);
                exit;
            }
            
            $updateQuery = "UPDATE cart_items SET quantity = ? WHERE id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$newQuantity, $existingItem['id']]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Cart updated successfully',
                'product_name' => $product['product_name'],
                'color' => $color
            ]);
        } else {
            $insertQuery = "INSERT INTO cart_items (account_id, product_id, quantity) VALUES (?, ?, ?)";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->execute([$user_id, $product['id'], $quantity]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Item added to cart successfully',
                'product_name' => $product['product_name'],
                'color' => $color
            ]);
        }
        
    } catch (Exception $e) {
        error_log("Cart error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
    }
?>