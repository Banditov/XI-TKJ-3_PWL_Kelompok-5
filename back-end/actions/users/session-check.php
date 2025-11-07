<?php
session_start();

if (
    (!isset($_SESSION['accounts']) || empty($_SESSION['accounts'])) &&
    (!isset($_SESSION['user']) || empty($_SESSION['user']))
) {
    echo "
        <script>
            alert('Please log in first.');
            window.location.href = '/front-end/pages/login/index.php';
        </script>
    ";
    exit;
}
?>