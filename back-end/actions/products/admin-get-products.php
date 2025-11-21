<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $products = [];

    try {
        $stmt = $pdo->prepare("
            SELECT 
                p.id,
                p.product_id,
                p.product_name,
                p.stock,
                p.price,
                p.image,
                p.color,
                pc.name as parent_category,
                cc.name as child_category
            FROM products p
            LEFT JOIN parent_category pc ON p.category_parent_id = pc.id
            LEFT JOIN child_category cc ON p.category_id = cc.id
            ORDER BY p.product_id, p.id
        ");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
?>