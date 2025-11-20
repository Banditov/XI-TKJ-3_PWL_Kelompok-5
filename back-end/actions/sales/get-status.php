<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
    require_once __DIR__ . '/../../config/db-connection.php';

    if (isset($_SESSION['accounts']['id'])) {
        $user_id = $_SESSION['accounts']['id'];
    } elseif (isset($_SESSION['user']['id'])) {
        $user_id = $_SESSION['user']['id'];
    } elseif (isset($_SESSION['accounts']) && is_numeric($_SESSION['accounts'])) {
        $user_id = $_SESSION['accounts'];
    } elseif (isset($_SESSION['user']) && is_numeric($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    } else {
        echo "
            <script>
                alert('Session error. Please log in again.');
                window.location.href = '/front-end/pages/login/index.php';
            </script>
        ";
        exit;
    }

    $orders = [];

    try {
        $stmt = $pdo->prepare("
            SELECT o.*, 
                GROUP_CONCAT(CONCAT(p.product_name, ' (', s.quantity, 'x)') SEPARATOR ', ') as items,
                COUNT(s.id) as item_count
            FROM orders o 
            LEFT JOIN sales s ON o.id = s.order_id 
            LEFT JOIN products p ON s.product_id = p.id 
            WHERE o.customer_id = ? AND o.isnt_shown = 0
            GROUP BY o.id 
            ORDER BY o.order_date DESC, o.id DESC
        ");
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
?>