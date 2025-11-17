document.addEventListener('DOMContentLoaded', function() {
    const slides = [
        '/front-end/global/resources/image/banner/banner1.jpg',
        '/front-end/global/resources/image/banner/banner2.jpg',
        '/front-end/global/resources/image/banner/banner3.jpg'
    ];
    
    const parallaxImage = document.querySelector('.parallaxImage');
    let currentSlide = 0;
    
    if (!parallaxImage) {
        console.error('Parallax image element not found');
        return;
    }
    
    console.log('Slideshow initialized with', slides.length, 'slides');
    
    parallaxImage.style.backgroundImage = `url('${slides[0]}')`;
    parallaxImage.style.backgroundSize = 'cover';
    parallaxImage.style.backgroundPosition = 'center';
    parallaxImage.style.backgroundRepeat = 'no-repeat';
    parallaxImage.style.transition = 'background-image 1.5s ease-in-out';
    
    slides.forEach(src => {
        const img = new Image();
        img.src = src;
    });
    
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        console.log('Changing to slide', currentSlide);
        
        parallaxImage.style.backgroundImage = `url('${slides[currentSlide]}')`;
        
    }, 5000);
});