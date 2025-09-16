document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault(); // stop the form from refreshing

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    // Only redirect if both fields have values
    if (email && password) {
    window.location.href = "/Home/home.html"; 
    }
});