<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://mh-theme.com/
 * @since      1.0.0
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/includes
 * @author     MH-Theme <mhthemewp@gmail.com>
 */
class Share_Theme_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Share_Theme_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'share_theme_plugin_v1_0' ) ) {
			$this->version = 'share_theme_plugin_v1_0';
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'share-theme-plugin';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Share_Theme_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Share_Theme_Plugin_i18n. Defines internationalization functionality.
	 * - Share_Theme_Plugin_Admin. Defines all hooks for the admin area.
	 * - Share_Theme_Plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-share-theme-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-share-theme-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-share-theme-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-share-theme-plugin-public.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/share-theme-plugin-about-me-widget.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/share-theme-plugin-recent-post-widget.php';

		$this->loader = new Share_Theme_Plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Share_Theme_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Share_Theme_Plugin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Share_Theme_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'register_widgets' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Share_Theme_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_shortcode( "sr_dropcap", $plugin_public, "sr_dropcap", $priority = 10, $accepted_args = 2 );
		$this->loader->add_shortcode( "sr_dropcap_2", $plugin_public, "sr_dropcap_2", $priority = 10, $accepted_args = 2 );
		$this->loader->add_shortcode( "sr_bulleted_list", $plugin_public, "sr_bulleted_list", $priority = 10, $accepted_args = 2 );
		$this->loader->add_shortcode( "sr_bulleted_item", $plugin_public, "sr_bulleted_item", $priority = 10, $accepted_args = 0 );
		$this->loader->add_shortcode( "sr_icon", $plugin_public, "sr_icon", $priority = 10, $accepted_args = 2);
		$this->loader->add_shortcode( "sr_column", $plugin_public, "sr_column", $priority = 10, $accepted_args = 2);
		$this->loader->add_shortcode( "sr_column_one_three", $plugin_public, "sr_column_one_three", $priority = 10, $accepted_args = 0);
		$this->loader->add_shortcode( "sr_column_one_two", $plugin_public, "sr_column_one_two", $priority = 10, $accepted_args = 0);
		$this->loader->add_shortcode( "sr_column_two_three", $plugin_public, "sr_column_two_three", $priority = 10, $accepted_args = 0);
		$this->loader->add_shortcode( "sr_button_with_icon", $plugin_public, "sr_button_with_icon", $priority = 10, $accepted_args = 4);
		$this->loader->add_shortcode( "sr_button", $plugin_public, "sr_button", $priority = 10, $accepted_args = 3);
		$this->loader->add_shortcode( "sr_progress_bar", $plugin_public, "sr_progress_bar", $priority = 10, $accepted_args = 3);

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Share_Theme_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
