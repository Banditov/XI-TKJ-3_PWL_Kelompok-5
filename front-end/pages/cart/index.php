<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
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
			<div class="cardRow">
				<div class="cartCard">
					<div class="imageCard">
						<img src="/back-end/database/images/0011.png">
					</div>
					<div class="cardContent">
						<p class="cardProduct">Suatu Produk - Warna</p>
						<div class="rightCardContent">
							<p>Rp 1.000</p>
							<div class="cardQuantity">
								<button>+</button>
								<p>1</p>
								<button>-</button>
							</div>
							<p class="cardTotal">Rp 1.000</p>
						</div>
					</div>
				</div>
				<div class="cardRemove">
					<img src="/front-end/global/resources/image/icon/remove.png">
				</div>
			</div>

			<div class="cartBottom">
				<div class="cartBottomSeperator">
					<p>Total: Rp 1.000</p>
					<button>Proceed To Checkout</button>
				</div>
			</div>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>