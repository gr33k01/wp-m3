<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              natehobi.com
 * @since             1.0.0
 * @package           Wp_M3
 *
 * @wordpress-plugin
 * Plugin Name:       WP-M3
 * Plugin URI:        https://github.com/gr33k01/wp-m3
 * Description:       Wordpress plugin for Mindoula M3. Exposes a shortcode and stores data.
 * Version:           1.0.0
 * Author:            Nate Hobi
 * Author URI:        natehobi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-m3
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-m3-activator.php
 */
function activate_wp_m3() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-m3-activator.php';
	Wp_M3_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-m3-deactivator.php
 */
function deactivate_wp_m3() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-m3-deactivator.php';
	Wp_M3_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_m3' );
register_deactivation_hook( __FILE__, 'deactivate_wp_m3' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-m3.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_m3() {

	$plugin = new Wp_M3();
	$plugin->run();

}
run_wp_m3(); 

