function loadCartCount() {
    fetch('/back-end/actions/cart/get-header-total.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateHeaderCartCount(data.count);
            }
        })
        .catch(error => {
            console.error('Error loading cart count:', error);
        });
}

function updateHeaderCartCount(count) {
    const cartCountElement = document.getElementById('headerCartCount');
    if (cartCountElement) {
        if (count > 0) {
            cartCountElement.textContent = count;
            cartCountElement.style.display = 'flex';
        } else {
            cartCountElement.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', loadCartCount);