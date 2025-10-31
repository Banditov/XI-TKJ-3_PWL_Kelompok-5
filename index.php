<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./front-end/pages/register-admin/index.php');
} else {
    header('Location: ./front-end/pages/login/index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ATK SKI - Please Wait...</title>
        <meta http-equiv="refresh" content="1;url=front-end/pages/home/index.php">
    </head>
    <body>
    </body>
</html>