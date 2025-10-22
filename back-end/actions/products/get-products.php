<?php
    require_once(__DIR__ . '/../../config/db-connection.php');

    $products = [];

    $query = "SELECT * from products";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
?>