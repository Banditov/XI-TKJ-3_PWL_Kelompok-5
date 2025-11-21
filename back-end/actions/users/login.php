<?php
    session_start();
    require_once '../../config/db-connection.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            echo "
                <script>
                    alert('Please fill in all fields');
                    window.location.href = '/front-end/pages/login/index.php';
                </script>
            ";
            exit;
        }

        $query = "SELECT * FROM accounts WHERE email = ?";
        
        $stmt = $connection->prepare($query);
        if (!$stmt) {
            die("Database error: " . $connection->error);
        }
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $isPasswordMatch = password_verify($password, $user['password']);

            if ($isPasswordMatch) {
                session_regenerate_id(true);
                $_SESSION['user'] = $user;
                
                header('Location: /front-end/pages/home/index.php');
                exit;
            } else {
                echo "
                    <script>
                        alert('Password is wrong');
                        window.location.href = '/front-end/pages/login/index.php';
                    </script>
                ";
                exit;
            }
        } else {
            echo "
                <script>
                    alert('Email doesn\\'t exist');
                    window.location.href = '/front-end/pages/login/index.php';
                </script>
            ";
            exit;
        }
        
        $stmt->close();
    }
    $connection->close();
?>