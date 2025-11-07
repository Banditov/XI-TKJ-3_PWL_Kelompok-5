<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $childs = [];

    $query = "SELECT * from child_category";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($child = $result->fetch_assoc()) {
        $childs[] = $child;
    }
?>