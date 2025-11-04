<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $qna = [];

    $query = "SELECT * from faq";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    while($qa = $result->fetch_assoc()) {
        $qna[] = $qa;
    }
?>