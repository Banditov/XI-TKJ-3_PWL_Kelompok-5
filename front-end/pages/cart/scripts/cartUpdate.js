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
            
            if (window.headerCartTotal) {
                window.headerCartTotal.refresh();
            }
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
    if (!confirm('Apakah anda ingin menghapus item ini?')) {
        return;
    }
    
    const cardRow = document.querySelector(`[data-cart-item-id="${cartItemId}"]`);
    if (!cardRow) return;
    
    const priceText = cardRow.querySelector('.itemPrice').textContent;
    const itemPrice = extractPrice(priceText);
    const quantity = parseInt(cardRow.querySelector('.quantityDisplay').textContent);
    const totalItemPrice = itemPrice * quantity;
    
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
            cardRow.remove();
            
            if (window.headerCartTotal) {
                window.headerCartTotal.updateTotalByChange(-totalItemPrice);
            }
            
            if (document.querySelectorAll('.cardRow').length === 0) {
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                updateCartTotal();
            }
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
    if (newGrandTotal) {
        const totalElement = document.querySelector('.totalAmount');
        if (totalElement) {
            totalElement.textContent = 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(newGrandTotal);
        }
    } else {
        recalculateCartTotal();
    }
}

function recalculateCartTotal() {
    let manualTotal = 0;
    document.querySelectorAll('.cardRow').forEach(row => {
        const quantity = parseInt(row.querySelector('.quantityDisplay').textContent);
        const priceText = row.querySelector('.itemPrice').textContent;
        const price = extractPrice(priceText);
        manualTotal += price * quantity;
    });
    
    const totalElement = document.querySelector('.totalAmount');
    if (totalElement) {
        totalElement.textContent = 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(manualTotal);
    }
}

function extractPrice(priceText) {
    return parseInt(priceText.replace(/[^\d]/g, '')) || 0;
}