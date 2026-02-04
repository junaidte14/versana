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

    // Blog Layout (on blog/archive pages)
    if ( is_home() || is_archive() || is_search() ) {
        $blog_layout = versana_get_option( 'blog_layout', 'list' );
        
        // Validate blog layout
        $valid_blog_layouts = array( 'list', 'grid', 'masonry' );
        if ( in_array( $blog_layout, $valid_blog_layouts, true ) ) {
            $classes[] = 'blog-layout-' . sanitize_html_class( $blog_layout );
        } else {
            $classes[] = 'blog-layout-list';
        }
        
        // Sidebar position
        $sidebar_position = versana_get_option( 'blog_sidebar_position', 'right' );
        $valid_positions = array( 'left', 'right', 'none' );
        if ( in_array( $sidebar_position, $valid_positions, true ) ) {
            $classes[] = 'sidebar-' . sanitize_html_class( $sidebar_position );
        }
    }
    
    return $classes;
}
add_filter( 'body_class', 'versana_body_classes' );