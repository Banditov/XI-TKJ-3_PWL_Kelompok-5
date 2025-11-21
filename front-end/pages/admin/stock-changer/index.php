<?php
    require_once __DIR__ . '/../../../../back-end/actions/users/admin-check.php';
    require_once __DIR__ . '/../../../../back-end/actions/products/admin-get-products.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - ADMIN PRODUCT STOCK CHANGER</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/stock-changer/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/admin/stock-changer/styles/responsive.css">
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
				placeholder="Cari..." 
				value="">

			<div id="indicator">
				<div id="leftIndicator">
					<b class="productName">Nama Produk</b>
					<b class="productCategory">Kategori</b>
					<b class="currentStock">Stok</b>
				</div>
			</div>

			<?php if (empty($products)): ?>
				<div class="emptyTable">
					<p>No products found</p>
				</div>
			<?php else: ?>
				<?php foreach ($products as $product): ?>
					<?php
					$priceFormatted = number_format($product['price'], 0, ',', '.');
					$colorDisplay = $product['color'] !== 'None' ? ' (' . $product['color'] . ')' : '';
					?>

					<div class="row" data-product-id="<?= $product['id'] ?>">
						<div class="leftRow">
							<p class="productName"><?= $product['product_name'] ?><?= $colorDisplay ?></p>
							<p class="productCategory"><?= $product['parent_category'] ?> / <?= $product['child_category'] ?></p>
							<p class="currentStock"><?= $product['stock'] ?> pcs</p>
						</div>
						<div class="rightRow">
							<div class="stockChange">
								<button class="stockBtn minusBtn" data-product-id="<?= $product['id'] ?>">-</button>
								<input 
									type="number" 
									class="stockInput" 
									value="1" 
									min="1"
									data-product-id="<?= $product['id'] ?>">
								<button class="stockBtn plusBtn" data-product-id="<?= $product['id'] ?>">+</button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>

<!-- Footer -->
		<?php include '../../../components/footer/footer.php'; ?> 

<!-- Scripts -->
		<script src="/front-end/pages/admin/stock-changer/scripts/filter.js"></script>
		<script src="/front-end/pages/admin/stock-changer/scripts/stockUpdater.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>