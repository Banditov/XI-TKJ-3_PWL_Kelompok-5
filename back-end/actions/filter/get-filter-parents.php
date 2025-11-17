<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $parents = [];

    $query = "SELECT * from parent_category";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($parent = $result->fetch_assoc()) {
        $parents[] = $parent;
    }
?>