<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $order_id = $data['order_id'] ?? null;
    $new_act = $data['act'] ?? null;

    $statusMap = [
        'completed' => ['status' => 'Completed', 'act' => 'Completed'],
        'notReady' => ['status' => 'Pending', 'act' => 'Not Ready'],
        'ready' => ['status' => 'Pending', 'act' => 'Ready'],
        'cancelled' => ['status' => 'Cancelled', 'act' => 'Cancelled']
    ];

    $statusData = $statusMap[$new_act];

    try {
        if ($new_act === 'cancelled') {
            $stmt = $pdo->prepare("SELECT act FROM orders WHERE id = ?");
            $stmt->execute([$order_id]);
            $current_order = $stmt->fetch();

            if ($current_order && $current_order['act'] !== 'Cancelled') {
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
            }
        }

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