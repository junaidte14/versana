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
        'versana-sections',
        array( 'label' => __( 'Versana Sections', 'versana' ) )
    );
}

/**
 * Load theme options system
 *
 * Files are loaded in specific order for dependencies.
 * Only admin page loads in admin area (conditional loading).
 */
$theme_options_path = get_template_directory() . '/inc/theme-options/';

// Load in order of dependency
if ( file_exists( $theme_options_path . 'options-defaults.php' ) ) {
    require_once $theme_options_path . 'options-defaults.php';
}

if ( file_exists( $theme_options_path . 'options-sanitize.php' ) ) {
    require_once $theme_options_path . 'options-sanitize.php';
}

if ( file_exists( $theme_options_path . 'options-init.php' ) ) {
    require_once $theme_options_path . 'options-init.php';
}

// Admin page (conditional - only in admin)
if ( is_admin() && file_exists( $theme_options_path . 'options-page.php' ) ) {
    require_once $theme_options_path . 'options-page.php';
}

// Frontend output
if ( file_exists( $theme_options_path . 'options-output.php' ) ) {
    require_once $theme_options_path . 'options-output.php';
}

// Google Fonts integration (will be built in Episode 20)
if ( file_exists( $theme_options_path . 'options-google-fonts.php' ) ) {
    require_once $theme_options_path . 'options-google-fonts.php';
}