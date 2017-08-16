<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Rt_Slideshow
 * @link    https://github.com/kirtangajjar
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       rtCamp Slideshow Plugin Assignment
 * Plugin URI:        https://github.com/kirtangajjar/rtcamp-plugin-assignment-1
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Kirtan Gajjar
 * Author URI:        https://github.com/kirtangajjar
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rt-slideshow
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rt-slideshow-activator.php
 */
function activate_rt_slideshow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow-activator.php';
	Rt_Slideshow_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rt-slideshow-deactivator.php
 */
function deactivate_rt_slideshow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow-deactivator.php';
	Rt_Slideshow_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rt_slideshow' );
register_deactivation_hook( __FILE__, 'deactivate_rt_slideshow' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rt_slideshow() {

	$plugin = new Rt_Slideshow();
	$plugin->run();

}
run_rt_slideshow();
