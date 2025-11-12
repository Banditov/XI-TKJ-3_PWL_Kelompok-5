<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    session_start();

    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $cart_item_id = isset($input['cart_item_id']) ? intval($input['cart_item_id']) : null;

    if (!$cart_item_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid cart item ID.']);
        exit;
    }

    try {
        $query = "DELETE FROM cart_items WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$cart_item_id]);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Item removed from cart successfully'
        ]);
        
    } catch (Exception $e) {
        error_log("Remove cart item error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
    }
?>