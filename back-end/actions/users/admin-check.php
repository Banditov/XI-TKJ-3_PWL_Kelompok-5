<?php
    session_start();

    $isAdmin = false;
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $isAdmin = isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1;
    } elseif (isset($_SESSION['accounts']) && !empty($_SESSION['accounts'])) {
        $isAdmin = isset($_SESSION['accounts']['is_admin']) && $_SESSION['accounts']['is_admin'] == 1;
    }

    if (!$isAdmin) {
        echo "
            <script>
                alert('Admin access required.');
                window.location.href = '/front-end/pages/home/index.php';
            </script>
        ";
        exit;
    }
?>