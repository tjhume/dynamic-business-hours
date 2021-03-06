<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tjhume.dev
 * @since             1.0.0
 * @package           Dynamic_Business_Hours
 *
 * @wordpress-plugin
 * Plugin Name:       Dynamic Business Hours
 * Plugin URI:        https://tjhume.dev/plugins/dynamic-business-hours
 * Description:       A simple and easy way to display the office hours for your business
 * Version:           1.0.0
 * Author:            TJ Hume
 * Author URI:        https://tjhume.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dynamic-business-hours
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'DYNAMIC_BUSINESS_HOURS_VERSION', '1.0.0' );

/**
 * Plugin name.
 */
define( 'DYNAMIC_BUSINESS_HOURS_NAME', 'dynamic-business-hours' );

/**
 * Plugin directory path.
 * Use when when requiring/including php files.
 */
define( 'DYNAMIC_BUSINESS_HOURS_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin URL path.
 * Use for public assets like scripts and styles.
 */
define( 'DYNAMIC_BUSINESS_HOURS_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dynamic-business-hours-activator.php
 */
function activate_dynamic_business_hours() {
	require_once DYNAMIC_BUSINESS_HOURS_DIR . 'includes/class-dynamic-business-hours-activator.php';
	Dynamic_Business_Hours_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dynamic-business-hours-deactivator.php
 */
function deactivate_dynamic_business_hours() {
	require_once DYNAMIC_BUSINESS_HOURS_DIR . 'includes/class-dynamic-business-hours-deactivator.php';
	Dynamic_Business_Hours_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dynamic_business_hours' );
register_deactivation_hook( __FILE__, 'deactivate_dynamic_business_hours' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require DYNAMIC_BUSINESS_HOURS_DIR . 'includes/class-dynamic-business-hours.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dynamic_business_hours() {

	$plugin = new Dynamic_Business_Hours();
	$plugin->run();

}
run_dynamic_business_hours();
