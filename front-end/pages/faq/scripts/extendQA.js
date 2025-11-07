const img = document.getElementById("extendQAIcon");
const button = document.getElementById('extendQA');
const hiddenItems = document.querySelectorAll('.qaRow.hiddenRow');
let expanded = false;

button.addEventListener('click', () => {
    expanded = !expanded;

    hiddenItems.forEach(item => {
        if (expanded) {
            item.classList.remove('hiddenRow');
        } else {
            item.classList.add('hiddenRow');
        }
    });

    img.style.transform = expanded ? 'rotate(180deg)' : 'rotate(0deg)';
});