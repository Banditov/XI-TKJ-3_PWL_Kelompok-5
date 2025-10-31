<?php
    $user = $_SESSION['user'];

    require_once '../../config/db-connection.php';

    if (isset($_POST['register'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $class = htmlspecialchars(trim($_POST['class']));
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['confirm'];

        if ($password != $passwordConfirmation) {
            echo "
                <script>
                    alert('Password and Password Confirmation doesnt match');
                    window.location.href = '/front-end/pages/register-admin/index.php';
                </script>
            ";
        } else {
            $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO accounts (name, email, password, class) VALUES (?, ?, ?, ?)";

            $stmt = $connection->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $passwordHashed, $class);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header('Location: /front-end/pages/login/index.php');
                exit;
            } else {
                echo "
                    <script>
                        alert('Error to register new user');
                    </script>
                ";

                header('Location: /front-end/pages/register-admin/index.php');
                exit;
            }
        }

    }
?>