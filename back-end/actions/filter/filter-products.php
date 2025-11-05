<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    header('Content-Type: application/json');

    if (!isset($_POST['category_id'])) {
        echo json_encode(['error' => 'Missing category ID']);
        exit;
    }

    $type = $_POST['type'] ?? 'child';
    $categoryId = intval($_POST['category_id']);

    try {
        if ($categoryId === 0) {
            $stmt = $pdo->query("
                SELECT product_id, product_name, price, stock, image, color
                FROM products
                WHERE is_first = 1
            ");
        } else {
            $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_parent_id = :id");
            $check->execute([':id' => $categoryId]);

            if ($type === 'parent') {
                $sql = "SELECT product_id, product_name, price, stock, image, color
                        FROM products
                        WHERE category_parent_id = :cid";
            } else {
                $sql = "SELECT product_id, product_name, price, stock, image, color
                        FROM products
                        WHERE category_id = :cid";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':cid', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        }

        $rawProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $groupedProducts = [];
        foreach ($rawProducts as $row) {
            $pid = $row['product_id'];
            if (!isset($groupedProducts[$pid])) {
                $groupedProducts[$pid] = [
                    'id' => $pid,
                    'product_name' => $row['product_name'],
                    'price' => $row['price'],
                    'stock' => $row['stock'],
                    'image' => $row['image'],
                    'colors' => [],
                ];
            }
            if (!empty($row['color']) && !in_array($row['color'], $groupedProducts[$pid]['colors'])) {
                $groupedProducts[$pid]['colors'][] = $row['color'];
            }
        }

        echo json_encode(['products' => array_values($groupedProducts)]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
?>