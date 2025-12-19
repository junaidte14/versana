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
        __( 'Versana Theme Options', 'versana' ),
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
    
    // Get registered tabs
    $tabs = versana_get_option_tabs();
    
    // Get active tab
    $active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
    
    // Default to first tab if invalid
    if ( ! isset( $tabs[ $active_tab ] ) ) {
        $active_tab = array_key_first( $tabs );
    }
    
    ?>
    <div class="wrap versana-options-wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <div class="versana-options-header">
            <div class="versana-header-info">
                <p class="description">
                    <?php esc_html_e( 'For design customization (colors, typography, spacing), use the Site Editor.', 'versana' ); ?>
                </p>
                
                <div class="versana-quick-links">
                    <a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>" class="button button-primary">
                        <span class="dashicons dashicons-welcome-write-blog"></span>
                        <?php esc_html_e( 'Open Site Editor', 'versana' ); ?>
                    </a>
                    
                    <a href="<?php echo esc_url( admin_url( 'site-editor.php?path=/patterns' ) ); ?>" class="button">
                        <span class="dashicons dashicons-screenoptions"></span>
                        <?php esc_html_e( 'Manage Patterns', 'versana' ); ?>
                    </a>
                </div>
            </div>
        </div>
        
        <?php settings_errors(); ?>
        
        <!-- Dynamic Tab Navigation -->
        <h2 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $tab_key => $tab_config ) : ?>
                <a href="?page=versana-options&tab=<?php echo esc_attr( $tab_key ); ?>" 
                   class="nav-tab <?php echo $active_tab === $tab_key ? 'nav-tab-active' : ''; ?>">
                    <?php if ( ! empty( $tab_config['icon'] ) ) : ?>
                        <span class="dashicons <?php echo esc_attr( $tab_config['icon'] ); ?>"></span>
                    <?php endif; ?>
                    <?php echo esc_html( $tab_config['title'] ); ?>
                </a>
            <?php endforeach; ?>
        </h2>
        
        <!-- Tab Content -->
        <form method="post" action="options.php">
            <?php
            settings_fields( 'versana_options' );
            
            // Render active tab
            if ( isset( $tabs[ $active_tab ]['callback'] ) && is_callable( $tabs[ $active_tab ]['callback'] ) ) {
                /**
                 * Action before tab content
                 *
                 * @param string $active_tab Current active tab
                 */
                do_action( 'versana_before_tab_content', $active_tab );
                
                call_user_func( $tabs[ $active_tab ]['callback'] );
                
                /**
                 * Action after tab content
                 *
                 * @param string $active_tab Current active tab
                 */
                do_action( 'versana_after_tab_content', $active_tab );
            } else {
                echo '<div class="notice notice-error"><p>' . esc_html__( 'Tab callback not found.', 'versana' ) . '</p></div>';
            }
            
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function versana_render_general_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Theme Features', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Enable or disable theme features to customize functionality.', 'versana' ); ?>
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
                            <?php esc_html_e( 'Displays navigation path (Home > Blog > Post). Good for SEO and UX.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Dark Mode', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_dark_mode]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_dark_mode' ), true ); ?> />
                            <?php esc_html_e( 'Enable dark mode toggle', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Adds dark mode switcher. Coming in future episodes!', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
    <?php
}

/**
 * Render Header Tab
 */
