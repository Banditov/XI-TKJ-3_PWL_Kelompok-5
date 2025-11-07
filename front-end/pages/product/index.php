<?php
    require_once __DIR__ . '/../../../back-end/actions/filter/get-filter-childs.php';
    require_once __DIR__ . '/../../../back-end/actions/filter/get-filter-parents.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-products.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-product-colours.php';
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - Products</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/product/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productColor.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productCard.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productHover.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/product/styles/animation.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/product/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

        <?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

<!-- Filter -->

        <div id="filter">
            <p>Sort By</p>
            <select id="sortFilter">
                <option value="default">Default</option>
                <option value="lowHigh">Lowest Price</option>
                <option value="highLow">Highest Price</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>
            <p>Category</p>
            <div class="filterRow">
        <?php foreach($parents as $index => $parent): ?>
                <div class="parentRow" data-type="parent" data-parent-id="<?= $parent['id']; ?>">
                    <div class="dropDownButton">
                        <img src="/front-end/global/resources/image/arrowWhite.png" class="dropDown">
                    </div>
                    <p class="parentText"><?= $parent['name']; ?></p>
                </div>
            <?php foreach($childs as $index => $child): ?>
                <?php if ($child['parent_id'] == $parent['id']): ?>
                    <div class="childRow" data-parent-id="<?= $parent['id']; ?>" data-type="child" data-child-id="<?= $child['id']; ?>">
                        <p class="childText"><?= $child['name']; ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
            </div>
        </div>

<!-- Content -->

		<div id="content">

                <div id="productContainer">
                    <?php foreach($products as $index => $product): ?>
                            <div class="stationeryProduct" data-id="<?= $product['product_id'] ?>">
                                <div class="productImageHorizon">
                                    <img src="/back-end/database/images/<?= $product['image']; ?>.png">
                                </div>
                                <div class="productDesc">
                                    <p class="productStock">Stok: <?= $product['stock']; ?></p>
                                    <p class="productName"><?= $product['product_name']; ?></p>
                                    <p class="productPrice">Rp <?= number_format($product['price'], 0, ',', '.'); ?></p>
                        <?php if (isset($colors[$product['product_id']])): ?>
                                    <div class="colorForm">
                                        <form class="productColor">
                            <?php foreach($colors[$product['product_id']] as $color): ?>
                                            <label class="colorOption" id="<?= $color ?>">
                                                <input type="checkbox" value="<?= $color ?>">
                                            </label>
                            <?php endforeach; ?>
                                        </form>
                                    </div>
                        <?php endif; ?>
                                    <div class="addToCart">
                                        <img src="/front-end/global/resources/image/add.png">
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

        <script src="/front-end/pages/product/scripts/sort.js"></script>
        <script src="/front-end/pages/product/scripts/dropDown.js"></script>
        <script src="/front-end/pages/product/scripts/filter.js"></script>
        <script src="/front-end/global/scripts/colourSelect.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>