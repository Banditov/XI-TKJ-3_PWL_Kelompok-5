<?php
    require_once __DIR__ . '/../../config/db-connection.php';

	if (isset($_SESSION['accounts'])) {
		$user_id = $_SESSION['accounts']['id'];
	} else if (isset($_SESSION['user'])) {
		$user_id = $_SESSION['user']['id'];
	}

	$cartItems = [];
	$totalAmount = 0;

	try {
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
		$stmt->execute([$user_id]);
		$cartItems = $stmt->fetchAll();
		
		foreach ($cartItems as $item) {
			$totalAmount += $item['price'] * $item['quantity'];
		}
		
	} catch (Exception $e) {
		error_log("Cart page error: " . $e->getMessage());
	}
?>