<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://mh-theme.com/
 * @since      1.0.0
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/admin
 * @author     MH-Theme <mhthemewp@gmail.com>
 */
class Share_Theme_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Share_Theme_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Share_Theme_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/share-theme-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Share_Theme_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Share_Theme_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/share-theme-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create our custom filter widget
	 *
	 * @since    1.0.0
	 */
	public function register_widgets() {
		register_widget( 'Share_Theme_Plugin_About_Me_Widget' );
		register_widget( 'Share_Theme_Plugin_Recent_Post_Widget' );
	}

}
