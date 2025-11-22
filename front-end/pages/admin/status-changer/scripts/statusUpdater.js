document.addEventListener('DOMContentLoaded', function() {
    const statusDropdowns = document.querySelectorAll('.statusDropdown');

    statusDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const orderId = this.getAttribute('data-order-id');
            const newStatus = this.value;
            
            updateOrderStatus(orderId, newStatus);
        });
    });
});

function updateOrderStatus(orderId, newStatus) {
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
        loadingScreen.style.display = 'flex';
    }

    fetch('/back-end/actions/sales/update-sale-status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            order_id: orderId,
            act: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
        } else {
            alert('Failed to update status: ' + (data.message || 'Unknown error'));
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status. Please try again.');
        location.reload();
    })
    .finally(() => {
        const loadingScreen = document.querySelector('.loading-screen');
        if (loadingScreen) {
            loadingScreen.style.display = 'none';
        }
    });
}