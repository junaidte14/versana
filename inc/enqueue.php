<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue dynamic header assets
 * Loads CSS/JS only when features are enabled
 */
function versana_enqueue_dynamic_assets() {
    
    // Check if any header customization is active
    $sticky_enabled = versana_get_option( 'enable_sticky_header' );
    $header_layout = versana_get_option( 'header_layout', 'default' );
    
    // Load header CSS if sticky header OR non-default layout is active
    if ( $sticky_enabled || $header_layout !== 'default' ) {
        wp_enqueue_style(
            'versana-header',
            get_template_directory_uri() . '/assets/css/header.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }
    
    // Load header JavaScript only if sticky header is enabled
    if ( $sticky_enabled ) {
        wp_enqueue_script(
            'versana-header',
            get_template_directory_uri() . '/assets/js/header.js',
            array(),
            wp_get_theme()->get( 'Version' ),
            true
        );
    }

    /**
     * Home Page Specific Assets
     */
    if ( is_front_page() ) {
        wp_enqueue_style(
            'versana-home',
            get_template_directory_uri() . '/assets/css/home.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }

    /**
     * Blog Specific Assets
     * Loads on the main blog feed and individual post pages
     */
    if ( is_home() || is_singular( 'post' ) ) {
        // Enqueue Blog CSS
        wp_enqueue_style(
            'versana-blog',
            get_template_directory_uri() . '/assets/css/blog.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );

        // Enqueue Blog JS
        wp_enqueue_script(
            'versana-blog',
            get_template_directory_uri() . '/assets/js/blog.js',
            array(), // Add 'jquery' here if your JS depends on it
            wp_get_theme()->get( 'Version' ),
            true
        );
    }
    
    // Footer CSS - Always load for consistent footer styling
    wp_enqueue_style(
        'versana-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );
    
    // Footer JavaScript - Only if back-to-top is enabled
    if ( versana_get_option( 'enable_back_to_top' ) ) {
        wp_enqueue_script(
            'versana-footer',
            get_template_directory_uri() . '/assets/js/footer.js',
            array(),
            wp_get_theme()->get( 'Version' ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'versana_enqueue_dynamic_assets' );