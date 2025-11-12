function updateQuantity(cartItemId, action) {
    const quantityDisplay = document.querySelector(`[data-cart-item-id="${cartItemId}"] .quantity-display`);
    let currentQuantity = parseInt(quantityDisplay.textContent);
    
    if (action === 'increase') {
        currentQuantity += 1;
    } else if (action === 'decrease' && currentQuantity > 1) {
        currentQuantity -= 1;
    } else {
        return;
    }
    
    quantityDisplay.textContent = '...';
    
    fetch('/back-end/actions/cart/update-cart-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            cart_item_id: cartItemId,
            quantity: currentQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            quantityDisplay.textContent = currentQuantity;
            this.updateItemTotal(cartItemId, data.new_total);
            this.updateCartTotal(data.new_grand_total);
        } else {
            alert(data.message);
            quantityDisplay.textContent = currentQuantity - (action === 'increase' ? 1 : -1);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating quantity');
        quantityDisplay.textContent = currentQuantity - (action === 'increase' ? 1 : -1);
    });
}