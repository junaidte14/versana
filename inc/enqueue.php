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

function versana_enqueue_dynamic_assets() {
    
    // Only enqueue if sticky header is enabled
    if ( versana_get_option( 'enable_sticky_header' ) ) {
        wp_enqueue_style(
            'versana-header',
            get_template_directory_uri() . '/assets/css/header.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
        
        wp_enqueue_script(
            'versana-header',
            get_template_directory_uri() . '/assets/js/header.js',
            array(),
            wp_get_theme()->get( 'Version' ),
            true // Load in footer
        );
    }
}
add_action( 'wp_enqueue_scripts', 'versana_enqueue_dynamic_assets' );