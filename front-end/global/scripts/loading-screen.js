var loadingScreen = document.getElementById("loadingScreen");

function hideLoadingScreen() {
    setTimeout(() => {
        loadingScreen.style.opacity = "0";
        setTimeout(() => {
            loadingScreen.style.display = "none";
        }, 500);
    }, 1000);
}

function waitForImages() {
    const images = document.images;
    const totalImages = images.length;
    let loadedImages = 0;

    if (totalImages === 0) {
        hideLoadingScreen();
        return;
    }

    for (let i = 0; i < totalImages; i++) {
        const img = images[i];
        
        if (img.complete) {
            loadedImages++;
        } else {
            img.addEventListener('load', imageLoaded);
            img.addEventListener('error', imageLoaded);
        }
    }

    if (loadedImages === totalImages) {
        hideLoadingScreen();
    }

    function imageLoaded() {
        loadedImages++;
        this.removeEventListener('load', imageLoaded);
        this.removeEventListener('error', imageLoaded);
        
        if (loadedImages === totalImages) {
            hideLoadingScreen();
        }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    waitForImages();
    
    setTimeout(hideLoadingScreen, 5000);
});

window.addEventListener("load", function() {
    setTimeout(waitForImages, 100);
});