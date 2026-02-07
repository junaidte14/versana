<?php
/**
 * Versana Default Theme Options
 *
 * Defines defaults for ADVANCED features only.
 * Design choices (colors, typography) are in theme.json.
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get default theme options
 *
 * These are ADVANCED settings that theme.json cannot handle.
 *
 * @return array Default options array
 */
function versana_get_default_options() {
    $defaults = array(
        // General Tab
        'enable_breadcrumbs'       => true,
        'enable_dark_mode'         => false,

        // Header Tab
        'header_layout'            => 'default',
        'enable_sticky_header'     => false,
        'enable_header_search'     => true,
        'enable_header_cta'        => false,

        // Footer Tab
        'enable_back_to_top'       => true,
        'footer_copyright'         => '',

        // Blog Tab
        'blog_layout'              => 'list',
        'blog_sidebar_position'    => 'right',
        'archive_layout'           => 'list',
        'enable_reading_time'      => true,
        'enable_share_buttons'     => true,
        'enable_author_box'        => true,
        'enable_related_posts'     => true,
        
        // Integrations Tab
        'google_analytics_id'      => '',
        'facebook_pixel_id'        => '',
        'google_tag_manager_id'    => '',
        'header_scripts'           => '',
        'footer_scripts'           => '',
        
        // Advanced Tab
        'custom_css'               => ''
    );
    
    /**
     * Filter default theme options
     *
     * Allows child themes to modify defaults.
     *
     * @param array $defaults Default options
     */
    return apply_filters( 'versana_default_options', $defaults );
}

/**
 * Get a single default option value
 *
 * @param string $key Option key
 * @return mixed Default value or null
 */
function versana_get_default_option( $key ) {
    $defaults = versana_get_default_options();
    return isset( $defaults[ $key ] ) ? $defaults[ $key ] : null;
}