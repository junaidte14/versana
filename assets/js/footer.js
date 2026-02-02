/**
 * Footer JavaScript
 * Back to Top Button Functionality
 *
 * @package Versana
 * @since 1.0.0
 */

(function() {
    'use strict';
    
    /**
     * Initialize back to top button
     */
    function initBackToTop() {
        const backToTopButton = document.querySelector('.back-to-top');
        
        if (!backToTopButton) {
            return;
        }
        
        const scrollThreshold = 300; // Show button after scrolling 300px
        
        /**
         * Handle scroll events
         */
        function handleScroll() {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollPosition > scrollThreshold) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        }
        
        /**
         * Scroll to top smoothly
         */
        function scrollToTop(e) {
            e.preventDefault();
            
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            
            // Return focus to top of page for accessibility
            setTimeout(function() {
                // Focus on skip link or first focusable element
                const skipLink = document.querySelector('.skip-link');
                if (skipLink) {
                    skipLink.focus();
                }
            }, 500);
        }
        
        // Listen for scroll events (debounced with requestAnimationFrame)
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) {
                window.cancelAnimationFrame(scrollTimeout);
            }
            scrollTimeout = window.requestAnimationFrame(handleScroll);
        }, { passive: true });
        
        // Listen for button click
        backToTopButton.addEventListener('click', scrollToTop);
        
        // Keyboard accessibility - Enter or Space key
        backToTopButton.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                scrollToTop(e);
            }
        });
        
        // Initial check
        handleScroll();
    }
    
    /**
     * Initialize when DOM is ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBackToTop);
    } else {
        initBackToTop();
    }
    
})();