class HeaderCartTotal {
    constructor() {
        this.cartElement = document.getElementById('headerCartTotal');
        this.init();
    }

    init() {
        this.loadCartTotal();
        this.setupEventListeners();
    }

    async loadCartTotal() {
        try {
            const response = await fetch('/back-end/actions/cart/get-header-total.php');
            const data = await response.json();
            
            if (data.success) {
                this.updateTotal(data.total_price, data.formatted_total);
            } else {
                console.error('Failed to load cart total:', data.error);
                this.updateTotal(0, 'Rp 0');
            }
        } catch (error) {
            console.error('Error loading cart total:', error);
            this.loadFromLocalStorage();
        }
    }

    updateTotal(totalPrice, formattedTotal = null) {
        if (!this.cartElement) return;
        
        if (totalPrice > 0) {
            const displayTotal = formattedTotal || this.formatPrice(totalPrice);
            this.cartElement.textContent = displayTotal;
            this.cartElement.style.display = 'flex';
        } else {
            this.cartElement.style.display = 'none';
        }
        
        this.saveToLocalStorage(totalPrice);
    }

    formatPrice(price) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
    }

    setupEventListeners() {
        document.addEventListener('cartUpdated', (event) => {
            if (event.detail && typeof event.detail.total_price !== 'undefined') {
                this.updateTotal(event.detail.total_price, event.detail.formatted_total);
            }
        });

        window.addEventListener('storage', (event) => {
            if (event.key === 'cartTotalPrice') {
                this.updateTotal(parseInt(event.newValue) || 0);
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                this.loadCartTotal();
            }
        });
    }

    saveToLocalStorage(totalPrice) {
        try {
            localStorage.setItem('cartTotalPrice', totalPrice.toString());
            localStorage.setItem('cartTotalTimestamp', Date.now().toString());
        } catch (e) {
            console.warn('Could not save cart total to localStorage');
        }
    }

    loadFromLocalStorage() {
        try {
            const storedTotal = localStorage.getItem('cartTotalPrice');
            const timestamp = localStorage.getItem('cartTotalTimestamp');
            
            if (storedTotal && timestamp) {
                const age = Date.now() - parseInt(timestamp);
                if (age < 5 * 60 * 1000) { // 5 minutes
                    this.updateTotal(parseInt(storedTotal));
                }
            }
        } catch (e) {
            console.warn('Could not load cart total from localStorage');
        }
    }

    refresh() {
        this.loadCartTotal();
    }

    updateTotalByChange(priceChange) {
        const currentText = this.cartElement?.textContent || 'Rp 0';
        const currentPrice = this.extractPrice(currentText);
        const newPrice = Math.max(0, currentPrice + priceChange);
        this.updateTotal(newPrice);
    }

    extractPrice(priceText) {
        return parseInt(priceText.replace(/[^\d]/g, '')) || 0;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    window.headerCartTotal = new HeaderCartTotal();
});