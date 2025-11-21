<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $searchTerm = $_GET['search'] ?? '';
    $orders = [];

    try {
        $query = "
            SELECT 
                o.id as order_id,
                o.order_number,
                o.customer_id,
                o.total_amount,
                o.order_date,
                o.status,
                o.act,
                o.isnt_shown,
                a.name as customer_name,
                a.email as customer_email,
                a.class as customer_class
            FROM orders o
            LEFT JOIN accounts a ON o.customer_id = a.id
            WHERE o.isnt_shown = 0
        ";
        
        $params = [];
        
        if (!empty($searchTerm)) {
            $query .= " AND (o.order_number LIKE ? OR a.name LIKE ? OR o.order_date LIKE ?)";
            $searchParam = "%$searchTerm%";
            $params = [$searchParam, $searchParam, $searchParam];
        }
        
        $query .= " ORDER BY o.order_date DESC, o.id DESC";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
?>