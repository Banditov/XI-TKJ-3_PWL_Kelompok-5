document.addEventListener('DOMContentLoaded', function() {
    const cancelButtons = document.querySelectorAll('.cancelBtn');
    const confirmPopUp = document.getElementById('confirmPopUp');
    const cancelConfirmButton = document.getElementById('cancelConfirmButton');
    const confirmButton = document.getElementById('confirmButton');
    const confirmText = document.getElementById('confirmText');
    
    let currentOrderId = null;
    let currentOrderNumber = null;

    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentOrderId = this.getAttribute('data-order-id');
            currentOrderNumber = this.getAttribute('data-order-number');

            confirmText.textContent = `Apakah anda yakin ingin membatalkan order #${currentOrderNumber}?`;

            confirmPopUp.style.display = 'flex';
            setTimeout(() => confirmPopUp.style.opacity = "1", 100)
        });
    });

    cancelConfirmButton.addEventListener('click', function() {
        confirmPopUp.style.opacity = "0";
        setTimeout(() => confirmPopUp.style.display = 'none', 300)
        currentOrderId = null;
        currentOrderNumber = null;
    });

    confirmButton.addEventListener('click', function() {
        if (currentOrderId && currentOrderNumber) {
            confirmPopUp.style.display = 'none';
            processCancellation(currentOrderId, currentOrderNumber);
        }
    });

    confirmPopUp.addEventListener('click', function(event) {
        if (event.target === confirmPopUp) {
            confirmPopUp.style.display = 'none';
            currentOrderId = null;
            currentOrderNumber = null;
        }
    });
});

function processCancellation(orderId, orderNumber) {
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
        loadingScreen.style.display = 'flex';
    }

    fetch('/back-end/actions/sales/cancel-sale.php', {
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