<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
    require_once __DIR__ . '/../../config/db-connection.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

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

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Order ID is required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            SELECT id FROM orders 
            WHERE id = ? AND customer_id = ? AND act = 'Not Ready'
        ");
        $stmt->execute([$order_id, $user_id]);
        $order = $stmt->fetch();

        if (!$order) {
            echo json_encode(['success' => false, 'message' => 'Order not found or cannot be cancelled']);
            exit;
        }

        $stmt = $pdo->prepare("
            UPDATE orders 
            SET status = 'Cancelled', act = 'Cancelled' 
            WHERE id = ?
        ");
        $stmt->execute([$order_id]);

        echo json_encode(['success' => true, 'message' => 'Order cancelled successfully']);

    } catch (PDOException $e) {
        error_log("Cancel order error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
?>