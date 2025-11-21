<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    header('Content-Type: application/json');

    session_start();

    if (isset($_SESSION['accounts']['id'])) {
        $customer_id = $_SESSION['accounts']['id'];
    } else if (isset($_SESSION['user']['id'])) {
        $customer_id = $_SESSION['user']['id'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in. Please login again.']);
        exit;
    }

    try {
        $pdo = Database::getPDO();

        $pdo->beginTransaction();

        $query = "
            SELECT 
                ci.id as cart_item_id,
                ci.quantity,
                p.id as product_id,
                p.product_id as product_group_id,
                p.product_name,
                p.price,
                p.image,
                p.color,
                p.stock
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.account_id = ?
            ORDER BY ci.id DESC
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$customer_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cartItems)) {
            echo json_encode(['success' => false, 'message' => 'Cart is empty']);
            exit;
        }

        $totalAmount = 0;
        $order_number = 'ORD' . date('Ymd') . rand(1000, 9999);

        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $orderStmt = $pdo->prepare("
            INSERT INTO orders (order_number, customer_id, total_amount, order_date, status) 
            VALUES (?, ?, ?, CURDATE(), 'pending')
        ");
        $orderStmt->execute([$order_number, $customer_id, $totalAmount]);
        $order_id = $pdo->lastInsertId();

        foreach ($cartItems as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $totalPrice = $price * $quantity;

            $salesStmt = $pdo->prepare("
                INSERT INTO sales (order_id, customer_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $salesStmt->execute([$order_id, $customer_id, $product_id, $quantity, $totalPrice]);

            $updateStmt = $pdo->prepare("
                UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?
            ");
            $updateStmt->execute([$quantity, $product_id, $quantity]);
        }

        $clearStmt = $pdo->prepare("DELETE FROM cart_items WHERE account_id = ?");
        $clearStmt->execute([$customer_id]);

        $pdo->commit();

        echo json_encode([
            'success' => true, 
            'message' => 'Order placed successfully!',
            'total_sales' => $totalAmount,
            'order_id' => $order_id,
            'order_number' => $order_number
        ]);

    } catch (Exception $e) {
        if (isset($pdo)) {
            $pdo->rollBack();
        }
        error_log("Create sales error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error creating order: ' . $e->getMessage()]);
    }
?>