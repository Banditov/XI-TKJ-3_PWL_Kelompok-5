<?php
    require_once __DIR__ . '/../../config/db-connection.php';

    $user_id = $_SESSION['accounts']['id'] ?? $_SESSION['user']['id'] ?? null;
    if (!$user_id) exit;

    $stmt = $pdo->prepare("SELECT id, name, email, class FROM accounts WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>