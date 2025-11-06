document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const rows = Array.from(document.querySelectorAll('.qaRow'));

    window.runFilter = function() {
        const query = (searchInput.value || '').trim().toLowerCase();
        const expanded = document.getElementById('extendQAIcon').style.transform === 'rotate(180deg)';

        rows.forEach(row => {
        const question = row.querySelector('.questionText')?.textContent.toLowerCase() || '';
        const answer = row.querySelector('.qaAnswer p')?.textContent.toLowerCase() || '';
        const matches = query === '' || question.includes(query) || answer.includes(query);
        const isHiddenOriginal = row.dataset.hiddenOriginal === 'true';

        if (matches && (!isHiddenOriginal || expanded)) {
            row.classList.remove('filtered');
        } else {
            row.classList.add('filtered');
        }
        });
    };

    searchInput.addEventListener('input', runFilter);
    runFilter();
});