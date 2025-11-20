document.addEventListener('DOMContentLoaded', function() {
    const logOutButton = document.getElementById('logOut');
    const confirmPopUp = document.getElementById('confirmPopUp');
    const confirmFalseButton = document.querySelector('#confirmButton.false');
    const confirmTrueButton = document.querySelector('#confirmButton.true');

    logOutButton.addEventListener('click', function() {
        confirmPopUp.style.display = 'flex';
        setTimeout(() => confirmPopUp.style.opacity = "1", 100)
    });

    confirmFalseButton.addEventListener('click', function() {
        closePopup();
    });

    confirmTrueButton.addEventListener('click', function() {
        performLogout();
    });

    confirmPopUp.addEventListener('click', function(e) {
        if (e.target === confirmPopUp) {
            closePopup();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && confirmPopUp.style.display === 'flex') {
            closePopup();
        }
    });

    function closePopup() {
        confirmPopUp.style.opacity = "0";
        setTimeout(() => confirmPopUp.style.display = 'none', 300)
    }

    function performLogout() {
        const originalText = confirmTrueButton.textContent;
        confirmTrueButton.textContent = 'Logging out';
        confirmTrueButton.disabled = true;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/back-end/actions/users/logout.php';
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'csrf_token';
            input.value = csrfToken.getAttribute('content');
            form.appendChild(input);
        }
        
        document.body.appendChild(form);
        form.submit();
    }
});