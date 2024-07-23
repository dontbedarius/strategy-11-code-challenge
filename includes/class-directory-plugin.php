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
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcode.php';
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rest-api.php';
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wp-cli.php';
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/admin-page.php';
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ajax-handler.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-directory-plugin-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-directory-plugin-public.php';
        $this->loader = new Directory_Plugin_Loader();
	}

    /**
	 * Register admin area
	 *
	 * @since    1.0.0
	 */
    private function define_admin_hooks() {
        $plugin_admin = new Directory_Plugin_Admin();
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    }

    /**
	 * Register public area
	 *
	 * @since    1.0.0
	 */
    private function define_public_hooks() {
        $plugin_public = new Directory_Plugin_Public();
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

}