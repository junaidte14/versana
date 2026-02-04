/**
 * Blog JavaScript
 * Masonry Layout & Scroll Animations
 *
 * @package Versana
 * @since 1.0.0
 */

(function() {
    'use strict';
    
    /**
     * Simple Masonry Layout Implementation
     * Lightweight alternative to Masonry.js library
     */
    function initMasonryLayout() {
        const masonryContainer = document.querySelector('.blog-layout-masonry .blog-posts');
        
        if (!masonryContainer) {
            return;
        }
        
        const items = masonryContainer.querySelectorAll('.blog-post-card');
        
        if (items.length === 0) {
            return;
        }
        
        /**
         * Calculate masonry positions
         */
        function layoutMasonry() {
            // Get number of columns based on viewport
            const containerWidth = masonryContainer.offsetWidth;
            let columns = 3;
            
            if (window.innerWidth <= 781) {
                columns = 1;
            } else if (window.innerWidth <= 1024) {
                columns = 2;
            }
            
            // Calculate column width and gap
            const gap = 32; // 2rem in pixels
            const totalGaps = gap * (columns - 1);
            const columnWidth = (containerWidth - totalGaps) / columns;
            
            // Track column heights
            const columnHeights = new Array(columns).fill(0);
            
            // Position each item
            items.forEach(function(item, index) {
                // Find shortest column
                const shortestColumn = columnHeights.indexOf(Math.min(...columnHeights));
                
                // Calculate position
                const x = shortestColumn * (columnWidth + gap);
                const y = columnHeights[shortestColumn];
                
                // Apply position
                item.style.position = 'absolute';
                item.style.left = x + 'px';
                item.style.top = y + 'px';
                item.style.width = columnWidth + 'px';
                
                // Update column height
                columnHeights[shortestColumn] += item.offsetHeight + gap;
            });
            
            // Set container height
            const maxHeight = Math.max(...columnHeights);
            masonryContainer.style.height = maxHeight + 'px';
            
            // Mark as initialized
            masonryContainer.parentElement.classList.add('masonry-initialized');
        }
        
        /**
         * Debounced resize handler
         */
        let resizeTimeout;
        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(layoutMasonry, 150);
        }
        
        /**
         * Wait for images to load
         */
        function waitForImages() {
            const images = masonryContainer.querySelectorAll('img');
            let imagesLoaded = 0;
            
            if (images.length === 0) {
                layoutMasonry();
                return;
            }
            
            images.forEach(function(img) {
                if (img.complete) {
                    imagesLoaded++;
                    if (imagesLoaded === images.length) {
                        layoutMasonry();
                    }
                } else {
                    img.addEventListener('load', function() {
                        imagesLoaded++;
                        if (imagesLoaded === images.length) {
                            layoutMasonry();
                        }
                    });
                    
                    img.addEventListener('error', function() {
                        imagesLoaded++;
                        if (imagesLoaded === images.length) {
                            layoutMasonry();
                        }
                    });
                }
            });
        }
        
        // Initialize
        waitForImages();
        
        // Handle window resize
        window.addEventListener('resize', handleResize);
        
        // Re-layout on font load
        if (document.fonts) {
            document.fonts.ready.then(layoutMasonry);
        }
    }
    
    /**
     * Fade-in animations on scroll
     * Uses Intersection Observer for performance
     */
    function initScrollAnimations() {
        const fadeElements = document.querySelectorAll('.fade-in');
        
        if (fadeElements.length === 0) {
            return;
        }
        
        // Check for Intersection Observer support
        if (!('IntersectionObserver' in window)) {
            // Fallback: show all elements
            fadeElements.forEach(function(el) {
                el.classList.add('visible');
            });
            return;
        }
        
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px', // Trigger 100px before element enters viewport
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // Stop observing once visible
                }
            });
        }, observerOptions);
        
        fadeElements.forEach(function(el) {
            observer.observe(el);
        });
    }
    
    /**
     * Staggered children animations
     */
    function initStaggerAnimations() {
        const staggerContainers = document.querySelectorAll('.stagger-children');
        
        if (staggerContainers.length === 0) {
            return;
        }
        
        // Check for Intersection Observer support
        if (!('IntersectionObserver' in window)) {
            return;
        }
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animating');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });
        
        staggerContainers.forEach(function(container) {
            observer.observe(container);
        });
    }
    
    /**
     * Initialize all functions
     */
    function init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                initMasonryLayout();
                initScrollAnimations();
                initStaggerAnimations();
            });
        } else {
            initMasonryLayout();
            initScrollAnimations();
            initStaggerAnimations();
        }
    }
    
    // Initialize
    init();
    
})();