<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data['product_id'] ?? null;
    $change_amount = $data['change_amount'] ?? null;

    if (!$product_id || $change_amount === null) {
        echo json_encode(['success' => false, 'message' => 'Product ID and change amount are required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
            exit;
        }

        $current_stock = $product['stock'];
        $new_stock = $current_stock + $change_amount;

        if ($new_stock < 0) {
            echo json_encode(['success' => false, 'message' => 'Stock cannot be negative. Current stock: ' . $current_stock]);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
        $stmt->execute([$new_stock, $product_id]);

        echo json_encode([
            'success' => true, 
            'message' => 'Stock updated successfully',
            'new_stock' => $new_stock,
            'previous_stock' => $current_stock,
            'change_amount' => $change_amount
        ]);

    } catch (PDOException $e) {
        error_log("Update product stock error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
?>