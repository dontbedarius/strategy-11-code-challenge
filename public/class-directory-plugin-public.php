<?php
/**
 * Public functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/public
 */
class Directory_Plugin_Public {

    private $plugin_name;
    private $version;
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    // Stylesheet for public-facing side of the plugin
	public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'css/directory-plugin-public.css', array(), $this->version, 'all' );
        wp_enqueue_style(
            'google-fonts',
            'https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap',
            array(),
            null
        );
    }
    // Javasript for public-facing side of the plugin
	public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'js/directory-plugin-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name . '-public', 'directoryPlugin', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    // Register Shortcode for public-facing side of plugin
    public function register_shortcodes() {
        add_shortcode('directory_plugin_table', array($this, 'shortcode_handler'));
        add_shortcode('front_end_challenge', array($this, 'shortcode_handler_challenge'));
    }
    // Handle Shortcode
    public function shortcode_handler() {
        ob_start();
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/data-from-api.php';
        return ob_get_clean();
    }
    // Handle Shortcode for including front-end challenge PHP file
    public function shortcode_handler_challenge() {
        ob_start();
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/front-end-challenge.php';
        return ob_get_clean();
    }


}