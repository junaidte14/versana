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
 *
 * @param array $input Raw input from form
 * @return array Sanitized options
 */
function versana_sanitize_options( $input ) {
    // CRITICAL FIX: Start with existing options to preserve values from other tabs
    $existing_options = get_option( 'versana_theme_options', array() );
    $sanitized = $existing_options;
    
    // Verify nonce for security
    if ( ! isset( $_POST['versana_options_nonce'] ) || 
         ! wp_verify_nonce( $_POST['versana_options_nonce'], 'versana_save_options' ) ) {
        add_settings_error(
            'versana_options',
            'versana_nonce_error',
            __( 'Security verification failed. Please try again.', 'versana' ),
            'error'
        );
        return $existing_options; // Return unchanged if nonce fails
    }
    
    // Check if reset was requested
    if ( isset( $_POST['versana_reset_options'] ) ) {
        add_settings_error(
            'versana_options',
            'versana_reset_success',
            __( 'Theme options have been reset to defaults.', 'versana' ),
            'updated'
        );
        return versana_get_default_options();
    }
    
    // Boolean fields (checkboxes) - update only if present in input
    $boolean_fields = array(
        // Header
        'enable_sticky_header',
        // Footer
        'enable_back_to_top',
    );
    
    // For checkboxes: if field exists in POST (even unchecked), update it
    // This handles the case where user unchecks a box
    foreach ( $boolean_fields as $field ) {
        // Check if this field's form was submitted (by checking if related fields exist)
        // We determine which tab by checking for tab-specific fields
        $is_header_tab = isset( $input['header_layout'] );
        $is_footer_tab = isset( $input['footer_copyright'] );
        
        // Only update boolean if it's from the current tab being saved
        if ( 
            ( $field === 'enable_sticky_header' && $is_header_tab ) ||
            ( $field === 'enable_back_to_top' && $is_footer_tab )
        ) {
            $sanitized[ $field ] = isset( $input[ $field ] ) ? (bool) $input[ $field ] : false;
        }
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
            $sanitized[ $field ] = in_array( $value, $allowed_values, true ) ? $value : ( $existing_options[ $field ] ?? $allowed_values[0] );
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
    $sanitized = apply_filters( 'versana_sanitize_options', $sanitized, $input );
    
    // Add success message
    add_settings_error(
        'versana_options',
        'versana_save_success',
        __( 'Settings saved successfully.', 'versana' ),
        'updated'
    );
    
    return $sanitized;
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