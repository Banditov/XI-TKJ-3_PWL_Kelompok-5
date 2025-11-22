<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
<link rel="stylesheet" type="text/css" href="/front-end/components/header/style/style.css">
<link rel="stylesheet" type="text/css" href="/front-end/components/header/style/animation.css">
<link rel="stylesheet" type="text/css" href="/front-end/components/header/style/responsive.css">

<header class="noInteract">
    <div id="header">
        <img src="/front-end/global/resources/image/logo/logo.png" id="logo">
        <div id="headerIcons">
            <div id="cartSection">
                <div id="cartInfo">
                    <p>My Cart</p>
                    <span class="cartTotal" id="headerCartTotal"></span>
                </div>
                <a href="/front-end/pages/cart/index.php">
                    <img src="/front-end/global/resources/image/icon/cart.png" class="headerIcon">
                </a>
            </div>
            <a href="/front-end/pages/status/index.php">
                <img src="/front-end/global/resources/image/icon/notification.png" class="headerIcon" id="notificationIcon">
            </a>
            <a href="/front-end/pages/profile/index.php">
                <img src="/front-end/global/resources/image/icon/account.png" class="headerIcon">
            </a>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1): ?>
            <img src="/front-end/global/resources/image/icon/setting.png" class="headerIcon" id="accessButton">
    <?php endif; ?>
        </div>
    </div>
    <div id="nav">
        <div class="navSection">
            <a href="/front-end/pages/home/index.php">
                <div class="navTab">
                    <img src="/front-end/global/resources/image/icon/home.png">
                    <p>Home</p>
                </div>
            </a>
            <a href="/front-end/pages/product/index.php">
                <div class="navTab">
                    <img src="/front-end/global/resources/image/icon/category.png">
                    <p>Belanja</p>
                </div>
            </a>
        </div>
        <a href="/front-end/pages/history/index.php">
            <div class="navTab">
                <img src="/front-end/global/resources/image/icon/history.png">
                <p>Riwayat</p>
            </div>
        </a>
    </div>
</header>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1): ?>
    <div id="adminPopUp" class="noInteract">
        <div id="adminContainer">
            <a href="/front-end/pages/admin/status-changer/index.php">Status Changer</a>
            <a href="/front-end/pages/admin/stock-changer/index.php">Stock Changer</a>
            <a href="/front-end/pages/admin/register/index.php">Register</a>
            <p id="close">Tutup</p>
        </div>
    </div>
<?php endif; ?>

<script src="/front-end/components/header/scripts/notification.js"></script>
<script src="/front-end/components/header/scripts/adminPopUp.js"></script>
<script src="/front-end/components/header/scripts/cartTotal.js"></script>