document.addEventListener('DOMContentLoaded', function() {
    const cancelButtons = document.querySelectorAll('.cancelBtn');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const orderNumber = this.getAttribute('data-order-number');
            cancelOrder(orderId, orderNumber);
        });
    });
});

function cancelOrder(orderId, orderNumber) {
    if (confirm(`Are you sure you want to cancel order #${orderNumber}?`)) {
        const loadingScreen = document.querySelector('.loading-screen');
        if (loadingScreen) {
            loadingScreen.style.display = 'flex';
        }

        fetch('/back-end/actions/sales/cancel-sales.php', {
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
                alert('Order cancelled successfully!');
                location.reload();
            } else {
                alert('Failed to cancel order: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to cancel order. Please try again.');
        })
        .finally(() => {
            const loadingScreen = document.querySelector('.loading-screen');
            if (loadingScreen) {
                loadingScreen.style.display = 'none';
            }
        });
    }
}