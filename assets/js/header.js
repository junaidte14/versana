/**
 * Header JavaScript - WordPress Sticky Header Implementation
 */

(function() {
    'use strict';
    
    function initStickyHeader() {
        // Check if sticky header is enabled
        if (!document.body.classList.contains('has-sticky-header')) {
            return;
        }
        
        const header = document.querySelector('.site-header');
        if (!header) {
            return;
        }
        
        let lastScrollTop = 0;
        let headerHeight = header.offsetHeight;
        let scrollThreshold = 100;
        
        // Store header height as CSS variable
        document.documentElement.style.setProperty(
            '--header-height', 
            headerHeight + 'px'
        );
        
        function handleScroll() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            if (currentScroll > scrollThreshold) {
                document.body.classList.add('header-is-stuck');
            } else {
                document.body.classList.remove('header-is-stuck');
                header.classList.remove('header-hidden', 'header-visible');
            }
            
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }
        
        // Debounced scroll handler
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) {
                window.cancelAnimationFrame(scrollTimeout);
            }
            scrollTimeout = window.requestAnimationFrame(handleScroll);
        }, { passive: true });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStickyHeader);
    } else {
        initStickyHeader();
    }
    
})();