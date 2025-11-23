<?php
    require_once __DIR__ . '/../../../../back-end/actions/users/admin-check.php';
    require_once __DIR__ . '/../../../../back-end/actions/sales/admin-get-sales-items.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ADMIN ORDER VIEWER | ATK SKI</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/order-viewer/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/order-viewer/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

		<?php include '../../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../../components/header/header.php'; ?>

		<div id="content" class="noInteract">

<!-- Page Title -->

			<div id="pageTitle">
				<b>Admin - Order Viewer</b>
			</div>

<!-- Content -->

			<input 
				id="inputFilter" 
				placeholder="Cari..." 
				value="<?php echo htmlspecialchars($searchTerm); ?>">

			<div id="indicator">
				<div id="leftIndicator">
					<b class="orderNumber">Nomor Pesanan</b>
					<b class="customer">Pembeli</b>
					<b class="date">Tanggal</b>
					<b class="items">Items</b>
				</div>
			</div>

		<?php if (empty($orders)): ?>
			<div class="emptyTable">
				<p>Tidak menemukan orderan</p>
		<?php if (!empty($searchTerm)): ?>
					<p>Coba ganti kata anda dalam search</p>
		<?php endif; ?>
			</div>
	<?php else: ?>
		<?php foreach ($orders as $order): ?>
			<?php
			$orderDate = date('d M Y', strtotime($order['order_date']));
			$totalAmount = number_format($order['total_amount'], 0, ',', '.');
			$productList = !empty($order['products']) ? explode(';; ', $order['products']) : [];
			?>

			<div class="row" data-order-id="<?= $order['order_id'] ?>">
				<div class="leftRow">
					<p class="orderNumber"><?= $order['order_number'] ?></p>
					<p class="customer"><?= $order['customer_name'] ?></p>
					<p class="date"><?= $orderDate ?></p>
					<div class="items">
				<?php foreach ($productList as $product): ?>
							<p><?= htmlspecialchars($product) ?></p>
				<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

		</div>

<!-- Footer -->

		<?php include '../../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/pages/admin/order-viewer/scripts/filter.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>