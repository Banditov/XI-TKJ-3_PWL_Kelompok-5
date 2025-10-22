<?php
    require_once(__DIR__ . '../../config/db-connection.php');

    function getProduct($productId)
    {
        global $connection;

        $query = "SELECT * from products where product_id = ?";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        $product = $stmt->get_result()->fetch_assoc();

        return $product;
    }
?>