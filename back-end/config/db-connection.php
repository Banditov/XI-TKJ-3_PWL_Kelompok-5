<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "atkski";
    $charset = "utf8mb4";
    $dsn = "mysql:host=$host;dbname=$database;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $connection = mysqli_connect($host, $username,$password,$database);

    if (!$connection) {
        die("Error Connection to database: " . mysqli_connect_error());
    }
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>