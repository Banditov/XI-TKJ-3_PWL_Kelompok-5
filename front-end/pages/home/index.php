<?php
    require_once __DIR__ . '/../../../back-end/actions/products/get-home-products.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-books.php';
    require_once __DIR__ . '/../../../back-end/actions/products/get-product-colours.php';
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>Home | ATK SKI</title>
        <link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/animation.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productColor.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productCard.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productHover.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/responsive.css">
    </head>
    <body>

<!-- Loading Screen -->

        <?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

        <?php include '../../components/header/header.php'; ?>

<!-- Banner -->

        <div id="banner" class="noInteract">
            <div class="parallaxWrapper">
                <div class="parallaxImage">
                    <div id="bannerTitle">
                        <p>Welcome To<br>ATK SMK Kristen Immanuel</p>
                    </div>
                </div>
            </div>
        </div>

<!-- Produk Buku -->

        <div id="homeSection" class="noInteract">
            <div id="homeTitle">
                <img src="/front-end/global/resources/image/icon/book.png">
                <p>Buku</p>
            </div>
            <div class="bookProducts">
        <?php foreach($books as $index => $product): ?>
                <div class="bookProduct" data-id="<?= $product['product_id'] ?>">
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
                        <img src="/front-end/global/resources/image/icon/add.png">
                    </div>
                </div>
        <?php endforeach; ?>
                <div id="bookBanner">
                    <a href="/front-end/pages/product/index.php" id="bookBannerButton">
                        <p>Belanja Sekarang ></p>
                    </a>
                    <img src="/front-end/global/resources/image/banner/bookBanner.jpg">
                </div>
            </div>
        </div>

<!-- Produk Alat Tulis -->

        <div id="homeSection" class="noInteract">
            <div id="homeTitle">
                <img src="/front-end/global/resources/image/icon/pen.png">
                <p>Alat Tulis</p>
            </div>
            <div id="stationerySection">
                <div id="bannerStationery">
                    <a href="/front-end/pages/product/index.php" id="bannerStationeryButton">
                        <p>Lebih Banyak...</p>
                    </a>
                    <img src="/front-end/global/resources/image/banner/bannerStationery.jpg">
                </div>
                <div class="stationeryProducts">
            <?php foreach($homeProducts as $index => $product): ?>
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
                                <img src="/front-end/global/resources/image/icon/add.png">
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
                </div>
            </div>
        </div>

<!-- Footer -->

        <?php include '../../components/footer/footer.php'; ?>

<!-- Scripts -->

        <script src="/front-end/global/scripts/addToCart.js"></script>
        <script src="/front-end/pages/home/scripts/bannerSlideshow.js"></script>
        <script src="/front-end/pages/home/scripts/bannerParallax.js"></script>
        <script src="/front-end/global/scripts/colourSelect.js"></script>
        <script src="/front-end/global/scripts/loading-screen.js"></script>
    </body>
</html>