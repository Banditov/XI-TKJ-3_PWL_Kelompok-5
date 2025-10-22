<?php
    require_once __DIR__ . '/../../config/db-connection.php' ;

    $books = [];

    $query = "SELECT * from products WHERE id IN (1,4,5)";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($product = $result->fetch_assoc()) {
        $books[] = $product;
    }
?>