<?php
/**
 * Versana Theme Companion Plugin Installer
 *
 * @package Versana
 * @since 1.0.7
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'versana_register_required_plugins' );

function versana_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Versana Companion',
			'slug'      => 'versana-companion',
			'required'  => false, // Required for full functionality
		),
	);

	$config = array(
		'id'           => 'versana-tgmpa',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, user cannot dismiss the survive notice.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}