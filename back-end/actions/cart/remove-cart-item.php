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

    try {
        $pdo = Database::getPDO();

        $verifyQuery = "SELECT id FROM cart_items WHERE id = ? AND account_id = ?";
        $verifyStmt = $pdo->prepare($verifyQuery);
        $verifyStmt->execute([$cart_item_id, $user_id]);
        $cartItem = $verifyStmt->fetch();

        if (!$cartItem) {
            echo json_encode(['success' => false, 'message' => 'Cart item not found or access denied.']);
            exit;
        }

        $deleteQuery = "DELETE FROM cart_items WHERE id = ?";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->execute([$cart_item_id]);

        echo json_encode([
            'success' => true, 
            'message' => 'Item removed from cart successfully'
        ]);

    } catch (Exception $e) {
        error_log("Remove cart item error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
    }
?>