<?php
require_once __DIR__ . '/../../config/db-connection.php';
session_start();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$cart_item_id = isset($input['cart_item_id']) ? intval($input['cart_item_id']) : null;
$quantity = isset($input['quantity']) ? intval($input['quantity']) : null;

if (!$cart_item_id || !$quantity) {
    echo json_encode(['success' => false, 'message' => 'Invalid data.']);
    exit;
}

try {
    $priceQuery = "
        SELECT p.price 
        FROM cart_items ci 
        JOIN products p ON ci.product_id = p.id 
        WHERE ci.id = ?
    ";
    $priceStmt = $pdo->prepare($priceQuery);
    $priceStmt->execute([$cart_item_id]);
    $product = $priceStmt->fetch();
    
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }
    
    $updateQuery = "UPDATE cart_items SET quantity = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$quantity, $cart_item_id]);
    
    $new_total = $product['price'] * $quantity;
    
    $user_id = $_SESSION['accounts']['id'] ?? $_SESSION['user']['id'];
    $totalQuery = "
        SELECT SUM(p.price * ci.quantity) as grand_total 
        FROM cart_items ci 
        JOIN products p ON ci.product_id = p.id 
        WHERE ci.account_id = ?
    ";
    $totalStmt = $pdo->prepare($totalQuery);
    $totalStmt->execute([$user_id]);
    $totalResult = $totalStmt->fetch();
    $new_grand_total = $totalResult['grand_total'] ?? 0;
    
    echo json_encode([
        'success' => true, 
        'message' => 'Quantity updated successfully',
        'new_total' => $new_total,
        'new_grand_total' => $new_grand_total
    ]);
    
} catch (Exception $e) {
    error_log("Update cart item error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
}
?>