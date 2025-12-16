<?php
/**
 * Versana Theme Options Admin Page
 *
 * Renders the admin interface for ADVANCED settings only.
 * Design customization happens in Site Editor.
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add theme options page to admin menu
 */
function versana_add_theme_options_page() {
    add_theme_page(
        __( 'Versana Options', 'versana' ),
        __( 'Theme Options', 'versana' ),
        'edit_theme_options',
        'versana-options',
        'versana_render_options_page',
        2
    );
}
add_action( 'admin_menu', 'versana_add_theme_options_page' );

/**
 * Render the main options page
 */
function versana_render_options_page() {
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'versana' ) );
    }
    
    $active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'fonts';
    
    $valid_tabs = array( 'fonts', 'performance', 'features', 'integrations', 'advanced' );
    if ( ! in_array( $active_tab, $valid_tabs, true ) ) {
        $active_tab = 'fonts';
    }
    
    ?>
    <div class="wrap versana-options-wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <div class="versana-options-header">
            <p class="description">
                <?php esc_html_e( 'Configure advanced features and settings. For design customization (colors, typography, spacing), use the Site Editor under Appearance → Editor.', 'versana' ); ?>
            </p>
            
            <a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>" class="button button-primary">
                <?php esc_html_e( 'Open Site Editor', 'versana' ); ?>
            </a>
        </div>
        
        <?php settings_errors(); ?>
        
        <h2 class="nav-tab-wrapper">
            <a href="?page=versana-options&tab=fonts" 
               class="nav-tab <?php echo $active_tab === 'fonts' ? 'nav-tab-active' : ''; ?>">
                <span class="dashicons dashicons-editor-textcolor"></span>
                <?php esc_html_e( 'Google Fonts', 'versana' ); ?>
            </a>
            <a href="?page=versana-options&tab=performance" 
               class="nav-tab <?php echo $active_tab === 'performance' ? 'nav-tab-active' : ''; ?>">
                <span class="dashicons dashicons-performance"></span>
                <?php esc_html_e( 'Performance', 'versana' ); ?>
            </a>
            <a href="?page=versana-options&tab=features" 
               class="nav-tab <?php echo $active_tab === 'features' ? 'nav-tab-active' : ''; ?>">
                <span class="dashicons dashicons-admin-plugins"></span>
                <?php esc_html_e( 'Features', 'versana' ); ?>
            </a>
            <a href="?page=versana-options&tab=integrations" 
               class="nav-tab <?php echo $active_tab === 'integrations' ? 'nav-tab-active' : ''; ?>">
                <span class="dashicons dashicons-admin-links"></span>
                <?php esc_html_e( 'Integrations', 'versana' ); ?>
            </a>
            <a href="?page=versana-options&tab=advanced" 
               class="nav-tab <?php echo $active_tab === 'advanced' ? 'nav-tab-active' : ''; ?>">
                <span class="dashicons dashicons-admin-generic"></span>
                <?php esc_html_e( 'Advanced', 'versana' ); ?>
            </a>
        </h2>
        
        <form method="post" action="options.php">
            <?php
            settings_fields( 'versana_options' );
            
            switch ( $active_tab ) {
                case 'performance':
                    versana_render_performance_tab();
                    break;
                case 'features':
                    versana_render_features_tab();
                    break;
                case 'integrations':
                    versana_render_integrations_tab();
                    break;
                case 'advanced':
                    versana_render_advanced_tab();
                    break;
                case 'fonts':
                default:
                    versana_render_fonts_tab();
                    break;
            }
            
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Render Google Fonts tab
 */
