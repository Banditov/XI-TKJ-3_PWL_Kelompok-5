<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ./front-end/pages/login/index.php');
    }
?>