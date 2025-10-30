var loadingScreen = document.getElementById("loadingScreen");

window.addEventListener("load", function(){
    setTimeout(() => loadingScreen.style.opacity = "0", 1000)
    setTimeout(() => loadingScreen.style.display = "none", 2000)
})