<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $products = [];

    $query = "SELECT * FROM products 
            WHERE is_first = 1  
            ORDER BY RAND()";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
?>