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
        // General
        'enable_breadcrumbs',
        'enable_dark_mode',
        
        // Header
        'enable_sticky_header',
        'enable_header_search',
        'enable_header_cta',
        
        // Footer
        'enable_back_to_top',
        
        // Blog
        'enable_reading_time',
        'enable_share_buttons',
        'enable_author_box',
        'enable_related_posts'
        
    );
    
    foreach ( $boolean_fields as $field ) {
        $sanitized[ $field ] = isset( $input[ $field ] ) ? (bool) $input[ $field ] : false;
    }
    
    // Select fields with allowed values
    $select_fields = array(
        'header_layout'          => array( 'default', 'centered' ),
        'blog_layout'            => array( 'list', '2col', '3col' ),
        'blog_sidebar_position'  => array( 'left', 'right', 'none' ),
        'archive_layout'         => array( 'list', '2col', '3col' ),
    );
    
    foreach ( $select_fields as $field => $allowed_values ) {
        if ( isset( $input[ $field ] ) ) {
            $value = sanitize_text_field( $input[ $field ] );
            $sanitized[ $field ] = in_array( $value, $allowed_values, true ) ? $value : $allowed_values[0];
        }
    }
    
    // Text fields
    $text_fields = array(
        'footer_copyright',
        'google_analytics_id',
        'facebook_pixel_id',
        'google_tag_manager_id',
    );
    
    foreach ( $text_fields as $field ) {
        if ( isset( $input[ $field ] ) ) {
            $sanitized[ $field ] = sanitize_text_field( $input[ $field ] );
        }
    }
    
    // Custom CSS (strip tags but allow CSS)
    if ( isset( $input['custom_css'] ) ) {
        $sanitized['custom_css'] = wp_strip_all_tags( $input['custom_css'] );
    }
    
    // Scripts (only for administrators with unfiltered_html capability)
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
     * Allows child themes to add custom sanitization.
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