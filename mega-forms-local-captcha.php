<?php
/**
 * Plugin Name:       Mega Forms - Local Captcha
 * Plugin URI:        https://qbus.de
 * Text Domain:       mega-forms-local-captcha
 * Domain Path:       /languages
 * Description:       Integrates a local captcha by MobiCMS into Mega Forms.
 * Version:           2.1-gomi
 * Requires at least: 6.0
 * Author:            Qbus Internetagentur GmbH
 * Author URI:        https://qbus.de
 *
 * @package wp-zfinder
 **/

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

// Initialize Composer autoloader.
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

define( 'MF_LOCAL_CAPTCHA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MF_LOCAL_CAPTCHA_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'MF_LOCAL_CAPTCHA_MAIN_FILE', __FILE__ );

// Initialize plugin.
use MfLocalCaptcha\Main;
$main = new Main();
$main->initialize();
