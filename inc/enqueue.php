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
}
add_action( 'wp_enqueue_scripts', 'versana_enqueue_dynamic_assets' );