document.addEventListener('DOMContentLoaded', function() {
    initializeFilter();
});

function initializeFilter() {
    const inputFilter = document.getElementById('inputFilter');
    
    if (inputFilter) {
        inputFilter.addEventListener('input', function() {
            filterOrders(this.value.trim());
        });

        const initialSearchTerm = inputFilter.value.trim();
        if (initialSearchTerm) {
            filterOrders(initialSearchTerm);
        }
    }
}

function filterOrders(searchTerm) {
    const orderRows = document.querySelectorAll('.row');
    const searchLower = searchTerm.toLowerCase();
    let hasVisibleResults = false;

    orderRows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        const isVisible = searchTerm === '' || rowText.includes(searchLower);
        row.style.display = isVisible ? 'flex' : 'none';

        if (isVisible) {
            hasVisibleResults = true;
        }
    });

    showNoResultsMessage(!hasVisibleResults && searchTerm !== '');
}

function showNoResultsMessage(show) {
    const existingMessage = document.querySelector('.noResultsMessage');
    if (existingMessage) {
        existingMessage.remove();
    }

    if (show) {
        const noResultsMessage = document.createElement('div');
        noResultsMessage.className = 'noResultsMessage';
        noResultsMessage.innerHTML = `
            <p>No orders found for "<strong>${document.getElementById('inputFilter').value}</strong>"</p>
            <p>Try searching with different keywords</p>
        `;

        const indicator = document.getElementById('indicator');
        if (indicator && indicator.nextElementSibling) {
            indicator.parentNode.insertBefore(noResultsMessage, indicator.nextElementSibling);
        }
    }
}