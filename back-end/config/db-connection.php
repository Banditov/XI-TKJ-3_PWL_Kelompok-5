<?php
    class Database {
        private static $connection = null;
        private static $pdo = null;

        public static function getConnection() {
            if (self::$connection === null) {
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "atkski";
                
                self::$connection = mysqli_connect($host, $username, $password, $database);
                
                if (!self::$connection) {
                    die("Error Connection to database: " . mysqli_connect_error());
                }
            }
            return self::$connection;
        }

        public static function getPDO() {
            if (self::$pdo === null) {
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

                try {
                    self::$pdo = new PDO($dsn, $username, $password, $options);
                } catch (PDOException $e) {
                    die('Connection failed: ' . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    }

    $connection = Database::getConnection();
    $pdo = Database::getPDO();
?>