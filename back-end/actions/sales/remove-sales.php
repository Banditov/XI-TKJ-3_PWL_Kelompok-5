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

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Order ID is required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            UPDATE orders 
            SET isnt_shown = 1 
            WHERE id = ?
        ");
        $stmt->execute([$order_id]);

        echo json_encode(['success' => true, 'message' => 'Order removed successfully']);

    } catch (PDOException $e) {
        error_log("Remove order error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
?>