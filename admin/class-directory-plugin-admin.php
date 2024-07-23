<?php
/**
 * Public functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/public
 */
class Directory_Plugin_Admin {
    // Stylesheet for public-facing side of the plugin
	public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/directory-plugin-admin.css');
    }
    // Javasript for public-facing side of the plugin
	public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/directory-plugin-admin.js', false, false, false);
    }
}