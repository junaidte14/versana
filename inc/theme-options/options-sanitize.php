<?php
/**
 * Versana Theme Options Sanitization
 *
 * SECURITY CRITICAL: All user input must be sanitized.
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sanitize all theme options
 *
 * @param array $input Raw input from form
 * @return array Sanitized options
 */
function versana_sanitize_options( $input ) {
    $sanitized = array();
    
    // Boolean fields (checkboxes)
    $boolean_fields = array(
        'google_fonts_enabled',
        'preload_fonts',
        'font_display_swap',
        'lazy_load_images',
        'preload_critical_fonts',
        'disable_emojis',
        'disable_embeds',
        'remove_query_strings',
        'enable_breadcrumbs',
        'enable_reading_time',
        'enable_share_buttons',
        'enable_toc',
        'enable_sticky_header',
        'enable_developer_mode',
        'disable_gutenberg_css',
    );
    
    foreach ( $boolean_fields as $field ) {
        $sanitized[ $field ] = isset( $input[ $field ] ) ? (bool) $input[ $field ] : false;
    }
    
    // Text fields
    $text_fields = array(
        'heading_font_google',
        'body_font_google',
        'google_analytics_id',
        'facebook_pixel_id',
        'google_tag_manager_id',
    );
    
    foreach ( $text_fields as $field ) {
        if ( isset( $input[ $field ] ) ) {
            $sanitized[ $field ] = sanitize_text_field( $input[ $field ] );
        }
    }
    
    // Custom CSS
    if ( isset( $input['custom_css'] ) ) {
        $sanitized['custom_css'] = wp_strip_all_tags( $input['custom_css'] );
    }
    
    // Scripts (only for administrators)
    if ( current_user_can( 'unfiltered_html' ) ) {
        if ( isset( $input['header_scripts'] ) ) {
            $sanitized['header_scripts'] = $input['header_scripts'];
        }
        if ( isset( $input['footer_scripts'] ) ) {
            $sanitized['footer_scripts'] = $input['footer_scripts'];
        }
    }
    
    /**
     * Filter sanitized options
     *
     * @param array $sanitized Sanitized options
     * @param array $input Raw input
     */
    return apply_filters( 'versana_sanitize_options', $sanitized, $input );
}

/**
 * Validate Google Analytics ID format
 *
 * @param string $id Analytics ID
 * @return bool True if valid
 */
function versana_validate_analytics_id( $id ) {
    return preg_match( '/^(UA|G)-[0-9]+-[0-9]+$/', $id ) || preg_match( '/^G-[A-Z0-9]+$/', $id );
}