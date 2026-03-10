/**
 * Versana Companion Installer & Updater - Frontend JavaScript
 *
 * Handles plugin installation, activation, and updates via AJAX
 *
 * @package Versana
 * @since 1.1.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        /**
         * Handle install/activate/update button click
         */
        $('.versana-companion-action').on('click', function(e) {
            e.preventDefault();

            var $button = $(this);
            var $notice = $button.closest('.versana-companion-notice');
            var $loader = $notice.find('.versana-companion-loader');
            var $status = $notice.find('.versana-companion-status');
            var action = $button.data('action');

            // Disable button and show loader
            $button.prop('disabled', true);
            $loader.show();

            // Handle different actions
            if (action === 'install') {
                $status.text(versanaCompanionInstaller.installingText);
                versanaInstallPlugin($button, $notice, $loader, $status);
            } else if (action === 'activate') {
                $status.text(versanaCompanionInstaller.activatingText);
                versanaActivatePlugin($button, $notice, $loader, $status);
            } else if (action === 'update') {
                // Confirm update
                if (confirm('Are you sure you want to update Versana Companion? The plugin will be temporarily deactivated during the update.')) {
                    $status.text(versanaCompanionInstaller.updatingText);
                    versanaUpdatePlugin($button, $notice, $loader, $status);
                } else {
                    $button.prop('disabled', false);
                    $loader.hide();
                }
            }
        });

        /**
         * Install plugin via AJAX
         */
        function versanaInstallPlugin($button, $notice, $loader, $status) {
            $.ajax({
                url: versanaCompanionInstaller.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'versana_install_companion',
                    nonce: versanaCompanionInstaller.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Installation successful, now activate
                        $status.text(versanaCompanionInstaller.activatingText);
                        $button.data('action', 'activate');
                        versanaActivatePlugin($button, $notice, $loader, $status);
                    } else {
                        versanaShowError($button, $loader, $status, response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    versanaShowError($button, $loader, $status, versanaCompanionInstaller.errorText);
                }
            });
        }

        /**
         * Activate plugin via AJAX
         */
        function versanaActivatePlugin($button, $notice, $loader, $status) {
            $.ajax({
                url: versanaCompanionInstaller.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'versana_activate_companion',
                    nonce: versanaCompanionInstaller.nonce
                },
                success: function(response) {
                    if (response.success) {
                        versanaShowSuccess($button, $notice, $loader, $status, 'activated');
                    } else {
                        versanaShowError($button, $loader, $status, response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    versanaShowError($button, $loader, $status, versanaCompanionInstaller.errorText);
                }
            });
        }

        /**
         * Update plugin via AJAX
         */
        function versanaUpdatePlugin($button, $notice, $loader, $status) {
            $.ajax({
                url: versanaCompanionInstaller.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'versana_update_companion',
                    nonce: versanaCompanionInstaller.nonce
                },
                timeout: 60000, // 60 seconds for update
                success: function(response) {
                    if (response.success) {
                        versanaShowSuccess($button, $notice, $loader, $status, 'updated');
                    } else {
                        versanaShowError($button, $loader, $status, response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (status === 'timeout') {
                        versanaShowError($button, $loader, $status, 'Update timed out. Please check if the plugin was updated and try refreshing the page.');
                    } else {
                        versanaShowError($button, $loader, $status, versanaCompanionInstaller.errorText);
                    }
                }
            });
        }

        /**
         * Show success message and reload
         */
        function versanaShowSuccess($button, $notice, $loader, $status, actionType) {
            $status.text(versanaCompanionInstaller.successText);
            $notice.removeClass('notice-warning notice-info').addClass('notice-success');
            
            // Update notice content
            var successMessage = actionType === 'updated' 
                ? '<strong>Success!</strong> Versana Companion has been updated. Reloading page...'
                : '<strong>Success!</strong> Versana Companion plugin has been activated. Reloading page...';
            
            $notice.find('p:first').html(successMessage);
            
            // Hide buttons
            $button.hide();
            $('.versana-view-changelog').hide();
            
            // Reload page after 1.5 seconds
            setTimeout(function() {
                location.reload();
            }, 1500);
        }

        /**
         * Show error message
         */
        function versanaShowError($button, $loader, $status, message) {
            $button.prop('disabled', false);
            $loader.hide();
            
            // Show error message
            var $errorNotice = $('<div class="notice notice-error is-dismissible"><p><strong>Error:</strong> ' + message + '</p></div>');
            
            // Find the notice and add error after it
            var $parentNotice = $button.closest('.versana-companion-notice');
            $parentNotice.after($errorNotice);
            
            // Make dismissible work
            $(document).trigger('wp-updates-notice-added');
            
            // Auto-dismiss after 8 seconds
            setTimeout(function() {
                $errorNotice.fadeOut(function() {
                    $(this).remove();
                });
            }, 8000);
        }

        /**
         * Manual update check button (optional - for admin page)
         */
        $('.versana-check-updates').on('click', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var originalText = $button.text();
            
            $button.prop('disabled', true).text(versanaCompanionInstaller.checkingText);
            
            $.ajax({
                url: versanaCompanionInstaller.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'versana_check_companion_update',
                    nonce: versanaCompanionInstaller.nonce
                },
                success: function(response) {
                    if (response.success && response.data.update_available) {
                        // Reload to show update notice
                        location.reload();
                    } else {
                        $button.prop('disabled', false).text(originalText);
                        alert(response.data.message || 'You have the latest version.');
                    }
                },
                error: function() {
                    $button.prop('disabled', false).text(originalText);
                    alert('Error checking for updates. Please try again.');
                }
            });
        });

    });

})(jQuery);