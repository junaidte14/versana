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
 * Replace [copyright] placeholder in blocks without using a shortcode
 */
function versana_filter_copyright_in_blocks( $block_content, $block ) {
    // Look for our specific paragraph class or the placeholder text
    if ( 
        isset( $block['attrs']['className'] ) && 
        'footer-copyright' === $block['attrs']['className'] && 
        str_contains( $block_content, '[copyright]' ) 
    ) {
        $dynamic_copyright = versana_get_copyright_text();
        $block_content = str_replace( '[copyright]', $dynamic_copyright, $block_content );
    }

    return $block_content;
}
add_filter( 'render_block', 'versana_filter_copyright_in_blocks', 10, 2 );

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