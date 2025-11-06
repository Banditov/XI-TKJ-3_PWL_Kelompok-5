document.querySelectorAll('.dropDown').forEach(btn => {
    btn.addEventListener('click', () => {
        const row = btn.closest('.qaRow');
        const answer = row.querySelector('.qaAnswerRow');

        document.querySelectorAll('.qaRow').forEach(item => {
        if (item !== row) {
            item.classList.remove('active');
            item.querySelector('.dropDown').textContent = '+';
            item.querySelector('.qaAnswerRow').style.display = 'none';
        }
        });

        const isActive = row.classList.toggle('active');
        btn.textContent = isActive ? '−' : '+';
        answer.style.display = isActive ? 'block' : 'none';
    });
});
