<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/kirtangajjar
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/includes
 * @author     Kirtan Gajjar <kirtangajjar95@gmail.com>
 */
class Rt_Slideshow_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rt-slideshow',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
