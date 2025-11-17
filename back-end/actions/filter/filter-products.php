<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    header('Content-Type: application/json');

    $categoryId = intval($_POST['category_id'] ?? 0);
    $type = $_POST['type'] ?? 'child';
    $sort = $_POST['sort'] ?? 'default';

    try {
        if ($categoryId === 0) {
            $stmt = $pdo->query("
                SELECT product_id, product_name, price, stock, image, color
                FROM products
            ");
        } else {
            $column = $type === 'parent' ? 'category_parent_id' : 'category_id';

            $stmt = $pdo->prepare("
                SELECT product_id, product_name, price, stock, image, color
                FROM products
                WHERE $column = :cid
            ");
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
                    'price' => (float) str_replace(',', '', $row['price']),
                    'stock' => $row['stock'],
                    'image' => $row['image'],
                    'colors' => [],
                ];
            }
            if (!empty($row['color']) && !in_array($row['color'], $groupedProducts[$pid]['colors'])) {
                $groupedProducts[$pid]['colors'][] = $row['color'];
            }
        }

        $productsArray = array_values($groupedProducts);

        if ($categoryId === 0 && $sort === 'default') {
            shuffle($productsArray);
        }

        switch ($sort) {
            case 'lowHigh':
                usort($productsArray, fn($a, $b) => $a['price'] <=> $b['price']);
                break;
            case 'highLow':
                usort($productsArray, fn($a, $b) => $b['price'] <=> $a['price']);
                break;
            case 'az':
                usort($productsArray, fn($a, $b) => strcmp(trim($a['product_name']), trim($b['product_name'])));
                break;
            case 'za':
                usort($productsArray, fn($a, $b) => strcmp(trim($b['product_name']), trim($a['product_name'])));
                break;
        }

        echo json_encode(['products' => $productsArray]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
?>
