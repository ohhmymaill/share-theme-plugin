<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://mh-theme.com/
 * @since      1.0.0
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Share_Theme_Plugin
 * @subpackage Share_Theme_Plugin/public
 * @author     MH-Theme <mhthemewp@gmail.com>
 */

class Share_Theme_Plugin_Public {
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		require_once plugin_dir_path( __FILE__ ) . '\font-awesome.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/share-theme-plugin-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/share-theme-plugin-public.min.js', array( 'jquery' ), $this->version, false );

	}


	function srtp_dropcap( $atts) {
	    $args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'character'  => ''
	        ),
	        $atts
	    );

	    if(strlen($args['character']) == 1) {
	   		return '<span class="sr-first-character" style="color:'.$args['color'].'">'.$args['character'].'</span>';
	    }

	    return '';
	}

	function srtp_dropcap_2 ( $atts) {
	    $args = shortcode_atts(
	        array(
	            'color'   => '#eaeaea',
	            'character'  => ''
	        ),
	        $atts
	    );

	    if(strlen($args['character']) == 1) {
	   		return '<span class="sr-first-character-2" style="background-color:'.$args['color'].'">'.$args['character'].'</span>';
	    }

	    return '';
	}

	function srtp_bulleted_list($atts, $content="null") {
		$args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'icon'  => 'fa-long-arrow-right'
	        ),
	        $atts
	    );

		$unicode = ShareThemePluginFontAwesome::getIcon($args['icon']);

		$style = '<style type="text/css">
					.sr-bulleted-'.$args['icon'].' li::before {
						font-family: FontAwesome;
						content: '.$unicode.';
						font-size: 23px;
						color: red;
					}
				</style>
				';

		if(!empty($unicode)) {
			$style = '<style type="text/css"> .sr-bulleted-'.$args['icon'].'{
						padding: 0;
					}
					.sr-bulleted-'.$args['icon'].' li::before {
						font-family: "FontAwesome";
						content: \''.$unicode.'\';
						font-size: inherit;
						color: '.$args['color'].';
						margin-right: 20px;
					}

					.sr-bulleted-'.$args['icon'].' li {
						list-style-type: none;
					}</style>';
		}

		return $style.'<ul class="sr-bulleted-'.$args['icon'].'">' .do_shortcode($content) . '</ul>';
	}

	function srtp_bulleted_item($atts, $content="null") {
		return '<li>'.$content.'</li>';
	}

	function srtp_icon($atts) {
		$args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'icon'  => 'fa-long-arrow-right',
	            'link'  => '#'
	        ),
	        $atts
	    );

	    return '<a href="'.$args['link'].'" class="sr-icon" style="border-color:'.$args['color'].' !important; border: 1px solid;  padding: 10px;margin-right: 16px;margin-top: 10px;margin-bottom: 10px;display: inline-flex;width: 40px;height: 40px;font-size: 14px;text-align: center;justify-content: center;align-items: center;"><i class="fa '.$args['icon'].'" style="color:'.$args['color'].'"></i></a>';
	}
	

	function srtp_column($atts, $content="null") {
		return '<div class="sr-column">'.do_shortcode($content).'</div>';
	} 

	function srtp_column_one_three($atts, $content="null") {
		return '<div class="sr_column_one_three">'.do_shortcode($content).'</div>';
	}

	function srtp_column_one_two($atts, $content="null") {
		return '<div class="sr_column_one_two">'.do_shortcode($content).'</div>';
	}

	function srtp_column_two_three($atts, $content="null") {
		return '<div class="sr_column_two_three">'.do_shortcode($content).'</div>';
	}

	function srtp_button_with_icon($atts, $content="null") {
		$args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'icon'  => 'fa-long-arrow-right',
	            'link'  => '#',
	            'text'  => 'Button',
	        ),
	        $atts
	    );

	    return '<a href="'.$args['link'].'" class="sr_button_with_icon" style="border: 1px solid '.$args['color'].' !important;"><span class="sr-icon"><i class="fa '.$args['icon'].'" style="color: '.$args['color'].'"></i></span><span class="sr-text" style="background-color: '.$args['color'].'" >'.$args['text'].'</span></a>';
	}


	function srtp_button($atts, $content="null") {
		$args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'link'  => '#',
	            'text'  => 'Button',
	        ),
	        $atts
	    );

	    return '<a class="sr-button" href="'.$args['link'].'" style="border: 2px solid '.$args['color'].' !important">'.$args['text'].'</a>';
	}


	function srtp_progress_bar($atts) {

		$args = shortcode_atts(
	        array(
	            'color'   => '#1f1f1f',
	            'text'  => '',
	            'thickness' => '3',
	            'percent' => '100'
	        ),
	        $atts
	    );

		return '<div class="sr-progressbar" data-animate="false" data-color="'.$args['color'].'" data-thickness="'.$args['thickness'].'">
			    <div class="circle" data-percent="'.$args['percent'].'">
			      <div class="sr-percent"></div>
			      <p class="sr-caption">'.$args['text'].'</p>
			    </div>
			  </div>';
	}

}?>

