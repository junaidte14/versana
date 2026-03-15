<?php
/**
 * Versana Theme Functions
 *
 * @package Versana
 * @since 1.0.0
 */

// Theme setup
add_action( 'init', 'versana_register_pattern_categories' );
function versana_register_pattern_categories() {
    register_block_pattern_category(
        'versana-pages',
        array( 'label' => __( 'Versana Layout', 'versana' ) )
    );
    register_block_pattern_category(
        'versana-headers',
        array( 'label' => __( 'Versana Headers', 'versana' ) )
    );
    register_block_pattern_category(
        'versana-footers',
        array( 'label' => __( 'Versana Footers', 'versana' ) )
    );
}

// Include core files
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme Setup
 */
function versana_theme_setup() {
    // Add theme support features
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'versana_theme_setup' );