<?php
/**
 * Plugin Name:       Mega Forms - Local Captcha
 * Plugin URI:        https://qbus.de
 * Text Domain:       mega-forms-local-captcha
 * Domain Path:       /languages
 * Description:       Integrates a local captcha by MobiCMS into Mega Forms.
 * Version:           1.0
 * Requires at least: 6.0
 * Author:            Qbus Internetagentur GmbH
 * Author URI:        https://qbus.de
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

require "vendor/autoload.php";

use Qbus\MfLocalCaptcha\Initialize;

define( 'MF_LOCAL_CAPTCHA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MF_LOCAL_CAPTCHA_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

// Initialize plugin
$init = new Initialize;