<?php
/**
 * Versana Companion Plugin Checker, Installer & Updater
 *
 * Handles installation from GitHub releases and automatic updates.
 *
 * @package Versana
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Versana_Companion_Installer {

    /**
     * Plugin slug
     *
     * @var string
     */
    private $plugin_slug = 'versana-companion';

    /**
     * Plugin file path
     *
     * @var string
     */
    private $plugin_file = 'versana-companion/versana-companion.php';

    /**
     * GitHub repository (format: username/repo)
     *
     * @var string
     */
    private $github_repo = 'junaidte14/versana-companion'; // Update this

    /**
     * Minimum required version (optional safety check)
     *
     * @var string
     */
    private $minimum_version = '1.0.0';

    /**
     * Transient name for update check cache
     *
     * @var string
     */
    private $update_transient = 'versana_companion_update_check';

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'admin_notices', array( $this, 'show_admin_notice' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        
        // Installation & Activation
        add_action( 'wp_ajax_versana_install_companion', array( $this, 'ajax_install_plugin' ) );
        add_action( 'wp_ajax_versana_activate_companion', array( $this, 'ajax_activate_plugin' ) );
        
        // Update functionality
        add_action( 'wp_ajax_versana_update_companion', array( $this, 'ajax_update_plugin' ) );
        add_action( 'wp_ajax_versana_check_companion_update', array( $this, 'ajax_check_update' ) );
        
        // Auto-check for updates twice daily
        add_action( 'admin_init', array( $this, 'schedule_update_check' ) );
        add_action( 'versana_check_companion_updates', array( $this, 'check_for_updates' ) );
    }

    /**
     * Check if plugin is installed
     *
     * @return bool
     */
    private function is_plugin_installed() {
        $installed_plugins = get_plugins();
        return isset( $installed_plugins[ $this->plugin_file ] );
    }

    /**
     * Check if plugin is active
     *
     * @return bool
     */
    private function is_plugin_active() {
        return is_plugin_active( $this->plugin_file );
    }

    /**
     * Get installed plugin version
     *
     * @return string|false
     */
    private function get_installed_version() {
        if ( ! $this->is_plugin_installed() ) {
            return false;
        }

        $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $this->plugin_file );
        return isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : false;
    }

    /**
     * Get latest release from GitHub
     *
     * @return array|WP_Error
     */
    private function get_latest_release() {
        
        $api_url = "https://api.github.com/repos/{$this->github_repo}/releases/latest";

        $response = wp_remote_get( $api_url, array(
            'timeout' => 15,
            'headers' => array(
                'Accept' => 'application/vnd.github.v3+json',
            ),
        ) );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code( $response );
        if ( $code !== 200 ) {
            return new WP_Error( 'api_error', 'GitHub API returned status ' . $code );
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( empty( $data['tag_name'] ) || empty( $data['zipball_url'] ) ) {
            return new WP_Error( 'invalid_response', 'Invalid response from GitHub API' );
        }

        return array(
            'version'      => ltrim( $data['tag_name'], 'v' ), // Remove 'v' prefix if present
            'download_url' => $data['zipball_url'],
            'name'         => isset( $data['name'] ) ? $data['name'] : $data['tag_name'],
            'published_at' => isset( $data['published_at'] ) ? $data['published_at'] : '',
            'body'         => isset( $data['body'] ) ? $data['body'] : '',
        );
    }

    /**
     * Check if update is available
     *
     * @return bool
     */
    private function is_update_available() {
        
        if ( ! $this->is_plugin_installed() || ! $this->is_plugin_active() ) {
            return false;
        }

        $update_data = get_transient( $this->update_transient );
        
        if ( false === $update_data ) {
            $update_data = $this->check_for_updates();
        }

        return isset( $update_data['update_available'] ) ? $update_data['update_available'] : false;
    }

    /**
     * Check for updates
     *
     * @return array
     */
    public function check_for_updates() {
        
        $current_version = $this->get_installed_version();
        
        if ( ! $current_version ) {
            return array( 'update_available' => false );
        }

        $latest_release = $this->get_latest_release();

        if ( is_wp_error( $latest_release ) ) {
            // Cache error state for 1 hour
            set_transient( $this->update_transient, array( 'update_available' => false ), HOUR_IN_SECONDS );
            return array( 'update_available' => false );
        }

        $latest_version = $latest_release['version'];
        $update_available = version_compare( $latest_version, $current_version, '>' );

        $update_data = array(
            'update_available' => $update_available,
            'current_version'  => $current_version,
            'latest_version'   => $latest_version,
            'download_url'     => $latest_release['download_url'],
            'release_name'     => $latest_release['name'],
            'published_at'     => $latest_release['published_at'],
            'changelog'        => $latest_release['body'],
        );

        // Cache for 12 hours
        set_transient( $this->update_transient, $update_data, 12 * HOUR_IN_SECONDS );

        return $update_data;
    }

    /**
     * Schedule automatic update checks
     */
    public function schedule_update_check() {
        if ( ! wp_next_scheduled( 'versana_check_companion_updates' ) ) {
            wp_schedule_event( time(), 'twicedaily', 'versana_check_companion_updates' );
        }
    }

    /**
     * Show admin notice
     */
    public function show_admin_notice() {

        // Don't show to users who can't manage plugins
        if ( ! current_user_can( 'install_plugins' ) ) {
            return;
        }

        // Check if plugin is active
        $is_active = $this->is_plugin_active();
        
        // If active, check for updates
        if ( $is_active ) {
            $this->show_update_notice();
            return;
        }

        // Otherwise show install/activate notice
        $this->show_install_notice();
    }

    /**
     * Show installation/activation notice
     */
    private function show_install_notice() {
        
        $is_installed = $this->is_plugin_installed();
        $action = $is_installed ? 'activate' : 'install';
        $action_text = $is_installed ? 'Activate' : 'Install';
        $message = $is_installed 
            ? 'Versana Companion plugin is installed but not active. Activate it to unlock all theme features.' 
            : 'Versana Companion plugin is required to unlock all theme features and demo content.';

        ?>
        <div class="notice notice-warning is-dismissible versana-companion-notice" id="versana-companion-notice">
            <p>
                <strong><?php esc_html_e( 'Versana Theme:', 'versana' ); ?></strong>
                <?php echo esc_html( $message ); ?>
            </p>
            <p>
                <button type="button" class="button button-primary versana-companion-action" 
                        data-action="<?php echo esc_attr( $action ); ?>"
                        id="versana-companion-btn">
                    <?php echo esc_html( $action_text . ' Versana Companion' ); ?>
                </button>
                <span class="versana-companion-loader" style="display:none;">
                    <span class="spinner" style="visibility:visible;float:none;margin:0 0 0 10px;"></span>
                    <span class="versana-companion-status"></span>
                </span>
            </p>
        </div>
        <?php
        
        $this->add_notice_styles();
    }

    /**
     * Show update notice
     */
    private function show_update_notice() {
        
        $update_data = get_transient( $this->update_transient );
        
        if ( ! $update_data || ! isset( $update_data['update_available'] ) || ! $update_data['update_available'] ) {
            return;
        }

        $current_version = $update_data['current_version'];
        $latest_version = $update_data['latest_version'];
        $release_name = isset( $update_data['release_name'] ) ? $update_data['release_name'] : "Version {$latest_version}";

        ?>
        <div class="notice notice-info is-dismissible versana-companion-notice versana-update-notice" id="versana-update-notice">
            <p>
                <strong><?php esc_html_e( 'Versana Companion Update Available!', 'versana' ); ?></strong><br>
                <?php 
                printf(
                    esc_html__( 'A new version is available: %1$s (you have %2$s)', 'versana' ),
                    '<strong>' . esc_html( $latest_version ) . '</strong>',
                    '<code>' . esc_html( $current_version ) . '</code>'
                );
                ?>
            </p>
            <p>
                <button type="button" class="button button-primary versana-companion-action" 
                        data-action="update"
                        id="versana-update-btn">
                    <?php esc_html_e( 'Update Now', 'versana' ); ?>
                </button>
                <button type="button" class="button versana-view-changelog" 
                        id="versana-view-changelog">
                    <?php esc_html_e( 'View Changelog', 'versana' ); ?>
                </button>
                <span class="versana-companion-loader" style="display:none;">
                    <span class="spinner" style="visibility:visible;float:none;margin:0 0 0 10px;"></span>
                    <span class="versana-companion-status"></span>
                </span>
            </p>
            <div class="versana-changelog" style="display:none; margin-top:15px; padding:10px; background:#f9f9f9; border-left:4px solid #2271b1;">
                <h4><?php echo esc_html( $release_name ); ?></h4>
                <div class="versana-changelog-content">
                    <?php 
                    if ( ! empty( $update_data['changelog'] ) ) {
                        echo wp_kses_post( wpautop( $update_data['changelog'] ) );
                    } else {
                        echo '<p>' . esc_html__( 'No changelog available.', 'versana' ) . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        
        $this->add_notice_styles();
        $this->add_changelog_script();
    }

    /**
     * Add notice styles
     */
    private function add_notice_styles() {
        ?>
        <style>
            .versana-companion-notice .versana-companion-loader {
                display: inline-block;
                vertical-align: middle;
            }
            .versana-companion-notice .versana-companion-status {
                margin-left: 10px;
                font-style: italic;
                color: #666;
            }
            .versana-companion-notice.notice-success {
                border-left-color: #46b450;
            }
            .versana-companion-action:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }
            .versana-changelog {
                max-height: 300px;
                overflow-y: auto;
            }
            .versana-changelog h4 {
                margin-top: 0;
                color: #2271b1;
            }
            .versana-changelog-content ul {
                margin-left: 20px;
            }
        </style>
        <?php
    }

    /**
     * Add changelog toggle script
     */
    private function add_changelog_script() {
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('#versana-view-changelog').on('click', function() {
                $('.versana-changelog').slideToggle();
                $(this).text(function(i, text) {
                    return text === "<?php esc_html_e( 'View Changelog', 'versana' ); ?>" ? 
                        "<?php esc_html_e( 'Hide Changelog', 'versana' ); ?>" : 
                        "<?php esc_html_e( 'View Changelog', 'versana' ); ?>";
                });
            });
        });
        </script>
        <?php
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts( $hook ) {

        wp_enqueue_script(
            'versana-companion-installer',
            get_template_directory_uri() . '/assets/js/companion-installer.js',
            array( 'jquery' ),
            '1.1.0', // Updated version
            true
        );

        wp_localize_script(
            'versana-companion-installer',
            'versanaCompanionInstaller',
            array(
                'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
                'nonce'          => wp_create_nonce( 'versana_companion_installer' ),
                'installingText' => __( 'Installing...', 'versana' ),
                'activatingText' => __( 'Activating...', 'versana' ),
                'updatingText'   => __( 'Updating...', 'versana' ),
                'checkingText'   => __( 'Checking for updates...', 'versana' ),
                'successText'    => __( 'Success! Reloading...', 'versana' ),
                'errorText'      => __( 'Error occurred. Please try again.', 'versana' ),
            )
        );
    }

    /**
     * AJAX: Install plugin
     */
    public function ajax_install_plugin() {

        check_ajax_referer( 'versana_companion_installer', 'nonce' );

        if ( ! current_user_can( 'install_plugins' ) ) {
            wp_send_json_error( array(
                'message' => __( 'You do not have permission to install plugins.', 'versana' )
            ) );
        }

        if ( $this->is_plugin_installed() ) {
            wp_send_json_error( array(
                'message' => __( 'Plugin is already installed.', 'versana' )
            ) );
        }

        $result = $this->install_plugin_from_github();

        if ( is_wp_error( $result ) ) {
            wp_send_json_error( array(
                'message' => $result->get_error_message()
            ) );
        }

        wp_send_json_success( array(
            'message' => __( 'Plugin installed successfully!', 'versana' ),
            'action'  => 'activate'
        ) );
    }

    /**
     * AJAX: Activate plugin
     */
    public function ajax_activate_plugin() {

        check_ajax_referer( 'versana_companion_installer', 'nonce' );

        if ( ! current_user_can( 'activate_plugins' ) ) {
            wp_send_json_error( array(
                'message' => __( 'You do not have permission to activate plugins.', 'versana' )
            ) );
        }

        if ( ! $this->is_plugin_installed() ) {
            wp_send_json_error( array(
                'message' => __( 'Plugin is not installed.', 'versana' )
            ) );
        }

        $result = activate_plugin( $this->plugin_file );

        if ( is_wp_error( $result ) ) {
            wp_send_json_error( array(
                'message' => $result->get_error_message()
            ) );
        }

        // Clear update cache after activation
        delete_transient( $this->update_transient );

        wp_send_json_success( array(
            'message' => __( 'Plugin activated successfully!', 'versana' )
        ) );
    }

    /**
     * AJAX: Update plugin
     */
    public function ajax_update_plugin() {

        check_ajax_referer( 'versana_companion_installer', 'nonce' );

        if ( ! current_user_can( 'update_plugins' ) ) {
            wp_send_json_error( array(
                'message' => __( 'You do not have permission to update plugins.', 'versana' )
            ) );
        }

        if ( ! $this->is_plugin_installed() ) {
            wp_send_json_error( array(
                'message' => __( 'Plugin is not installed.', 'versana' )
            ) );
        }

        // Deactivate plugin before update
        deactivate_plugins( $this->plugin_file );

        // Delete old plugin
        $this->delete_plugin();

        // Install latest version
        $result = $this->install_plugin_from_github();

        if ( is_wp_error( $result ) ) {
            wp_send_json_error( array(
                'message' => $result->get_error_message()
            ) );
        }

        // Reactivate plugin
        $activate_result = activate_plugin( $this->plugin_file );

        if ( is_wp_error( $activate_result ) ) {
            wp_send_json_error( array(
                'message' => $activate_result->get_error_message()
            ) );
        }

        // Clear update cache
        delete_transient( $this->update_transient );

        wp_send_json_success( array(
            'message' => __( 'Plugin updated successfully!', 'versana' )
        ) );
    }

    /**
     * AJAX: Check for updates
     */
    public function ajax_check_update() {

        check_ajax_referer( 'versana_companion_installer', 'nonce' );

        // Force fresh check
        delete_transient( $this->update_transient );
        
        $update_data = $this->check_for_updates();

        if ( isset( $update_data['update_available'] ) && $update_data['update_available'] ) {
            wp_send_json_success( $update_data );
        } else {
            wp_send_json_success( array(
                'update_available' => false,
                'message' => __( 'You have the latest version.', 'versana' )
            ) );
        }
    }

    /**
     * Install plugin from GitHub
     *
     * @return bool|WP_Error
     */
    private function install_plugin_from_github() {

        $latest_release = $this->get_latest_release();

        if ( is_wp_error( $latest_release ) ) {
            return $latest_release;
        }

        $download_url = $latest_release['download_url'];

        // Download the ZIP file
        $temp_file = download_url( $download_url );

        if ( is_wp_error( $temp_file ) ) {
            return new WP_Error(
                'download_failed',
                sprintf(
                    __( 'Could not download plugin from GitHub: %s', 'versana' ),
                    $temp_file->get_error_message()
                )
            );
        }

        // Include required files
        if ( ! function_exists( 'plugins_api' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        }
        if ( ! class_exists( 'WP_Upgrader' ) ) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }

        WP_Filesystem();

        $upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );
        $result = $upgrader->install( $temp_file );

        @unlink( $temp_file );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        if ( ! $result ) {
            return new WP_Error(
                'installation_failed',
                __( 'Plugin installation failed.', 'versana' )
            );
        }

        // Fix: Rename the extracted folder to match expected plugin slug
        // GitHub creates folders like "username-repo-commithash" instead of just "repo"
        $rename_result = $this->rename_plugin_folder();
        
        if ( is_wp_error( $rename_result ) ) {
            return $rename_result;
        }

        return true;
    }

    /**
     * Rename the plugin folder to match expected slug
     * 
     * GitHub zipballs extract as "username-repo-hash" but we need "repo"
     *
     * @return bool|WP_Error
     */
    private function rename_plugin_folder() {
        
        global $wp_filesystem;
        
        if ( ! $wp_filesystem ) {
            WP_Filesystem();
        }

        $plugins_dir = WP_PLUGIN_DIR;
        
        // Get all directories in plugins folder
        $plugin_folders = $wp_filesystem->dirlist( $plugins_dir );
        
        if ( ! $plugin_folders ) {
            return new WP_Error( 'folder_scan_failed', __( 'Could not scan plugins directory.', 'versana' ) );
        }

        // Find the folder that matches our repo pattern (username-repo-hash)
        $target_folder = null;
        foreach ( $plugin_folders as $folder_name => $folder_info ) {
            
            // Skip if not a directory
            if ( 'd' !== $folder_info['type'] ) {
                continue;
            }
            
            // Check if folder name contains our plugin slug with potential GitHub suffix
            // Pattern: *-versana-companion-* or starts with our repo name
            if ( strpos( $folder_name, $this->plugin_slug ) !== false && 
                 $folder_name !== $this->plugin_slug ) {
                
                // Likely our GitHub extracted folder
                $target_folder = $folder_name;
                break;
            }
        }

        if ( ! $target_folder ) {
            // Maybe it's already correctly named?
            if ( $wp_filesystem->is_dir( $plugins_dir . '/' . $this->plugin_slug ) ) {
                return true; // All good!
            }
            
            return new WP_Error( 
                'folder_not_found', 
                __( 'Could not locate extracted plugin folder.', 'versana' ) 
            );
        }

        // Rename the folder
        $old_path = trailingslashit( $plugins_dir ) . $target_folder;
        $new_path = trailingslashit( $plugins_dir ) . $this->plugin_slug;

        // If target already exists, delete it first
        if ( $wp_filesystem->exists( $new_path ) ) {
            $wp_filesystem->delete( $new_path, true );
        }

        $renamed = $wp_filesystem->move( $old_path, $new_path );

        if ( ! $renamed ) {
            return new WP_Error(
                'rename_failed',
                sprintf(
                    __( 'Could not rename plugin folder from %s to %s', 'versana' ),
                    $target_folder,
                    $this->plugin_slug
                )
            );
        }

        return true;
    }

    /**
     * Delete plugin directory
     *
     * @return bool
     */
    private function delete_plugin() {
        
        if ( ! function_exists( 'delete_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugin_dir = WP_PLUGIN_DIR . '/' . dirname( $this->plugin_file );

        if ( is_dir( $plugin_dir ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            WP_Filesystem();
            global $wp_filesystem;
            return $wp_filesystem->delete( $plugin_dir, true );
        }

        return true;
    }

}

// Initialize the installer
new Versana_Companion_Installer();