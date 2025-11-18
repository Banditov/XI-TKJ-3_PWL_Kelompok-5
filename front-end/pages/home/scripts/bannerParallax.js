// Parallax banner effect
class ParallaxBanner {
    constructor() {
        this.banner = document.getElementById('banner');
        this.parallaxBg = document.querySelector('.parallaxImage');
        this.bannerTitle = document.getElementById('bannerTitle');
        
        if (this.banner && this.parallaxBg) {
            this.init();
        }
    }
    
    init() {
        // Initial animation
        setTimeout(() => {
            this.banner.classList.add('visible');
        }, 100);
        
        // Parallax scroll effect
        window.addEventListener('scroll', this.handleScroll.bind(this));
        
        // Reset on resize
        window.addEventListener('resize', this.handleResize.bind(this));
    }
    
    handleScroll() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * 0.5; // Adjust this value for speed (0.3 = slower, 0.7 = faster)
        
        // Move background at different speed
        this.parallaxBg.style.transform = `translateY(${rate}px)`;
        
        // Optional: Fade out effect when scrolling down
        const opacity = 1 - (scrolled / 500);
        this.banner.style.opacity = Math.max(opacity, 0.3);
    }
    
    handleResize() {
        // Reset transformations on resize
        this.parallaxBg.style.transform = 'translateY(0)';
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new ParallaxBanner();
});