<?php
/**
 * Admin functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/public
 */
class Directory_Plugin_Admin {

	private $plugin_name;
    private $version;
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
    // Stylesheet for public-facing side of the plugin
	public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/directory-plugin-admin.css', array(), $this->version, 'all');
    }
    // Javasript for public-facing side of the plugin
	public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/directory-plugin-admin.js', array('jquery'), $this->version, true);
        wp_localize_script($this->plugin_name, 'directoryPlugin', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    // Register Plugin Admin Menu
    public function dashboard_admin_menu() {
        add_menu_page(
            'Plugin Settings', 
            'Directory Plugin', 
            'manage_options', 
            'primary_menu',
            array($this, 'display_admin_page'),
            'dashicons-block-default', 
            25);
    }
    // Display Plugin Admin Menu
    public function display_admin_page(){
        require_once 'admin-page.php';
    } 

}