document.addEventListener('DOMContentLoaded', function() {
    const statusRows = document.querySelectorAll('.statusRow');

    statusRows.forEach(row => {
        const dropButton = row.querySelector('.dropDownButton');
        const bottomRow = row.querySelector('.rowBottom');

        if (dropButton && bottomRow) {
            dropButton.addEventListener('click', (event) => {
                event.stopPropagation();

                const isOpen = bottomRow.classList.contains('open');

                bottomRow.classList.toggle('open', !isOpen);

                dropButton.src = isOpen 
                    ? '/front-end/global/resources/image/icon/statusDropOff.png' 
                    : '/front-end/global/resources/image/icon/statusDropOn.png';
            });
        }
    });

    document.addEventListener('click', function() {
        document.querySelectorAll('.statusRow').forEach(row => {
            const dropButton = row.querySelector('.dropDownButton');
            const bottomRow = row.querySelector('.rowBottom');

            if (dropButton && bottomRow && bottomRow.classList.contains('open')) {
                bottomRow.classList.remove('open');
                dropButton.src = '/front-end/global/resources/image/icon/statusDropOff.png';
            }
        });
    });
});