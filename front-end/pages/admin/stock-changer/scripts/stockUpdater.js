document.addEventListener('DOMContentLoaded', function() {
    initializeStockControls();
});

function initializeStockControls() {
    document.querySelectorAll('.plusBtn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const input = document.querySelector(`.stockInput[data-product-id="${productId}"]`);
            const changeAmount = parseInt(input.value);
            
            if (changeAmount > 0) {
                updateProductStock(productId, changeAmount);
            }
        });
    });

    document.querySelectorAll('.minusBtn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const input = document.querySelector(`.stockInput[data-product-id="${productId}"]`);
            const changeAmount = parseInt(input.value);
            
            if (changeAmount > 0) {
                updateProductStock(productId, -changeAmount);
            }
        });
    });

    document.querySelectorAll('.stockInput').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const productId = this.getAttribute('data-product-id');
                const changeAmount = parseInt(this.value);
                
                if (changeAmount > 0) {
                    updateProductStock(productId, changeAmount);
                }
            }
        });
    });

    document.querySelectorAll('.stockInput').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 1) {
                this.value = 1;
            }
        });
    });
}

function updateProductStock(productId, changeAmount) {
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
        loadingScreen.style.display = 'flex';
    }

    const stockElement = document.querySelector(`.row[data-product-id="${productId}"] .currentStock`);
    const currentStockText = stockElement.textContent;
    const currentStock = parseInt(currentStockText);

    fetch('/back-end/actions/products/update-product-stock.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            change_amount: changeAmount
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            stockElement.textContent = data.new_stock + ' pcs';
        } else {
            alert('Failed to update stock: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update stock. Please try again.');
    })
    .finally(() => {
        const loadingScreen = document.querySelector('.loading-screen');
        if (loadingScreen) {
            loadingScreen.style.display = 'none';
        }
    });
}