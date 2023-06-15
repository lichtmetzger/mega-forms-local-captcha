<?php
/**
 * Plugin Name:       Mega Forms - Local Captcha
 * Plugin URI:        https://qbus.de
 * Text Domain:       mega-forms-local-captcha
 * Domain Path:       /languages
 * Description:       Integrates a local captcha by MobiCMS into Mega Forms.
 * Version:           1.2
 * Requires at least: 6.0
 * Author:            Qbus Internetagentur GmbH
 * Author URI:        https://qbus.de
 *
 * @package wp-zfinder
 **/

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

require_once dirname( __FILE__ ) . '/vendor/autoload.php';

// Initialize wpcs-compatible autoloader.
use Pablo_Pacheco\WP_Namespace_Autoloader\WP_Namespace_Autoloader;
$autoloader = new WP_Namespace_Autoloader(
	array(
		'directory'         => __DIR__,       // Directory of the project.
		'namespace_prefix'  => 'MfLocalCaptcha',  // Main namespace of the project.
		'classes_dir'       => 'src',         // It is where your namespaced classes are located inside your project.
		'prepend_class'     => true,          // Prepends class- before the final class name.
		'prepend_interface' => true,          // Prepends interface- before the final interface name.
		'prepend_trait'     => true,          // Prepends trait- before the final trait name.
	)
);
$autoloader->init();

define( 'MF_LOCAL_CAPTCHA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MF_LOCAL_CAPTCHA_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'MF_LOCAL_CAPTCHA_MAIN_FILE', __FILE__ );
define( 'MF_LOCAL_CAPTCHA_TEXTDOMAIN', 'mega-forms-local-captcha' );

// Initialize plugin.
use MfLocalCaptcha\Main;
$main = new Main();
$main->initialize();
