<?php
/**
 * Public functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/public
 */
class Directory_Plugin_Public {
    // Stylesheet for public-facing side of the plugin
	public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/directory-plugin-public.css', array(), $this->version, 'all' );
    }
    // Javasript for public-facing side of the plugin
	public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/directory-plugin-public.js', array( 'jquery' ), $this->version, false, false, false, false);
    }
}