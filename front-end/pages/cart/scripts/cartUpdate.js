document.addEventListener('DOMContentLoaded', function() {
    initializeCartInteractions();
});

function initializeCartInteractions() {
    document.querySelectorAll('.quantityBtn').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const cartItemId = this.closest('.cardRow').getAttribute('data-cart-item-id');
            updateQuantity(cartItemId, action);
        });
    });

    document.querySelectorAll('.cardRemove').forEach(button => {
        button.addEventListener('click', function() {
            const cartItemId = this.getAttribute('data-cart-item-id');
            removeFromCart(cartItemId);
        });
    });

    const checkoutBtn = document.getElementById('checkoutBtn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', proceedToCheckout);
    }
}

function updateQuantity(cartItemId, action) {
    const quantityDisplay = document.querySelector(`[data-cart-item-id="${cartItemId}"] .quantityDisplay`);
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
            updateItemTotal(cartItemId, data.new_total);
            updateCartTotal(data.new_grand_total);
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

function removeFromCart(cartItemId) {
    if (!confirm('Are you sure you want to remove this item from cart?')) {
        return;
    }
    
    fetch('/back-end/actions/cart/remove-cart-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            cart_item_id: cartItemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`[data-cart-item-id="${cartItemId}"]`).remove();
            updateCartCounter();
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error removing item');
    });
}

function updateItemTotal(cartItemId, newTotal) {
    const totalElement = document.querySelector(`[data-cart-item-id="${cartItemId}"] .cardTotal`);
    if (totalElement) {
        totalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(newTotal);
    }
}

function updateCartTotal(newGrandTotal) {
    const totalElement = document.querySelector('.totalAmount');
    if (totalElement && newGrandTotal) {
        totalElement.textContent = 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(newGrandTotal);
    }
}

function updateCartCounter() {
    const cartCounter = document.querySelector('.cartCount');
    if (cartCounter) {
        const currentCount = parseInt(cartCounter.textContent) || 0;
        cartCounter.textContent = Math.max(0, currentCount - 1);
        if (cartCounter.textContent === '0') {
            cartCounter.remove();
        }
    }
}

function proceedToCheckout() {
    window.location.href = '/front-end/pages/checkout/index.php';
}