<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Versana
 * @since 1.0.0
 */

if ( !defined('ABSPATH') ) {
    exit;
}

/**
 * Enqueue dynamic header assets
 * Loads CSS/JS only when features are enabled
 */
function versana_enqueue_dynamic_assets() {

    wp_enqueue_style( 'versana-style', get_stylesheet_uri() );
    
    /**
     * Blog Specific Assets
     * Load on: blog index, archives, search, single posts
     */
    if ( is_home() || is_archive() || is_search() || is_singular()) {
        wp_enqueue_style(
            'versana-blog',
            get_template_directory_uri() . '/assets/css/blog.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }

    /**
     * Single Post Assets
     * Enhanced styling for individual blog posts
     */
    if ( is_singular( 'post' ) ) {
        wp_enqueue_style(
            'versana-single',
            get_template_directory_uri() . '/assets/css/single.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }
    
    // Patterns CSS
    wp_enqueue_style(
        'versana-patterns',
        get_template_directory_uri() . '/assets/css/patterns.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Footer CSS - Always load for consistent footer styling
    wp_enqueue_style(
        'versana-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

}
add_action( 'wp_enqueue_scripts', 'versana_enqueue_dynamic_assets' );