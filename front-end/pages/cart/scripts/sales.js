document.addEventListener('DOMContentLoaded', function() {
    initializeCheckout();
});

function initializeCheckout() {
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkOutPopUp = document.getElementById('checkOutPopUp');
    const checkOutButton = document.getElementById('checkOutButton');

    if (checkoutBtn) {
        const newCheckoutBtn = checkoutBtn.cloneNode(true);
        checkoutBtn.parentNode.replaceChild(newCheckoutBtn, checkoutBtn);
        
        newCheckoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const cartItems = document.querySelectorAll('.cardRow');
            if (cartItems.length === 0) {
                alert('Your cart is empty!');
                return;
            }
            
            createSalesData();
        });
    }

    if (checkOutButton) {
        checkOutButton.addEventListener('click', function() {
            closePopup();
        });
    }

    if (checkOutPopUp) {
        checkOutPopUp.addEventListener('click', function(e) {
            if (e.target === checkOutPopUp) {
                closePopup();
            }
        });
    }
}

function showPopup() {
    const checkOutPopUp = document.getElementById('checkOutPopUp');
    if (checkOutPopUp) {
        checkOutPopUp.style.display = 'flex';
        setTimeout(() => {
            checkOutPopUp.style.opacity = '1';
        }, 10);
    }
}

function closePopup() {
    const checkOutPopUp = document.getElementById('checkOutPopUp');
    if (checkOutPopUp) {
        checkOutPopUp.style.opacity = '0';
        setTimeout(() => {
            checkOutPopUp.style.display = 'none';
            window.location.href = '/front-end/pages/history/index.php';
        }, 300);
    }
}

function createSalesData() {
    const checkoutBtn = document.getElementById('checkoutBtn');
    
    if (!checkoutBtn) {
        console.error('Checkout button not found');
        return;
    }

    const originalText = checkoutBtn.textContent;
    
    checkoutBtn.textContent = 'Processing...';
    checkoutBtn.disabled = true;

    fetch('/back-end/actions/sales/create-sales.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const orderNumberElement = document.querySelector('#checkOutContainer p:nth-child(2)');
            const totalPriceElement = document.querySelector('#checkOutContainer p:nth-child(3)');
            
            if (orderNumberElement) {
                orderNumberElement.textContent = 'Order Number: ' + data.order_number;
            }
            if (totalPriceElement) {
                totalPriceElement.textContent = 'Total Harga: Rp ' + new Intl.NumberFormat('id-ID').format(data.total_sales);
            }
            
            showPopup();
            
            if (window.headerCartTotal) {
                window.headerCartTotal.refresh();
            }
            
        } else {
            alert('Error: ' + (data.message || 'Failed to create order'));
            checkoutBtn.textContent = originalText;
            checkoutBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating order. Please check if you are logged in.');
        checkoutBtn.textContent = originalText;
        checkoutBtn.disabled = false;
    });
}