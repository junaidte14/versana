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
 * Get body classes based on theme options
 *
 * @param array $classes Existing body classes
 * @return array Modified body classes
 */
function versana_body_classes( $classes ) {
    
    // Sticky Header
    if ( versana_get_option( 'enable_sticky_header' ) ) {
        $classes[] = 'has-sticky-header';
    }
    
    // Header Layout
    $header_layout = versana_get_option( 'header_layout', 'default' );
    $classes[] = 'header-layout-' . $header_layout;
    
    // Mobile Menu Style
    $mobile_menu = versana_get_option( 'mobile_menu_style', 'default' );
    $classes[] = 'mobile-menu-' . $mobile_menu;
    
    return $classes;
}
add_filter( 'body_class', 'versana_body_classes' );

/**
 * Check if header search should be displayed
 */
function versana_show_header_search() {
    return versana_get_option( 'enable_header_search', false );
}

function versana_admin_bar_adjustment() {
    if ( is_admin_bar_showing() ) {
        ?>
        <style>
            .has-sticky-header.header-is-stuck .site-header {
                top: 32px;
            }
            @media screen and (max-width: 782px) {
                .has-sticky-header.header-is-stuck .site-header {
                    top: 46px;
                }
            }
        </style>
        <?php
    }
}
add_action( 'wp_head', 'versana_admin_bar_adjustment' );