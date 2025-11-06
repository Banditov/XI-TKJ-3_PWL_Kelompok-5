const sortFilter = document.getElementById('sortFilter');

sortFilter.addEventListener('change', () => {
    const sortValue = sortFilter.value;
    const categoryId = activeCategoryId ?? 0;
    filterProducts(categoryId, sortValue);
});