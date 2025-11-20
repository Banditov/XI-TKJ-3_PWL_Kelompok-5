class CartManager {
    constructor() {
        this.initialized = false;
        this.init();
    }

    init() {
        if (this.initialized) return;
        
        this.initializeAddToCartButtons();
        this.initializeColorSelection();
        this.initialized = true;
    }

    initializeAddToCartButtons() {
        const bookAddButtons = document.querySelectorAll('.bookProduct .addToCart');
        
        bookAddButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                console.log('Book add to cart clicked');
                const productElement = e.currentTarget.closest('.bookProduct');
                this.addToCart(productElement);
            });
        });

        const stationeryAddButtons = document.querySelectorAll('.stationeryProduct .addToCart');
        
        stationeryAddButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const productElement = e.currentTarget.closest('.stationeryProduct');
                this.addToCart(productElement);
            });
        });

        if (bookAddButtons.length === 0 && stationeryAddButtons.length === 0) {
            setTimeout(() => {
                this.initializeAddToCartButtons();
            }, 500);
        }
    }

    initializeColorSelection() {
        const colorOptions = document.querySelectorAll('.colorOption');
        colorOptions.forEach(option => {
            option.style.cursor = 'pointer';
            option.style.position = 'relative';
            
            option.addEventListener('click', (e) => {
                if (e.target.type !== 'checkbox') {
                    const checkbox = option.querySelector('input[type="checkbox"]');
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;
                        this.updateColorAppearance(option, checkbox.checked);
                    }
                }
            });
            
            const checkbox = option.querySelector('input[type="checkbox"]');
            if (checkbox) {
                this.updateColorAppearance(option, checkbox.checked);
            }
        });
        
        const colorCheckboxes = document.querySelectorAll('.colorOption input[type="checkbox"]');
        colorCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', (e) => {
                this.updateColorAppearance(e.currentTarget.parentElement, e.currentTarget.checked);
            });
        });
    }

    updateCartTotal(addedItems = []) {
        const totalPriceChange = addedItems.reduce((total, item) => {
            return total + (item.price || 0);
        }, 0);

        if (window.headerCartTotal) {
            window.headerCartTotal.updateTotalByChange(totalPriceChange);
        }
        
        this.dispatchCartUpdateEvent(totalPriceChange, 'add');
    }

    extractPrice(priceText) {
        return parseInt(priceText.replace(/[^\d]/g, '')) || 0;
    }

    formatPrice(price) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
    }

    dispatchCartUpdateEvent(priceChange, action) {
        const event = new CustomEvent('cartUpdated', {
            detail: {
                price_change: priceChange,
                action: action,
                timestamp: Date.now()
            }
        });
        document.dispatchEvent(event);
    }

    updateColorAppearance(colorOption, isChecked) {
        if (isChecked) {
            colorOption.style.transform = 'scale(1.1)';
            colorOption.style.boxShadow = 'none';
        } else {
            colorOption.style.transform = 'scale(1)';
            colorOption.style.boxShadow = 'none';
        }
    }

    addToCart(productElement) {
        const productId = productElement.getAttribute('data-id');
        const selectedColors = this.getSelectedColors(productElement);
        const colorForm = productElement.querySelector('.colorForm');
        
        if (!colorForm) {
            selectedColors.push('None');
        } else if (selectedColors.length === 0) {
            alert('Please select at least one color');
            return;
        }
        
        const priceElement = productElement.querySelector('.productPrice');
        const productPrice = priceElement ? this.extractPrice(priceElement.textContent) : 0;

        const addButton = productElement.querySelector('.addToCart');
        const originalContent = addButton.innerHTML;
        addButton.innerHTML = '<div class="loading-spinner"></div>';
        addButton.style.pointerEvents = 'none';

        const addPromises = selectedColors.map(color => {
            return fetch('/back-end/actions/cart/add-to-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    color: color,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                return { 
                    color, 
                    price: productPrice,
                    ...data 
                };
            });
        });

        Promise.all(addPromises)
            .then(results => {
                const successfulAdds = results.filter(result => result.success);
                const failedAdds = results.filter(result => !result.success);
                
                if (successfulAdds.length > 0) {
                    if (successfulAdds.length === selectedColors.length) {
                        this.showNotification(`All ${successfulAdds.length} items added to cart!`, 'success');
                    } else {
                        this.showNotification(`${successfulAdds.length} of ${selectedColors.length} items added to cart`, 'success');
                    }
                    
                    this.updateCartTotal(successfulAdds);
                }
                
                if (failedAdds.length > 0) {
                    const errorMessages = failedAdds.map(failed => `${failed.color}: ${failed.message}`).join(', ');
                    this.showNotification(`Some items failed: ${errorMessages}`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Network error occurred', 'error');
            })
            .finally(() => {
                addButton.innerHTML = originalContent;
                addButton.style.pointerEvents = 'auto';
            });
    }

    getSelectedColors(productElement) {
        const selectedColors = [];
        const checkboxes = productElement.querySelectorAll('input[type="checkbox"]:checked');
        
        checkboxes.forEach(checkbox => {
            selectedColors.push(checkbox.value);
        });
        
        return selectedColors;
    }

    showNotification(message, type = 'info') {
        const existingNotification = document.querySelector('.cart-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `cart-notification ${type}`;
        notification.textContent = message;
        
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
            color: white;
            padding: 12px 20px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 10000;
            font-family: Arial, sans-serif;
            font-size: 14px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            transform: translateX(100%);
            opacity: 0;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
            notification.style.opacity = '1';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            notification.style.opacity = '0';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    window.cartManager = new CartManager();
});

if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(() => {
        window.cartManager = new CartManager();
    }, 100);
}

const cartStyles = `
    .colorOption {
        cursor: pointer;
        transition: all 0.2s ease;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
    }
    
    .colorOption input[type="checkbox"] {
        cursor: pointer;
        margin: 0;
        opacity: 0.7;
    }
    
    .colorOption:hover {
        transform: scale(1.05);
    }
    
    .colorOption:hover input[type="checkbox"] {
        opacity: 1;
    }
    
    .addToCart {
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    
    .addToCart:active {
        transform: scale(0.95);
    }
    
    .loading-spinner {
        width: 16px;
        height: 16px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
`;

if (!document.querySelector('#cart-styles')) {
    const styleSheet = document.createElement("style");
    styleSheet.id = 'cart-styles';
    styleSheet.textContent = cartStyles;
    document.head.appendChild(styleSheet);
}