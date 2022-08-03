<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://niloyrudra.com/
 * @since             1.0.0
 * @package           Moderni_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Moderni Video Uploader Form
 * Plugin URI:        https://moderni.io/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Niloy Rudra
 * Author URI:        https://niloyrudra.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       moderni-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MODERNI_FORM_VERSION', '1.0.0' );

define( 'MODERNI_FORM_CPT_NAME', 'mvf_property' );
define( 'MODERNI_FORM_CT_NAME', 'mvf_property_type' );
define( 'MODERNI_FORM_CPT_SLUG', 'properties' );
define( 'MODERNI_FORM_CT_SLUG', 'property-types' );
define( 'MODERNI_FORM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'MODERNI_FORM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MODERNI_FORM_PLUGIN_URL', plugins_url( __FILE__ ) );
define( 'MODERNI_FORM_PLUGIN_DIRNAME', dirname( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-moderni-form-activator.php
 */
function activate_moderni_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-moderni-form-activator.php';
	Moderni_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-moderni-form-deactivator.php
 */
function deactivate_moderni_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-moderni-form-deactivator.php';
	Moderni_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_moderni_form' );
register_deactivation_hook( __FILE__, 'deactivate_moderni_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-moderni-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_moderni_form() {

	$plugin = new Moderni_Form();
	$plugin->run();

}
run_moderni_form();



// Initialize the plugin.
add_action( 'plugins_loaded', 'init' );
function init() {
	// Check if Elementor installed and activated.
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'admin_notice_missing_main_plugin' );
		return;
	}

	// require_once plugin_dir_path( __FILE__ ) . "/includes/class-moderni-form-elementor-project-form-widget.php";
	// $project_submit_form_widget = new MVF_Elementor_Project_Form_Widget();


	// Check for required Elementor version.
	// if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
	// 	add_action( 'admin_notices', 'admin_notice_minimum_elementor_version' );
	// 	return;
	// }
	// Check for required PHP version.
	// if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
	// 	add_action( 'admin_notices', 'admin_notice_minimum_php_version' );
	// 	return;
	// }

	// Once we get here, We have passed all validation checks so we can safely include our widgets.
	// require_once 'class-widgets.php';
}
function admin_notice_missing_main_plugin() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	return sprintf(
		wp_kses(
			'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
			array(
				'div' => array(
					'class'  => array(),
					'p'      => array(),
					'strong' => array(),
				),
			)
		),
		'Moderni Video Uploader Form',
		'Elementor'
	);
}