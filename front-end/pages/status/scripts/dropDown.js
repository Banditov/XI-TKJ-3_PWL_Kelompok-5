document.querySelectorAll('.statusRow').forEach(row => {
    const dropButton = row.querySelector('.dropDownButton');
    const bottomRow = row.querySelector('.rowBottom');

    dropButton.addEventListener('click', () => {
        const isOpen = bottomRow.classList.contains('open');

        bottomRow.classList.toggle('open', !isOpen);

        dropButton.src = isOpen 
        ? '/front-end/global/resources/image/statusDropOff.png' 
        : '/front-end/global/resources/image/statusDropOn.png';
    });
});