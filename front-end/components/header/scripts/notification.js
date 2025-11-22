document.addEventListener('DOMContentLoaded', function() {
    checkReadyOrders();

    setInterval(checkReadyOrders, 10000);
});

function checkReadyOrders() {
    fetch('/back-end/actions/sales/get-ready-sales.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.text();
        })
        .then(text => {
            
            try {
                const data = JSON.parse(text);

                if (data.success && data.has_ready_orders) {
                    updateNotificationIcon(true);
                } else {
                    updateNotificationIcon(false);
                }
            } catch (parseError) {
                console.error('JSON parse error:', parseError, 'Response text:', text);
                throw new Error('Invalid JSON response');
            }
        })
        .catch(error => {
            console.error('Error checking ready orders:', error);
        });
}

function updateNotificationIcon(hasReadyOrders) {
    const notificationIcon = document.getElementById('notificationIcon');
    if (notificationIcon) {
        const newSrc = hasReadyOrders 
            ? '/front-end/global/resources/image/icon/notificationOn.png'
            : '/front-end/global/resources/image/icon/notification.png';

        if (notificationIcon.src !== newSrc) {
            notificationIcon.src = newSrc;

            if (hasReadyOrders) {
                notificationIcon.classList.add('notificationActive');
            } else {
                notificationIcon.classList.remove('notificationActive');
            }
        }
    }
}