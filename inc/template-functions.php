<?php
/**
 * Template Functions
 *
 * Helper functions for applying theme options to templates
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add dynamic body classes based on theme options
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function versana_body_classes( $classes ) {
    
    // Sticky Header
    if ( versana_get_option( 'enable_sticky_header' ) ) {
        $classes[] = 'has-sticky-header';
    }
    
    // Header Layout
    $header_layout = versana_get_option( 'header_layout', 'default' );
    $classes[] = 'header-layout-' . sanitize_html_class( $header_layout );
    
    return $classes;
}
add_filter( 'body_class', 'versana_body_classes' );