<?php
/**
 * Footer Helper Functions
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get copyright text with dynamic year replacement
 *
 * @return string Copyright text
 */
function versana_get_copyright_text() {
    $copyright = versana_get_option( 'footer_copyright', '&copy; {year} ' . get_bloginfo( 'name' ) . '. All rights reserved.' );
    
    // Replace {year} placeholder with current year
    $copyright = str_replace( '{year}', date( 'Y' ), $copyright );
    
    // Also support %year% for backwards compatibility
    $copyright = str_replace( '%year%', date( 'Y' ), $copyright );

    $copyright = str_replace( '{site_name}', get_bloginfo( 'name' ), $copyright );
    
    return $copyright;
}

/**
 * Render copyright text shortcode
 * Usage: [copyright]
 *
 * @return string Copyright text
 */
function versana_copyright_shortcode() {
    return versana_get_copyright_text();
}
add_shortcode( 'copyright', 'versana_copyright_shortcode' );

/**
 * Render back to top button
 * Only renders if enabled in theme options
 */
function versana_render_back_to_top() {
    if ( ! versana_get_option( 'enable_back_to_top' ) ) {
        return;
    }
    ?>
    <button class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'versana' ); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 4l-8 8h5v8h6v-8h5z"/>
        </svg>
    </button>
    <?php
}

/**
 * Add back to top button to footer
 * Hooked to wp_footer
 */
function versana_add_back_to_top() {
    versana_render_back_to_top();
}
add_action( 'wp_footer', 'versana_add_back_to_top', 999 );

/**
 * Get current year shortcode
 * Usage: [year]
 *
 * @return string Current year
 */
function versana_year_shortcode() {
    return date( 'Y' );
}
add_shortcode( 'year', 'versana_year_shortcode' );

/**
 * Get site name shortcode
 * Usage: [site_name]
 *
 * @return string Site name
 */
function versana_site_name_shortcode() {
    return get_bloginfo( 'name' );
}
add_shortcode( 'site_name', 'versana_site_name_shortcode' );