<?php
    require_once __DIR__ . '/../../../../back-end/actions/users/admin-check.php';
    require_once __DIR__ . '/../../../../back-end/actions/sales/admin-get-sales.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - ADMIN PRODUCT STOCK CHANGER</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/product-stock-changer/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/product-stock-changer/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

		<?php include '../../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../../components/header/header.php'; ?>

		<div id="content" class="noInteract">

<!-- Page Title -->

			<div id="pageTitle">
				<b>ADMIN PRODUCT STOCK CHANGER</b>
			</div>

<!-- Content -->

			<input 
				id="inputFilter" 
				placeholder="Cari order number, customer, atau tanggal..." 
				value="">

			<div id="indicator">
				<div id="leftIndicator">
					<b class="orderNumber">Nomor Pesanan</b>
					<b class="customerInfo">Customer</b>
					<b class="orderDate">Stock</b>
				</div>
				<div id="rightIndicator">
					<b class="statusDropdown">Status</b>
				</div>
			</div>

			<?php if (empty($orders)): ?>
				<div class="emptyTable">
					<p>No order found</p>
				</div>
			<?php else: ?>
				<?php foreach ($orders as $order): ?>
					<?php
					$orderDate = date('d M Y', strtotime($order['order_date']));
					$totalAmount = number_format($order['total_amount'], 0, ',', '.');
					?>

					<div class="row" data-order-id="<?= $order['order_id'] ?>">
						<div class="leftRow">
							<p class="orderNumber"><?= $order['order_number'] ?></p>
							<p class="customerInfo"><?= $order['customer_name'] ?></p>
							<p class="orderDate"><?= $orderDate ?></p>
							<p class="totalAmount">Rp <?= $totalAmount ?></p>
						</div>
						<div class="rightRow">
							<select class="statusDropdown" data-order-id="<?= $order['order_id'] ?>">
								<option value="notReady" <?= $order['act'] === 'Not Ready' ? 'selected' : '' ?>>Not Ready</option>
								<option value="ready" <?= $order['act'] === 'Ready' ? 'selected' : '' ?>>Ready</option>
								<option value="completed" <?= $order['act'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
								<option value="cancelled" <?= $order['act'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
							</select>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>

<!-- Footer -->
		<?php include '../../../components/footer/footer.php'; ?> 

<!-- Scripts -->
		<script src="/front-end/pages/admin/status-changer/scripts/filter.js"></script>
		<script src="/front-end/pages/admin/status-changer/scripts/statusUpdater.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>