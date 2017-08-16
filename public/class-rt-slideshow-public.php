<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/kirtangajjar
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public
 * @author     Kirtan Gajjar <kirtangajjar95@gmail.com>
 */
class Rt_Slideshow_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Rt_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rt_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

			wp_enqueue_style( $this->plugin_name, plugins_url( '../node_modules/lightslider/dist/css/lightslider.min.css', __FILE__ ), array(), $this->version, 'all' );
	}

		/**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    1.0.0
   */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Rt_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rt_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name . '-dependency-slider', plugins_url( '../node_modules/lightslider/dist/js/lightslider.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rt-slideshow-public.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ) );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcode() {

		/**
		 * Displays slider when shortcode is called.
   *
		 * @param      array  $atts       The attributes provied to shortcode.
		 * @param      string $content    The content to display.
		 *
		 * @since    1.0.0
		 */
		function shortcode( $atts = [], $content = null ) {

			$content .= self::display_slider();
			return $content;

		}

		add_shortcode( 'rt-slideshow', 'shortcode' );

	}

		/**
   * Displays slider whenever called.
   *
   * @since    1.0.0
   */
	public static function display_slider() {

		include_once 'partials/rt-slideshow-slider.php';

	}

}
