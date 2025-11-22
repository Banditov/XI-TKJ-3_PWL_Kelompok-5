<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    session_start();

    header('Content-Type: application/json');

    $user_id = null;
    if (isset($_SESSION['accounts']['id'])) {
        $user_id = $_SESSION['accounts']['id'];
    } elseif (isset($_SESSION['user']['id'])) {
        $user_id = $_SESSION['user']['id'];
    }

    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User not authenticated']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as ready_count 
            FROM orders 
            WHERE customer_id = ? AND act = 'Ready' AND isnt_shown = 0
        ");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();
        
        echo json_encode([
            'success' => true,
            'has_ready_orders' => ($result['ready_count'] > 0),
            'ready_count' => (int)$result['ready_count']
        ]);
        
    } catch (PDOException $e) {
        error_log("Check ready orders error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
?>