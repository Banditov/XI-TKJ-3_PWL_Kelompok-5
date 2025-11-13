<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
	require_once __DIR__ . '/../../../back-end/actions/cart/get-cart-items.php';
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - Cart</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/cart/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/cart/styles/animation.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/cart/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->


<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

		<div id="content">

<!-- Page Title -->

			<div id="pageTitle">
				<b>CART</b>
			</div>

<!-- Content -->

			<div id="indicator">
				<p>Added Items</p>
				<div id="rightIndicator">
					<p>Price</p>
					<p>Quantity</p>
					<p>Total</p>
				</div>
			</div>
			<?php if (empty($cartItems)): ?>
				<div class="empty-cart">
					<p>Your cart is empty</p>
					<a href="/front-end/pages/product/index.php">Continue Shopping</a>
				</div>
			<?php else: ?>
				<?php foreach ($cartItems as $item): ?>
					<?php
					$itemTotal = $item['price'] * $item['quantity'];
					$colorDisplay = $item['color'] !== 'None' ? " - " . $item['color'] : '';
					?>
					<div class="cardRow" data-cart-item-id="<?= $item['cart_item_id'] ?>">
						<div class="cartCard">
							<div class="imageCard">
								<img src="/back-end/database/images/<?= $item['image'] ?>.png" alt="<?= $item['product_name'] ?>">
							</div>
							<div class="cardContent">
								<p class="cardProduct"><?= $item['product_name'] . $colorDisplay ?></p>
								<div class="rightCardContent">
									<p>Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
									<div class="cardQuantity">
										<button class="quantity-btn" data-action="increase">+</button>
										<p class="quantity-display"><?= $item['quantity'] ?></p>
										<button class="quantity-btn" data-action="decrease">-</button>
									</div>
									<p class="cardTotal">Rp <?= number_format($itemTotal, 0, ',', '.') ?></p>
								</div>
							</div>
						</div>
						<div class="cardRemove" data-cart-item-id="<?= $item['cart_item_id'] ?>">
							<img src="/front-end/global/resources/image/icon/remove.png">
						</div>
					</div>
				<?php endforeach; ?>

				<div class="cartBottom">
					<div class="cartBottomSeperator">
						<p>Total: Rp <?= number_format($totalAmount, 0, ',', '.') ?></p>
						<button id="checkoutBtn">Proceed To Checkout</button>
					</div>
				</div>
			<?php endif; ?>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/global/scripts/cart.js"></script>
		<script src="/front-end/pages/cart/scripts/updateQuantity.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>