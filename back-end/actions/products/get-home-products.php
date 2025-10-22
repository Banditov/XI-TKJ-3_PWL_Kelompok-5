<?php
    require_once __DIR__ . '/../../config/db-connection.php' ;

    $homeProducts = [];

    $query = "SELECT * FROM products 
            WHERE is_bwt = 1 AND is_first = 1  
            ORDER BY RAND() 
            LIMIT 6";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($product = $result->fetch_assoc()) {
        $homeProducts[] = $product;
    }
?>