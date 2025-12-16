/**
 * Versana Admin JavaScript
 *
 * @package Versana
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        /**
         * Initialize WordPress Color Pickers
         */
        if (typeof $.fn.wpColorPicker !== 'undefined') {
            $('.versana-color-picker').wpColorPicker();
        }
        
        /**
         * Reset to Defaults
         */
        $('.versana-reset-options').on('click', function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to reset all theme options to their default values? This action cannot be undone.')) {
                return;
            }
            
            // Submit form with reset flag
            var form = $(this).closest('form');
            $('<input>').attr({
                type: 'hidden',
                name: 'versana_reset_options',
                value: '1'
            }).appendTo(form);
            
            form.submit();
        });
        
        /**
         * Validation for analytics IDs
         */
        $('#google_analytics_id').on('blur', function() {
            var value = $(this).val().trim();
            if (value && !value.match(/^(UA|G)-[0-9]+-[0-9]+$/) && !value.match(/^G-[A-Z0-9]+$/)) {
                alert('Please enter a valid Google Analytics ID (format: G-XXXXXXXXXX or UA-XXXXXX-X)');
            }
        });
        
        /**
         * Tab switching with localStorage
         */
        $('.nav-tab').on('click', function() {
            var tab = $(this).attr('href').split('tab=')[1];
            if (tab) {
                localStorage.setItem('versana_active_tab', tab);
            }
        });
        
        // Restore active tab on page load
        var savedTab = localStorage.getItem('versana_active_tab');
        if (savedTab) {
            var tabUrl = window.location.href.split('&tab=')[0] + '&tab=' + savedTab;
            if (window.location.href.indexOf('tab=') === -1) {
                // Don't auto-navigate on first load
                localStorage.removeItem('versana_active_tab');
            }
        }
        
    });
    
})(jQuery);