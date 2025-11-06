<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./front-end/pages/register-admin/index.php');
} else {
    header('Location: ./front-end/pages/login/index.php');
}
?>