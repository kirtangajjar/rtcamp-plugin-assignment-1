<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/kirtangajjar
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/admin
 * @author     Kirtan Gajjar <kirtangajjar95@gmail.com>
 */
class Rt_Slideshow_Admin {

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
	 * @param    string $plugin_name       The name of this plugin.
	 * @param    string $version    The version of this plugin.
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
		 * defined in Rt_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rt_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_enqueue_style( $this->plugin_name . '-dependency-slider', plugins_url( '../node_modules/lightslider/dist/css/lightslider.min.css', __FILE__ ) );
		 wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rt-slideshow-admin.css', array(), $this->version, 'all' );

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
		* defined in Rt_Slideshow_Loader as all of the hooks are defined
		* in that particular class.
		*
		* The Rt_Slideshow_Loader will then create the relationship
		* between the defined hooks and the functions defined in this
		* class.
		*/

		wp_enqueue_media();     // Enqueues WordPress media manager.

		wp_enqueue_script( $this->plugin_name . '-dependency-slider', plugins_url( '../node_modules/lightslider/dist/js/lightslider.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rt-slideshow-admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ) );

		wp_localize_script(
			$this->plugin_name, 'rtsa', array(
				'nonce' => wp_create_nonce( 'rt-slideshow-ajax-nonce' ),
			)
		);

	}

	/**
	 * Adds an options page under the Settings submenu
	 *
	 * @since    1.0.0
	 */
	public function add_options_page() {

		 add_options_page(
			 __( 'rtCamp Slideshow Plugin', 'rt-slideshow' ),
			 __( 'rt-slideshow', 'rt-slideshow' ),
			 'manage_options',
			 $this->plugin_name,
			 array( $this, 'display_options_page' )
		 );

	}

	/**
	 * Adds an options page under the Settings submenu
	 *
	 * @since    1.0.0
	 */
	public function add_settings_section() {

		add_settings_section(
			'rtsa_preview',
			__( 'Slider Live Preview', 'rt-slideshow' ),
			array( $this, 'display_slider_section' ),
			$this->plugin_name
		);

		add_settings_section(
			'rtsa_images',
			__( 'Images', 'rt-slideshow' ),
			array( $this, 'display_images_section' ),
			$this->plugin_name
		);

	}

	/**
	 * Render the options page for plugin
	 *
	 * @since    1.0.0
	 */
	public function display_options_page() {

		include_once 'partials/rt-slideshow-admin-display.php';

	}

	/**
	 * Displays slider whenever called.
	 *
	 * @since    1.0.0
	 */
	public function display_slider_section() {

		include_once dirname( __FILE__, 2 ) . '/public/partials/rt-slideshow-slider.php';

	}

	/**
	 * Displays slider whenever called.
	 *
	 * @since    1.0.0
	 */
	public function display_images_section() {

		include_once 'partials/rt-slideshow-admin-display-images.php';

	}

	/**
	 * Function to handle AJAX Update image request
	 *
	 * @since    1.0.0
	 */
	public function ajax_update_images() {
		check_ajax_referer( 'rt-slideshow-ajax-nonce','nonce' );

		$images = $_POST['images'];
		if ( isset( $images ) && gettype( $images ) === 'array' && $this->validate_ints_in_array( $images ) ) {
			update_option( 'rtsa_images', $images );
		}
		wp_die();
	}

	/**
	 * Function to validate integers in array
	 *
	 * @param    array $arr    The version of this plugin.
	 * @since    1.0.0
	 */
	private function validate_ints_in_array( $arr ) {
		foreach ( $arr as $ele ) {
			$result = intval( $ele ) ? true : false;

			if ( false === $result ) {
				return false;
			}
		}
		return true;
	}

}
