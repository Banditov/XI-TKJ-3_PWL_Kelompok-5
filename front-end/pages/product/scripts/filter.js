let activeCategoryId = null;

document.querySelectorAll('.parentRow, .childRow').forEach(item => {
    item.addEventListener('click', () => {
        const categoryId = parseInt(item.dataset.id);
        const sortValue = document.getElementById('sortFilter').value;

        const newCategoryId = (activeCategoryId === categoryId) ? 0 : categoryId;
        activeCategoryId = (newCategoryId === 0) ? null : newCategoryId;

        document.querySelectorAll('.parentRow, .childRow').forEach(el => el.classList.remove('active'));
        if (activeCategoryId) item.classList.add('active');

        filterProducts(newCategoryId, sortValue);
    });
});

async function filterProducts(categoryId, sort = 'default') {
    const productContainer = document.querySelector('#productContainer');
    const newCategoryId = categoryId ?? 0;

    productContainer.innerHTML = "<p>Loading...</p>";

    try {
        const response = await fetch('/back-end/actions/filter/filter-products.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `category_id=${encodeURIComponent(newCategoryId)}&sort=${encodeURIComponent(sort)}`
        });

        const result = await response.json();

        if (result.error) {
            productContainer.innerHTML = `<p>${result.error}</p>`;
            return;
        }

        if (!result.products || result.products.length === 0) {
            productContainer.innerHTML = "<p>No products found.</p>";
            return;
        }

        productContainer.innerHTML = result.products.map(p => {
            const colorOptions = (p.colors || []).map(color => `
                <label class="colorOption" id="${color}">
                    <input type="checkbox" value="${color}">
                </label>
            `).join('');

            return `
                <div class="stationeryProduct" data-id="${p.id}">
                    <div class="productImageHorizon">
                        <img src="/back-end/database/images/${p.image}.png" alt="${p.product_name}">
                    </div>
                    <div class="productDesc">
                        <p class="productStock">Stok: ${p.stock}</p>
                        <p class="productName">${p.product_name}</p>
                        <p class="productPrice">Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</p>

                        ${colorOptions ? `
                        <div class="colorForm">
                            <form class="productColor">
                                ${colorOptions}
                            </form>
                        </div>` : ''}

                        <div class="addToCart">
                            <img src="/front-end/global/resources/image/add.png">
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        initProductColorEvents();
    } catch (err) {
        console.error(err);
        productContainer.innerHTML = "<p>Connection failed.</p>";
    }
}