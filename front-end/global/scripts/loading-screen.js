var loadingScreen = document.getElementById("loadingScreen");

window.addEventListener("load", function() {
    loadingScreen.style.opacity = "0";

    setTimeout(() => {
        loadingScreen.style.display = "none";
    }, 500);
});