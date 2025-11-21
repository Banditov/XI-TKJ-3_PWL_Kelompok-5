<?php
    session_start();
    $user = $_SESSION['user'];
    require_once '../../config/db-connection.php';

    if (isset($_POST['register'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $class = htmlspecialchars(trim($_POST['class']));
        $password = $_POST['password'];

        $is_admin = isset($_POST['admin']) ? 1 : 0;

        $checkQuery = "SELECT id FROM accounts WHERE email = ?";
        $checkStmt = $connection->prepare($checkQuery);
        $checkStmt->bind_param('s', $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo "
                <script>
                    alert('Email already registered. Please use another one.');
                    window.location.href = '/front-end/pages/register-admin/index.php';
                </script>
            ";
            exit;
        }

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO accounts (name, email, password, class, is_admin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ssssi', $name, $email, $passwordHashed, $class, $is_admin);

        if ($stmt->execute()) {
            header('Location: /front-end/pages/home/index.php');
            exit;
        } else {
            echo "
                <script>
                    alert('Error registering new user');
                    window.location.href = '/front-end/pages/register-admin/index.php';
                </script>
            ";
            exit;
        }
    }
?>