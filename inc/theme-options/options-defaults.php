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
        // Google Fonts Tab
        'google_fonts_enabled'     => false,
        'heading_font_google'      => '',
        'body_font_google'         => '',
        'preload_fonts'            => true,
        'font_display_swap'        => true,
        
        // Performance Tab
        'lazy_load_images'         => true,
        'preload_critical_fonts'   => true,
        'disable_emojis'           => false,
        'disable_embeds'           => false,
        'remove_query_strings'     => false,
        
        // Features Tab
        'enable_breadcrumbs'       => false,
        'enable_reading_time'      => false,
        'enable_share_buttons'     => false,
        'enable_toc'               => false,
        'enable_sticky_header'     => false,
        
        // Integrations Tab
        'google_analytics_id'      => '',
        'facebook_pixel_id'        => '',
        'google_tag_manager_id'    => '',
        'header_scripts'           => '',
        'footer_scripts'           => '',
        
        // Advanced Tab
        'custom_css'               => '',
        'enable_developer_mode'    => false,
        'disable_gutenberg_css'    => false,
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