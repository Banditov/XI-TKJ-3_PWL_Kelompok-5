document.addEventListener('DOMContentLoaded', function() {
    const removeButtons = document.querySelectorAll('.removeBtn, .staticIcon[data-order-id]');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const orderNumber = this.getAttribute('data-order-number');
            removeOrder(orderId, orderNumber);
        });
    });
});

function removeOrder(orderId, orderNumber) {
    if (confirm(`Are you sure you want to remove order #${orderNumber} from view? This action cannot be undone.`)) {
        const loadingScreen = document.querySelector('.loading-screen');
        if (loadingScreen) {
            loadingScreen.style.display = 'flex';
        }

        fetch('/back-end/actions/sales/remove-sales.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                order_id: orderId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order removed successfully!');
                location.reload();
            } else {
                alert('Failed to remove order: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to remove order. Please try again.');
        })
        .finally(() => {
            const loadingScreen = document.querySelector('.loading-screen');
            if (loadingScreen) {
                loadingScreen.style.display = 'none';
            }
        });
    }
}