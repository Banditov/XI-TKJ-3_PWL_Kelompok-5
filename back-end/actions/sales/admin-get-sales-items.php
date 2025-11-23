<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    $orders = [];
    $searchTerm = '';

    try {
        $query = "
            SELECT 
                o.id as order_id,
                o.order_number,
                o.total_amount,
                o.order_date,
                o.status,
                o.act,
                a.name as customer_name,
                a.class as customer_class,
                a.email as customer_email,
                GROUP_CONCAT(CONCAT(
                    p.product_name, 
                    CASE WHEN p.color != 'None' THEN CONCAT(' - ', p.color) ELSE '' END,
                    CONCAT(' (', s.quantity, 'x', ')')
                ) SEPARATOR ';; ') as products,
                COUNT(s.id) as item_count
            FROM orders o
            LEFT JOIN accounts a ON o.customer_id = a.id
            LEFT JOIN sales s ON o.id = s.order_id
            LEFT JOIN products p ON s.product_id = p.id
            WHERE o.status NOT IN ('Completed', 'Cancelled')
            AND o.isnt_shown = 0
        ";

        $params = [];

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $query .= " AND (o.order_number LIKE ? OR a.name LIKE ? OR p.product_name LIKE ?)";
            $searchParam = "%$searchTerm%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        $query .= " GROUP BY o.id ORDER BY o.order_date DESC, o.id DESC";

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        error_log("Admin order viewer error: " . $e->getMessage());
        $error = "Unable to load orders. Please try again.";
    }
?>