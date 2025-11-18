<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
    require_once __DIR__ . '/../../../back-end/actions/sales/get-sales.php';
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - History</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/history/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/history/styles/animation.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/history/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

		<?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

		<div id="content">

<!-- Page Title -->

			<div id="pageTitle">
				<b>HISTORY</b>
			</div>

<!-- Content -->

			<input id="inputFilter" placeholder="Cari order atau produk..." value="<?= htmlspecialchars($searchTerm) ?>">

			<div id="indicator">
				<div id="leftIndicator">
					<b>Nomor Pesanan</b>
					<b>Tanggal</b>
					<b>Items</b>
				</div>
				<div id="rightIndicator">
					<b>Total</b>
					<b>Status</b>
				</div>
			</div>

		<?php if (empty($orders)): ?>
				<div class="emptyHistory">
					<p>No order history found</p>
			<?php if (!empty($searchTerm)): ?>
					<p>Try adjusting your search terms</p>
			<?php else: ?>
					<a href="/front-end/pages/product/index.php">Start Shopping</a>
			<?php endif; ?>
				</div>
			<?php else: ?>
				<?php foreach ($orders as $order): ?>
					<?php
					$statusClass = strtolower($order['status']);
					$orderDate = date('d M Y', strtotime($order['order_date']));

					$productList = [];
					if (!empty($order['products'])) {
						$productList = explode(';;', $order['products']);
					}
					?>

					<div class="historyRow" data-order-id="<?= $order['order_id'] ?>">
						<div class="leftHistory">
							<p class="orderNumber"><?= $order['order_number'] ?></p>
							<p class="orderDate"><?= $orderDate ?></p>
							<div class="productList">
						<?php foreach ($productList as $product): ?>
								<p class="productName"><?= htmlspecialchars($product) ?></p>
						<?php endforeach; ?>
							</div>
						</div>
						<div class="rightHistory">
							<p class="totalAmount">Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></p>
							<p class="status <?= $statusClass ?>"><?= $order['status'] ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/pages/history/scripts/filter.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>