function versana_render_header_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Header Settings', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Configure header appearance and functionality.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <!-- Header Layout -->
                <tr>
                    <th scope="row">
                        <label for="header_layout">
                            <?php esc_html_e( 'Header Layout', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="header_layout" name="versana_theme_options[header_layout]">
                            <option value="default" <?php selected( versana_get_option( 'header_layout' ), 'default' ); ?>>
                                <?php esc_html_e( 'Default (Logo Left, Menu Right)', 'versana' ); ?>
                            </option>
                            <option value="centered" <?php selected( versana_get_option( 'header_layout' ), 'centered' ); ?>>
                                <?php esc_html_e( 'Centered (Logo & Menu Centered)', 'versana' ); ?>
                            </option>
                            <option value="minimal" <?php selected( versana_get_option( 'header_layout' ), 'minimal' ); ?>>
                                <?php esc_html_e( 'Minimal (Logo Only, Hamburger Menu)', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Choose your header layout style.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Sticky Header -->
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
                            <?php esc_html_e( 'Make header stick to top on scroll', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Header remains visible when scrolling down. Great for navigation accessibility.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Search Integration -->
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Header Search', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_header_search]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_header_search' ), true ); ?> />
                            <?php esc_html_e( 'Show search in header', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Displays search form in header area.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Header CTA Button -->
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'CTA Button', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_header_cta]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_header_cta' ), true ); ?> />
                            <?php esc_html_e( 'Show call-to-action button in header', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Configure button in Site Editor → Header template.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Mobile Menu Style -->
                <tr>
                    <th scope="row">
                        <label for="mobile_menu_style">
                            <?php esc_html_e( 'Mobile Menu Style', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="mobile_menu_style" name="versana_theme_options[mobile_menu_style]">
                            <option value="overlay" <?php selected( versana_get_option( 'mobile_menu_style' ), 'overlay' ); ?>>
                                <?php esc_html_e( 'Full Screen Overlay', 'versana' ); ?>
                            </option>
                            <option value="drawer" <?php selected( versana_get_option( 'mobile_menu_style' ), 'drawer' ); ?>>
                                <?php esc_html_e( 'Slide-in Drawer', 'versana' ); ?>
                            </option>
                            <option value="default" <?php selected( versana_get_option( 'mobile_menu_style' ), 'default' ); ?>>
                                <?php esc_html_e( 'WordPress Default', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Choose mobile menu behavior.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php
        /**
         * Action to add custom header settings
         *
         * Child themes can use this to add their own header options.
         *
         * Example:
         * add_action( 'versana_header_tab_settings', 'child_add_header_logo_settings' );
         */
        do_action( 'versana_header_tab_settings' );
        ?>
    </div>
    <?php
}

/**
 * Render Footer Tab
 */
function versana_render_footer_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Footer Settings', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Configure footer layout and content.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <!-- Footer Columns -->
                <tr>
                    <th scope="row">
                        <label for="footer_columns">
                            <?php esc_html_e( 'Footer Columns', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="footer_columns" name="versana_theme_options[footer_columns]">
                            <option value="1" <?php selected( versana_get_option( 'footer_columns' ), '1' ); ?>>
                                <?php esc_html_e( '1 Column', 'versana' ); ?>
                            </option>
                            <option value="2" <?php selected( versana_get_option( 'footer_columns' ), '2' ); ?>>
                                <?php esc_html_e( '2 Columns', 'versana' ); ?>
                            </option>
                            <option value="3" <?php selected( versana_get_option( 'footer_columns' ), '3' ); ?>>
                                <?php esc_html_e( '3 Columns', 'versana' ); ?>
                            </option>
                            <option value="4" <?php selected( versana_get_option( 'footer_columns' ), '4' ); ?>>
                                <?php esc_html_e( '4 Columns', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Number of widget columns in footer.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Footer Widget Areas -->
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Widget Areas', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_footer_widgets]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_footer_widgets', true ), true ); ?> />
                            <?php esc_html_e( 'Enable footer widget areas', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Adds widget-ready areas to footer.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Back to Top Button -->
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Back to Top Button', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_back_to_top]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_back_to_top' ), true ); ?> />
                            <?php esc_html_e( 'Show back to top button', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Floating button to scroll to top. Appears after scrolling down.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <!-- Footer Copyright -->
                <tr>
                    <th scope="row">
                        <label for="footer_copyright">
                            <?php esc_html_e( 'Copyright Text', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" 
                               id="footer_copyright" 
                               name="versana_theme_options[footer_copyright]" 
                               value="<?php echo esc_attr( versana_get_option( 'footer_copyright' ) ); ?>" 
                               class="regular-text" />
                        <p class="description">
                            <?php esc_html_e( 'Enter your copyright text. You can use %year% to display the current year automatically.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php
        /**
         * Action to add custom footer settings
         * * Child themes can use this to add their own footer options.
         */
        do_action( 'versana_footer_tab_settings' );
        ?>
    </div>
    <?php
}

/**
 * Render Blog Tab
 */
function versana_render_blog_tab() {
    ?>
    <div class="versana-tab-content">
        <h2><?php esc_html_e( 'Blog Settings', 'versana' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'Customize the appearance of your blog posts and archive pages.', 'versana' ); ?>
        </p>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="blog_layout">
                            <?php esc_html_e( 'Blog Layout', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="blog_layout" name="versana_theme_options[blog_layout]">
                            <option value="list" <?php selected( versana_get_option( 'blog_layout' ), 'list' ); ?>>
                                <?php esc_html_e( 'Standard List', 'versana' ); ?>
                            </option>
                            <option value="grid" <?php selected( versana_get_option( 'blog_layout' ), 'grid' ); ?>>
                                <?php esc_html_e( 'Grid Layout', 'versana' ); ?>
                            </option>
                            <option value="masonry" <?php selected( versana_get_option( 'blog_layout' ), 'masonry' ); ?>>
                                <?php esc_html_e( 'Masonry Grid', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Select the layout for your main blog feed.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="blog_sidebar_position">
                            <?php esc_html_e( 'Sidebar Position', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="blog_sidebar_position" name="versana_theme_options[blog_sidebar_position]">
                            <option value="right" <?php selected( versana_get_option( 'blog_sidebar_position' ), 'right' ); ?>>
                                <?php esc_html_e( 'Right Sidebar', 'versana' ); ?>
                            </option>
                            <option value="left" <?php selected( versana_get_option( 'blog_sidebar_position' ), 'left' ); ?>>
                                <?php esc_html_e( 'Left Sidebar', 'versana' ); ?>
                            </option>
                            <option value="none" <?php selected( versana_get_option( 'blog_sidebar_position' ), 'none' ); ?>>
                                <?php esc_html_e( 'No Sidebar (Full Width)', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Choose where to display the sidebar on blog pages.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="archive_layout">
                            <?php esc_html_e( 'Archive Layout', 'versana' ); ?>
                        </label>
                    </th>
                    <td>
                        <select id="archive_layout" name="versana_theme_options[archive_layout]">
                            <option value="inherit" <?php selected( versana_get_option( 'archive_layout' ), 'inherit' ); ?>>
                                <?php esc_html_e( 'Same as Blog Layout', 'versana' ); ?>
                            </option>
                            <option value="list" <?php selected( versana_get_option( 'archive_layout' ), 'list' ); ?>>
                                <?php esc_html_e( 'Standard List', 'versana' ); ?>
                            </option>
                            <option value="grid" <?php selected( versana_get_option( 'archive_layout' ), 'grid' ); ?>>
                                <?php esc_html_e( 'Grid Layout', 'versana' ); ?>
                            </option>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'Select the layout for category, tag, and date archives.', 'versana' ); ?>
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
                            <?php esc_html_e( 'Displays "5 min read" on posts. Improves user experience.', 'versana' ); ?>
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
                            <?php esc_html_e( 'Adds share buttons for Facebook, Twitter, LinkedIn, WhatsApp.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Author Box', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_author_box]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_author_box' ), true ); ?> />
                            <?php esc_html_e( 'Show author bio box', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Displays author bio, avatar, and social links at end of posts.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <?php esc_html_e( 'Related Posts', 'versana' ); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   name="versana_theme_options[enable_related_posts]" 
                                   value="1" 
                                   <?php checked( versana_get_option( 'enable_related_posts' ), true ); ?> />
                            <?php esc_html_e( 'Show related posts', 'versana' ); ?>
                        </label>
                        <p class="description">
                            <?php esc_html_e( 'Shows 3-4 related posts at the end of each post. Increases engagement.', 'versana' ); ?>
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
                            <?php esc_html_e( 'Automatically creates TOC from H2-H4 headings. Great for long posts.', 'versana' ); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php
        /**
         * Action to add custom blog settings
         *
         * Child themes can use this to add their own blog options.
         */
        do_action( 'versana_blog_tab_settings' );
        ?>
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