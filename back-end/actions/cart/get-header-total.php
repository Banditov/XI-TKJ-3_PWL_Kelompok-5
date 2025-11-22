<?php
    require_once __DIR__ . '/../../config/db-connection.php';
    session_start();

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    $cartTotal = 0;

    try {
        if (isset($_SESSION['accounts']) || isset($_SESSION['user'])) {
            $user_id = isset($_SESSION['accounts']) ? $_SESSION['accounts']['id'] : $_SESSION['user']['id'];
            $pdo = Database::getPDO();
            
            $stmt = $pdo->prepare("
                SELECT SUM(p.price * ci.quantity) as total_price 
                FROM cart_items ci 
                JOIN products p ON ci.product_id = p.id 
                WHERE ci.account_id = ?
            ");
            $stmt->execute([$user_id]);
            $result = $stmt->fetch();
            $cartTotal = $result['total_price'] ?: 0;
        }
        
        echo json_encode([
            'success' => true, 
            'total_price' => $cartTotal,
            'formatted_total' => 'Rp ' . number_format($cartTotal, 0, ',', '.'),
            'timestamp' => time()
        ]);
        
    } catch (Exception $e) {
        error_log("Error fetching cart total: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'total_price' => 0,
            'formatted_total' => 'Rp 0',
            'error' => 'Unable to fetch cart total'
        ]);
    }
?>