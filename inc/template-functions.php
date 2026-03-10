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
    $classes[] = 'header-layout-default';
    // Blog Layout (on blog/archive pages)
    if ( is_home() || is_archive() || is_search() || is_singular() ) {
        $classes[] = 'has-sidebar sidebar-right';
    }
    // Blog Layout (on blog/home blog pages)
    if ( is_home()) {
        $classes[] = 'blog-layout-list';
    }
    if ( is_archive() || is_search() ) {
        $classes[] = 'archive-layout-list';
    }
    return $classes;
}
add_filter( 'body_class', 'versana_body_classes', 10 );