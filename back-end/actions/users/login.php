<?php
    require_once '../../config/db-connection.php';
    session_start();

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * from accounts where email = ?";

        $stmt = $connection->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        if (isset($user)) {
        $isPasswordMatch = password_verify($password, $user['password']);

        if ($isPasswordMatch) {
            session_regenerate_id(true);
            $_SESSION['accounts'] = $user;

            header('Location: /front-end/pages/home/index.php');
            exit;
        } else {
            echo "
                <script>
                    alert('Password is wrong');
                    window.location.href = '/front-end/pages/login/index.php';
                </script>
            ";
        }
        } else {
            echo "
                <script>
                    alert('Email doesnt exist');
                    window.location.href = '/front-end/pages/login/index.php';
                </script>
            ";
        }
    }
?>