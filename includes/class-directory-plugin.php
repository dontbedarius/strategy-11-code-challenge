<?php
/**
 * The core plugin class
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/includes
 */

class Directory_Plugin {
    // The unique identifier of this plugin
    protected $version;
	protected $plugin_name;
	protected $loader;
    
    /**
	 * Initialize the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
        $this->version = '1.0.0';
        $this->plugin_name = 'directory_plugin';
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
	}

    /**
	 * Load the dependencies for this plugin.
	 *
	 * @since    1.0.0
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-directory-plugin-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ajax-handler.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-directory-plugin-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-directory-plugin-public.php';
        if ( defined( 'WP_CLI' ) && WP_CLI ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wp-cli.php';
		}
		$this->loader = new Directory_Plugin_Loader();
	}

    /**
	 * Register admin area
	 *
	 * @since    1.0.0
	 */
    private function define_admin_hooks() {
        $plugin_admin = new Directory_Plugin_Admin($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('admin_menu', $plugin_admin, 'dashboard_admin_menu');
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    }

    /**
	 * Register public area
	 *
	 * @since    1.0.0
	 */
    private function define_public_hooks() {
        $plugin_public = new Directory_Plugin_Public($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('init', $plugin_public, 'register_shortcodes');
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
    }

    // Execute all of the hooks with WordPress
    public function run() {
		$this->loader->run();
	}
	public function get_loader() {
		return $this->loader;
	}

	// Name of Plugin
	public function get_plugin_name() {
		return $this->plugin_name;
	}
	// Version of Plugin
	public function get_version() {
		return $this->version;
	}

}