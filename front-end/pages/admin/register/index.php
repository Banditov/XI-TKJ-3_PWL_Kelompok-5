<?php
    require_once __DIR__ . '/../../../../back-end/actions/users/admin-check.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>ADMIN REGISTER | ATK SKI</title>
        <link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
        <link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/login/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/login/styles/animation.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/login/styles/responsive.css">
    </head>
    <body>

<!-- Loading Screen -->

        <?php include '../../../components/loading-screen/loading-screen.php'; ?>

<!-- Content -->

        <div id="loginBackground" class="noInteract">
            <img src="/front-end/global/resources/image/background/login_background.png">
        </div>

        <div id="centerForm">
            <div class="loginForm noInteract">
                <b>ADMIN REGISTER</b>
                <form method="POST" id="loginForm" action="/back-end/actions/users/register.php">
                    <div class="inputForm">
                        <input type="text" id="name" name="name" class="inputField" placeholder="Username" required>
                    </div>
                    <div class="inputForm">
                        <input type="email" id="email" name="email" class="inputField" placeholder="Email Sekolah" required>
                    </div>
                    <div class="inputForm">
                        <input type="text" id="class" name="class" class="inputField" placeholder="Class" required>
                    </div>
                    <div class="inputForm">
                        <input type="password" id="password" name="password" class="inputField" placeholder="Password" required>
                    </div>
                    <div class="inputForm" id="adminCheck">
                        <input type="checkbox" id="admin" name="admin" class="inputCheck">
                        <label for="admin" class="inputCheck">Is Admin?</label>
                    </div>
                    <button type="submit" name="register" class="submitButton">Create</button>
                    <a class="submitButton" onclick="history.back()">Exit</a>
                </form>
            </div>
        </div>

<!-- Scripts -->

        <script src="/front-end/global/scripts/loading-screen.js"></script>
    </body>
</html>