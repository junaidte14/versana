<?php
/**
 * Versana Default Theme Options - V1.0.0 Simplified
 *
 * Core features only - Pro features removed for future versions
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
 * V1.0.0: Core blog features only
 *
 * @return array Default options array
 */
function versana_get_default_options() {
    $defaults = array(
        // Header Tab
        'header_layout'            => 'default',
        'enable_sticky_header'     => false,

        // Footer Tab
        'enable_back_to_top'       => true,
        'footer_copyright'         => '&copy; {year} {site_name}. All rights reserved.',

        // Blog Tab
        'blog_layout'              => 'list',
        'blog_sidebar_position'    => 'right',
        'archive_layout'           => 'list',
        
        // Integrations Tab
        'google_analytics_id'      => '',
        'facebook_pixel_id'        => '',
        'google_tag_manager_id'    => '',
        'header_scripts'           => '',
        'footer_scripts'           => '',
        
        // Advanced Tab
        'custom_css'               => '',
    );
    
    /**
     * Filter default theme options
     *
     * Allows child themes and plugins to modify defaults.
     *
     * @since 1.0.0
     *
     * @param array $defaults Default options
     */
    return apply_filters( 'versana_default_options', $defaults );
}

/**
 * Get a single default option value
 *
 * @since 1.0.0
 *
 * @param string $key Option key
 * @return mixed Default value or null
 */
function versana_get_default_option( $key ) {
    $defaults = versana_get_default_options();
    return isset( $defaults[ $key ] ) ? $defaults[ $key ] : null;
}