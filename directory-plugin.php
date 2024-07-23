<?php
/**
 * @wordpress-plugin
 * Plugin Name: Directory Plugin
 * Description: A custom plugin for developer applicant challenge.
 * Version: 1.0
 * Author: Darius
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Plugin Activation
function directory_plugin_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-directory-plugin-activator.php';
	Directory_Plugin_Activator::activate();
}
register_activation_hook(__FILE__, 'directory_plugin_activate');

// Plugin Deactivation
function directory_plugin_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-directory-plugin-deactivator.php';
	Directory_Plugin_Deactivator::deactivate();
}
register_deactivation_hook(__FILE__, 'directory_plugin_deactivate');

// Define Admin and Public Site Hooks.
require plugin_dir_path( __FILE__ ) . 'includes/class-directory-plugin.php';

// Execute Plugin Startup
function run_directory_plugin() {
    $plugin = new Directory_Plugin();
    $plugin->run();
}
run_directory_plugin();



