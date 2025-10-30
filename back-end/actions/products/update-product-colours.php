<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    
    $productId = (int)$_POST['product_id'];
    $color = $connection->real_escape_string($_POST['color']);

    $sql = "SELECT product_id, product_name, stock, price, image 
            FROM products 
            WHERE product_id = $productId 
            AND color = '$color'
            LIMIT 1";

    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No variant found"]);
    }

    $connection->close();
?>