<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    session_start();

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $order_id = $data['order_id'] ?? null;

    if (isset($_SESSION['accounts']['id'])) {
        $user_id = $_SESSION['accounts']['id'];
    } elseif (isset($_SESSION['user']['id'])) {
        $user_id = $_SESSION['user']['id'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User not authenticated']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            SELECT id FROM orders 
            WHERE id = ? AND customer_id = ? AND act = 'Not Ready'
        ");
        $stmt->execute([$order_id, $user_id]);
        $order = $stmt->fetch();

        if (!$order) {
            throw new Exception('Order not found or cannot be cancelled');
        }

        $stmt = $pdo->prepare("
            SELECT product_id, quantity 
            FROM sales 
            WHERE order_id = ?
        ");
        $stmt->execute([$order_id]);
        $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($order_items as $item) {
            $stmt = $pdo->prepare("
                UPDATE products 
                SET stock = stock + ? 
                WHERE id = ?
            ");
            $stmt->execute([$item['quantity'], $item['product_id']]);
        }

        $stmt = $pdo->prepare("
            UPDATE orders 
            SET status = 'Cancelled', act = 'Cancelled' 
            WHERE id = ?
        ");
        $stmt->execute([$order_id]);

        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Order cancelled successfully and stock restored']);

    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Cancel order error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
?>