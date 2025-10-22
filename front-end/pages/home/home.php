<?php
    require_once(__DIR__ . '/../../../back-end/actions/products/get-home-products.php');
    require_once(__DIR__ . '/../../../back-end/actions/products/get-books.php');
    require_once(__DIR__ . '/../../../back-end/actions/products/get-product-colours.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>ATK SKI - Home Page</title>
        <link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo.ico">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/productColor.css">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/home/styles/responsiveStyle.css">
    </head>
    <body>

<!-- Header -->

        <header>
            <div id="header">
                <img src="/front-end/global/resources/image/logo.png" id="logo">
                <a href="/front-end/pages/login/login.html">
                    <img src="/front-end/global/resources/image/account.png" class="accountIcon">
                </a>
            </div>
            <div id="nav">
                <div class="navSection">
                    <a href="home.html">
                        <div class="navTab">
                            <img src="/front-end/global/resources/image/home.png">
                            <p id="selectedTab">HOME</p>
                        </div>
                    </a>
                    <a href="">
                        <div class="navTab">
                            <img src="/front-end/global/resources/image/category.png">
                            <p>SHOP BY <b>CATEGORY</b></p>
                        </div>
                    </a>
                </div>
                <div class="navSection">
                    <a href="">
                        <div class="navTab">
                            <img src="/front-end/global/resources/image/history.png">
                            <p>HISTORY</p>
                        </div>
                    </a>
                    <a href="">
                        <div class="navTab">
                            <img src="/front-end/global/resources/image/wishlist.png">
                            <p>WISHLIST</p>
                        </div>
                    </a>
                </div>
            </div>
        </header>

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

        <footer>
            <div id="footer">
                <img src="/front-end/global/resources/image/logo.png" id="logo">
                <div id="footerContent">
                    <div id="footerAbout">
                        <h4><b>About This Website</b></h4>
                        <h5>Website ini memudahkan pemesanan alat tulis sekolah secara online. Pengguna dapat mengecek stok, mengurangi antrean, dan melakukan pembayaran langsung dengan cepat dan praktis.</h5>
                    </div>
                    <div>
                        <h4><b>Helpful Link</b></h4>
                        <p>FAQs</p>
                    </div>
                    <div>
                        <h4><b>Contact Us</b></h4>
                        <div class="contact">
                            <img src="/front-end/global/resources/image/email.png">
                            <h5>ATKski@ski.sch.id</h5>
                        </div>
                        <div class="contact">
                            <img src="/front-end/global/resources/image/phone.png">
                            <h5>+62896-1224-0668</h5>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>


