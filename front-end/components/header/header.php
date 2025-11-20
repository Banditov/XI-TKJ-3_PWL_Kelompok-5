<link rel="stylesheet" type="text/css" href="/front-end/components/header/style/style.css">
<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
<link rel="stylesheet" type="text/css" href="/front-end/components/header/style/responsive.css">

<header class="noInteract">
    <div id="header">
        <a href="/front-end/pages/admin-orders/index.php">
            <img src="/front-end/global/resources/image/logo/logo.png" id="logo">
        </a>
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
                <img src="/front-end/global/resources/image/icon/notification.png" class="headerIcon">
            </a>
            <a href="/front-end/pages/profile/index.php">
                <img src="/front-end/global/resources/image/icon/account.png" class="headerIcon">
            </a>
        </div>
    </div>
    <div id="nav">
        <div class="navSection">
            <a href="/front-end/pages/home/index.php">
                <div class="navTab">
                    <img src="/front-end/global/resources/image/icon/home.png">
                    <p>HOME</p>
                </div>
            </a>
            <a href="/front-end/pages/product/index.php">
                <div class="navTab">
                    <img src="/front-end/global/resources/image/icon/category.png">
                    <p>SHOP BY <b>CATEGORY</b></p>
                </div>
            </a>
        </div>
        <a href="/front-end/pages/history/index.php">
            <div class="navTab">
                <img src="/front-end/global/resources/image/icon/history.png">
                <p>HISTORY</p>
            </div>
        </a>
    </div>
</header>

<script src="/front-end/components/header/scripts/cartTotal.js"></script>