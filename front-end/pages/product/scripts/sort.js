const sortFilter = document.getElementById('sortFilter');

sortFilter.addEventListener('change', () => {
    const sortValue = sortFilter.value;
    const categoryId = activeCategoryId ?? 0;

    let type = 'child';
    if (activeCategoryId) {
        type = document.querySelector('.parentText.active') ? 'parent' : 'child';
    }

    filterProducts(categoryId, type, sortValue);
});