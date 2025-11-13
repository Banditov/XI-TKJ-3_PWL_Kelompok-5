class CartManager {
    constructor() {
        this.initialized = false;
        this.observer = null;
        this.init();
    }

    init() {
        if (this.initialized) return;
        
        console.log('CartManager initializing...');
        this.initializeAddToCartButtons();
        this.initializeColorSelection();
        this.setupMutationObserver();
        this.initialized = true;
    }

    setupMutationObserver() {
        this.observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === 1) {
                            if (node.classList && (node.classList.contains('stationeryProduct') || node.classList.contains('bookProduct'))) {
                                this.initializeProduct(node);
                            } else if (node.querySelector) {
                                const products = node.querySelectorAll('.stationeryProduct, .bookProduct');
                                products.forEach(product => this.initializeProduct(product));
                            }
                        }
                    });
                }
            });
        });

        this.observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    initializeProduct(productElement) {
        const addButton = productElement.querySelector('.addToCart');
        if (addButton && !addButton.hasAttribute('data-cart-initialized')) {
            addButton.setAttribute('data-cart-initialized', 'true');
            addButton.addEventListener('click', (e) => {
                console.log('Add to cart clicked (dynamic)');
                this.addToCart(productElement);
            });
        }

        const colorOptions = productElement.querySelectorAll('.colorOption');
        colorOptions.forEach(option => {
            if (!option.hasAttribute('data-cart-initialized')) {
                option.setAttribute('data-cart-initialized', 'true');
                option.style.cursor = 'pointer';
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
            }
        });
    }

    initializeAddToCartButtons() {
        console.log('Initializing add to cart buttons...');
        
        const bookProducts = document.querySelectorAll('.bookProduct');
        const stationeryProducts = document.querySelectorAll('.stationeryProduct');
        
        console.log('Found products:', {
            book: bookProducts.length,
            stationery: stationeryProducts.length
        });
        
        bookProducts.forEach(product => this.initializeProduct(product));
        stationeryProducts.forEach(product => this.initializeProduct(product));
    }

    initializeColorSelection() {
    }

    updateColorAppearance(colorOption, isChecked) {
    }

    addToCart(productElement) {
    }

    getSelectedColors(productElement) {
    }

    showNotification(message, type = 'info') {
    }

    updateCartCounter(addedCount = 1) {
    }
}

document.addEventListener('DOMContentLoaded', function() {
    window.cartManager = new CartManager();
});