<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $colors = [];
    $query = "SELECT product_id, color FROM products WHERE color != 'None'";
    $result = $connection->query($query);

    while ($row = $result->fetch_assoc()) {
        $colors[$row['product_id']][] = $row['color'];
    }
?>