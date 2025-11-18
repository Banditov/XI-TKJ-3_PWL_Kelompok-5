<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    if (isset($_SESSION['accounts']['id'])) {
        $user_id = $_SESSION['accounts']['id'];
    } else if (isset($_SESSION['user']['id'])) {
        $user_id = $_SESSION['user']['id'];
    } else {
        header('Location: /front-end/pages/login/index.php');
        exit;
    }

    $orders = [];
    $searchTerm = '';

    try {
        $pdo = Database::getPDO();

        $query = "
            SELECT 
                o.id as order_id,
                o.order_number,
                o.total_amount,
                o.order_date,
                o.status,
                GROUP_CONCAT(CONCAT(
                    p.product_name, 
                    CASE WHEN p.color != 'None' THEN CONCAT(' - ', p.color) ELSE '' END,
                    ' (', s.quantity, 'x)'
                ) SEPARATOR ';;') as products
            FROM orders o
            LEFT JOIN sales s ON o.id = s.order_id
            LEFT JOIN products p ON s.product_id = p.id
            WHERE o.customer_id = ?
        ";

        $params = [$user_id];

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $query .= " AND (o.order_number LIKE ? OR p.product_name LIKE ?)";
            $searchParam = "%$searchTerm%";
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        $query .= " GROUP BY o.id ORDER BY o.order_date DESC, o.id DESC";

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $orders = $stmt->fetchAll();

    } catch (Exception $e) {
        error_log("History page error: " . $e->getMessage());
        $error = "Unable to load order history. Please try again.";
    }
?>