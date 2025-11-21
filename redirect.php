<?php
    session_start();

    if (isset($_SESSION['user'])) {
        header('Location: ./front-end/pages/home/index.php');
        exit();
    } else {
        header('Location: ./front-end/pages/login/index.php');
        exit();
    }
?>