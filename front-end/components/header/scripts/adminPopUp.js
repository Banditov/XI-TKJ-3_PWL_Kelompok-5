document.addEventListener('DOMContentLoaded', function() {
    const accessButton = document.getElementById('accessButton');
    const adminPopUp = document.getElementById('adminPopUp');
    const closeButton = document.getElementById('close');

    accessButton.addEventListener('click', function() {
        adminPopUp.style.display = 'flex';
        setTimeout(() => adminPopUp.style.opacity = "1", 100)
    });

    closeButton.addEventListener('click', function() {
        adminPopUp.style.opacity = "0";
        setTimeout(() => adminPopUp.style.display = 'none', 300)
    });

    adminPopUp.addEventListener('click', function(event) {
        if (event.target === adminPopUp) {
            adminPopUp.style.opacity = "0";
            setTimeout(() => adminPopUp.style.display = 'none', 300)
            currentOrderId = null;
            currentOrderNumber = null;
        }
    });
});