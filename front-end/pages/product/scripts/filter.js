let activeCategoryId = null;

const productContainer = document.getElementById('productContainer');

document.querySelectorAll('.parentText, .childText').forEach(item => {
    item.addEventListener('click', () => {
        const isParent = item.classList.contains('parentText');
        const categoryId = isParent 
            ? parseInt(item.closest('.parentRow').dataset.parentId) 
            : parseInt(item.closest('.childRow').dataset.childId);
        const type = isParent ? 'parent' : 'child';
        const sortValue = sortFilter.value;

        const newCategoryId = (activeCategoryId === categoryId) ? 0 : categoryId;
        activeCategoryId = (newCategoryId === 0) ? null : newCategoryId;

        document.querySelectorAll('.parentText, .childText').forEach(el => el.classList.remove('active'));
        if (activeCategoryId) item.classList.add('active');

        filterProducts(newCategoryId, type, sortValue);
    });
});

async function filterProducts(categoryId = 0, type = 'child', sort = 'default') {
    productContainer.innerHTML = "<p>Loading...</p>";

    const formData = new URLSearchParams({ 
        category_id: categoryId, 
        type, 
        sort 
    });

    try {
        const res = await fetch('/back-end/actions/filter/filter-products.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.error) return productContainer.innerHTML = `<p>${data.error}</p>`;
        if (!data.products || !data.products.length) return productContainer.innerHTML = "<p>No products found.</p>";

        productContainer.innerHTML = data.products.map(p => {
            const colorsHTML = (p.colors || []).map(color => `
                <label class="colorOption" id="${color}">
                    <input type="checkbox" value="${color}">
                </label>`).join('');

            return `
                <div class="stationeryProduct" data-id="${p.id}">
                    <div class="productImageHorizon">
                        <img src="/back-end/database/images/${p.image}.png" alt="${p.product_name}">
                    </div>
                    <div class="productDesc">
                        <p class="productStock">Stok: ${p.stock}</p>
                        <p class="productName">${p.product_name}</p>
                        <p class="productPrice">Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</p>
                        ${colorsHTML ? `<div class="colorForm"><form class="productColor">${colorsHTML}</form></div>` : ''}
                        <div class="addToCart">
                            <img src="/front-end/global/resources/image/icon/add.png">
                        </div>
                    </div>
                </div>`;
        }).join('');

        initProductColorEvents();

    } catch (err) {
        console.error(err);
        productContainer.innerHTML = "<p>Connection failed.</p>";
    }
}