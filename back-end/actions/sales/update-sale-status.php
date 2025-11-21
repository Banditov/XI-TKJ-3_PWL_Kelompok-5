<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $order_id = $data['order_id'] ?? null;
    $new_act = $data['act'] ?? null;

    if (!$order_id || !$new_act) {
        echo json_encode(['success' => false, 'message' => 'Order ID and status are required']);
        exit;
    }

    $statusMap = [
        'completed' => ['status' => 'Completed', 'act' => 'Completed'],
        'notReady' => ['status' => 'Pending', 'act' => 'Not Ready'],
        'ready' => ['status' => 'Pending', 'act' => 'Ready'],
        'cancelled' => ['status' => 'Cancelled', 'act' => 'Cancelled']
    ];

    if (!isset($statusMap[$new_act])) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }

    $statusData = $statusMap[$new_act];

    try {
        $stmt = $pdo->prepare("
            UPDATE orders 
            SET status = ?, act = ? 
            WHERE id = ?
        ");
        $stmt->execute([$statusData['status'], $statusData['act'], $order_id]);
        
        echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        
    } catch (PDOException $e) {
        error_log("Update order status error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
?>