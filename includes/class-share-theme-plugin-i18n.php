<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://mh-theme.com/
 * @since      1.0.0
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/includes
 * @author     MH-Theme <mhthemewp@gmail.com>
 */
class Share_Theme_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'share-theme-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
