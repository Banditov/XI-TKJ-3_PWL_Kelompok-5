document.querySelectorAll('.dropDownButton').forEach(button => {
    button.addEventListener('click', e => {
        e.stopPropagation();
        const parentRow = button.closest('.parentRow');
        const parentId = parentRow.dataset.parentId;
        const isActive = !parentRow.classList.contains('active');

        document.querySelectorAll('.parentRow.active').forEach(parent => {
            parent.classList.remove('active');
            document.querySelectorAll(`.childRow[data-parent-id="${parent.dataset.parentId}"]`)
                .forEach(child => child.classList.remove('show'));
        });

        parentRow.classList.toggle('active', isActive);
        document.querySelectorAll(`.childRow[data-parent-id="${parentId}"]`)
            .forEach(child => child.classList.toggle('show', isActive));
    });
});