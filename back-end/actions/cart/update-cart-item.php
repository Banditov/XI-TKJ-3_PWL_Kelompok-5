<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    session_start();

    header('Content-Type: application/json');

    if (isset($_SESSION['accounts'])) {
        $user_id = $_SESSION['accounts']['id'];
    } else if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $cart_item_id = isset($input['cart_item_id']) ? intval($input['cart_item_id']) : null;
    $quantity = isset($input['quantity']) ? intval($input['quantity']) : null;

    try {
        $pdo = Database::getPDO();

        $productQuery = "
            SELECT p.price, p.stock, p.product_name, ci.quantity as current_quantity 
            FROM cart_items ci 
            JOIN products p ON ci.product_id = p.id 
            WHERE ci.id = ? AND ci.account_id = ?
        ";
        $productStmt = $pdo->prepare($productQuery);
        $productStmt->execute([$cart_item_id, $user_id]);
        $product = $productStmt->fetch();

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Cart item not found or access denied.']);
            exit;
        }

        if ($product['stock'] < $quantity) {
            echo json_encode([
                'success' => false, 
                'message' => 'Only ' . $product['stock'] . ' items available for ' . $product['product_name']
            ]);
            exit;
        }

        $updateQuery = "UPDATE cart_items SET quantity = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([$quantity, $cart_item_id]);

        $new_total = $product['price'] * $quantity;

        $totalQuery = "
            SELECT SUM(p.price * ci.quantity) as grand_total 
            FROM cart_items ci 
            JOIN products p ON ci.product_id = p.id 
            WHERE ci.account_id = ?
        ";
        $totalStmt = $pdo->prepare($totalQuery);
        $totalStmt->execute([$user_id]);
        $totalResult = $totalStmt->fetch();
        $new_grand_total = $totalResult['grand_total'] ?? 0;

        echo json_encode([
            'success' => true, 
            'message' => 'Quantity updated successfully',
            'new_total' => $new_total,
            'new_grand_total' => $new_grand_total,
            'item_price' => $product['price']
        ]);

    } catch (Exception $e) {
        error_log("Update cart item error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
    }
?>