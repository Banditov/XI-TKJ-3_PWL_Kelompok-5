<?php
    require_once __DIR__ . '/../../../back-end/actions/products/get-home-products.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-books.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-product-colours.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>ATK SKI - Home Page</title>
        <link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo.ico">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/product-color.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/global-style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/responsive.css">
    </head>
    <body>

<!-- Header -->

        <?php include '../../components/header/header.php'; ?>

<!-- Banner -->

        <div id="banner">
            <img src="/front-end/global/resources/image/banner.png">
        </div>

<!-- Produk Buku -->

        <div id="homeSection">
            <div id="homeTitle">
                <img src="/front-end/global/resources/image/book.png">
                <p>Books</p>
            </div>
            <div class="bookProducts">
        <?php foreach($books as $index => $product): ?>
                <div class="bookProduct">
                    <div class="wishlistBookProduct">
                        <img src="/front-end/global/resources/image/wishlistFeature.png">
                    </div>
                    <div class="productImage">
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
                    </div>
                    <div class="addToCart">
                        <img src="/front-end/global/resources/image/add.png">
                    </div>
                </div>
        <?php endforeach; ?>
                <div id="bookBanner">
                    <div id="bookBannerButton">
                        <p>Shop Now ></p>
                    </div>
                    <img src="/front-end/global/resources/image/bookBanner.png">
                </div>
            </div>
        </div>

<!-- Produk Alat Tulis -->

        <div id="homeSection">
            <div id="homeTitle">
                <img src="/front-end/global/resources/image/pen.png">
                <p>Basic Writing Tools</p>
            </div>
            <div id="stationerySection">
                <div id="bannerStationery">
                    <div id="bannerStationeryButton">
                        <p>More ...</p>
                    </div>
                    <img src="/front-end/global/resources/image/bannerStationery.png">
                </div>
                <div class="stationeryProducts">
            <?php foreach($homeProducts as $index => $product): ?>
                    <div class="stationeryProduct">
                        <div class="wishlistProduct">
                            <img src="/front-end/global/resources/image/wishlistFeature.png">
                        </div>
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
        </div>

<!-- Footer -->

        <?php include '../../components/footer/footer.php'; ?>
    </body>
</html>