function versana_render_fonts_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Google Fonts Integration', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Load custom fonts from Google Fonts. Font selection will be added in the next episode.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Enable Google Fonts', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[google_fonts_enabled]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'google_fonts_enabled' ), true ); ?> />
                            <?php esc_html_e( 'Load fonts from Google Fonts', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Enable this to use Google Fonts instead of system fonts.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="heading_font_google">
                            <?php esc_html_e( 'Heading Font', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="heading_font_google" 
                               name="versana_theme_options[heading_font_google]" 
                               value="<?php echo esc_attr( versana_get_option( 'heading_font_google' ) ); ?>" 
                               class="regular-text" 
                               placeholder="<?php esc_attr_e( 'e.g., Inter', 'versana' ); ?>" />
                        <p class="description">
                            <?php esc_html_e( 'Google Font name for headings. We\'ll add a font picker in Episode 20.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="body_font_google">
                            <?php esc_html_e( 'Body Font', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="body_font_google" 
                               name="versana_theme_options[body_font_google]" 
                               value="<?php echo esc_attr( versana_get_option( 'body_font_google' ) ); ?>" 
                               class="regular-text" 
                               placeholder="<?php esc_attr_e( 'e.g., Roboto', 'versana' ); ?>" />
                        <p class="description">
                            <?php esc_html_e( 'Google Font name for body text.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Font Display', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[font_display_swap]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'font_display_swap' ), true ); ?> />
                            <?php esc_html_e( 'Use font-display: swap', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Prevents invisible text while fonts load. Recommended for performance.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Preload Fonts', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[preload_fonts]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'preload_fonts' ), true ); ?> />
                            <?php esc_html_e( 'Preload critical font files', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Improves performance by loading fonts earlier. Recommended.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render Performance tab
 */
function versana_render_performance_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Performance Optimization', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Optimize your site for speed and performance.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Image Optimization', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[lazy_load_images]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'lazy_load_images' ), true ); ?> />
                            <?php esc_html_e( 'Enable lazy loading for images', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Images load only when they\'re about to enter the viewport.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Font Loading', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[preload_critical_fonts]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'preload_critical_fonts' ), true ); ?> />
                            <?php esc_html_e( 'Preload critical fonts', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Loads essential fonts earlier for faster text rendering.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Disable Emojis', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[disable_emojis]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'disable_emojis' ), true ); ?> />
                            <?php esc_html_e( 'Remove WordPress emoji scripts', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Reduces HTTP requests. Modern browsers support emojis natively.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Disable Embeds', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[disable_embeds]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'disable_embeds' ), true ); ?> />
                            <?php esc_html_e( 'Remove WordPress embed scripts', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Disables oEmbed discovery. Only disable if you don\'t use embeds.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Query Strings', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[remove_query_strings]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'remove_query_strings' ), true ); ?> />
                            <?php esc_html_e( 'Remove query strings from static resources', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Some caching systems cache better without query strings.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render Features tab
 */
function versana_render_features_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Theme Features', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Enable or disable theme features. These will be built in future episodes.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Breadcrumbs', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_breadcrumbs]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_breadcrumbs' ), true ); ?> />
                            <?php esc_html_e( 'Show breadcrumb navigation', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Displays breadcrumb trail for better navigation and SEO.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Reading Time', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_reading_time]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_reading_time' ), true ); ?> />
                            <?php esc_html_e( 'Show estimated reading time', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Displays estimated reading time for posts and pages.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Share Buttons', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_share_buttons]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_share_buttons' ), true ); ?> />
                            <?php esc_html_e( 'Show social share buttons', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Adds social sharing buttons to posts.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Table of Contents', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_toc]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_toc' ), true ); ?> />
                            <?php esc_html_e( 'Auto-generate table of contents', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Automatically creates TOC from headings in long posts.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Sticky Header', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_sticky_header]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_sticky_header' ), true ); ?> />
                            <?php esc_html_e( 'Make header sticky on scroll', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Header stays visible when scrolling down the page.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render Integrations tab
 */
function versana_render_integrations_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Third-Party Integrations', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Connect your site with third-party services.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="google_analytics_id">
                            <?php esc_html_e( 'Google Analytics', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="google_analytics_id" 
                               name="versana_theme_options[google_analytics_id]" 
                               value="<?php echo esc_attr( versana_get_option( 'google_analytics_id' ) ); ?>" 
                               class="regular-text" 
                               placeholder="<?php esc_attr_e( 'G-XXXXXXXXXX or UA-XXXXXX-X', 'versana' ); ?>" />
                        <p class="description">
                            <?php esc_html_e( 'Enter your Google Analytics Measurement ID or Tracking ID.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="google_tag_manager_id">
                            <?php esc_html_e( 'Google Tag Manager', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="google_tag_manager_id" 
                               name="versana_theme_options[google_tag_manager_id]" 
                               value="<?php echo esc_attr( versana_get_option( 'google_tag_manager_id' ) ); ?>" 
                               class="regular-text" 
                               placeholder="<?php esc_attr_e( 'GTM-XXXXXX', 'versana' ); ?>" />
                        <p class="description">
                            <?php esc_html_e( 'Enter your Google Tag Manager container ID.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="facebook_pixel_id">
                            <?php esc_html_e( 'Facebook Pixel', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="facebook_pixel_id" 
                               name="versana_theme_options[facebook_pixel_id]" 
                               value="<?php echo esc_attr( versana_get_option( 'facebook_pixel_id' ) ); ?>" 
                               class="regular-text" 
                               placeholder="<?php esc_attr_e( 'XXXXXXXXXXXXXXXX', 'versana' ); ?>" />
                        <p class="description">
                            <?php esc_html_e( 'Enter your Facebook Pixel ID for conversion tracking.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
                <tr>
                    <th scope="row">
                        <label for="header_scripts">
                            <?php esc_html_e( 'Header Scripts', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <textarea id="header_scripts" 
                                  name="versana_theme_options[header_scripts]" 
                                  rows="5" 
                                  class="large-text code"><?php echo esc_textarea( versana_get_option( 'header_scripts' ) ); ?></textarea>
                        <p class="description">
                            <?php esc_html_e( 'Scripts added here will be inserted into the <head> section. Include <script> tags.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="footer_scripts">
                            <?php esc_html_e( 'Footer Scripts', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <textarea id="footer_scripts" 
                                  name="versana_theme_options[footer_scripts]" 
                                  rows="5" 
                                  class="large-text code"><?php echo esc_textarea( versana_get_option( 'footer_scripts' ) ); ?></textarea>
                        <p class="description">
                            <?php esc_html_e( 'Scripts added here will be inserted before </body>. Include <script> tags.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                <?php else : ?>
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Custom Scripts', 'versana' ); ?>
                    </th>
                    <td>
                        <p class="description">
                            <?php esc_html_e( 'Custom script fields are only available to administrators for security reasons.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render Advanced tab
 */
function versana_render_advanced_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Advanced Options', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Advanced settings for developers and power users.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="custom_css">
                            <?php esc_html_e( 'Custom CSS', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <textarea id="custom_css" 
                                  name="versana_theme_options[custom_css]" 
                                  rows="10" 
                                  class="large-text code"><?php echo esc_textarea( versana_get_option( 'custom_css' ) ); ?></textarea>
                        <p class="description">
                            <?php esc_html_e( 'Add custom CSS that will be applied to your site. Do not include <style> tags.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Developer Mode', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_developer_mode]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_developer_mode' ), true ); ?> />
                            <?php esc_html_e( 'Enable developer mode', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Shows additional debugging information. Only enable during development.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Gutenberg CSS', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[disable_gutenberg_css]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'disable_gutenberg_css' ), true ); ?> />
                            <?php esc_html_e( 'Disable default Gutenberg block CSS', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'For advanced users who want complete control over block styles.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="versana-reset-section">
            <h3><?php esc_html_e( 'Reset Options', 'versana' ); ?></h3>
            <p class="description">
                <?php esc_html_e( 'Reset all theme options to their default values. This action cannot be undone.', 'versana' ); ?>
            </p>
            <button type="button" class="button button-secondary versana-reset-options">
                <?php esc_html_e( 'Reset to Defaults', 'versana' ); ?>
            </button>
        </div>
    </div>
    <?php
}