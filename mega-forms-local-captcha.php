<?php
/**
 * Plugin Name:       Mega Forms - Local Captcha
 * Plugin URI:        https://qbus.de
 * Text Domain:       mega-forms-local-captcha
 * Domain Path:       /languages
 * Description:       Integrates a local captcha by MobiCMS into Mega Forms.
 * Version:           2.2
 * Requires at least: 6.0
 * Author:            Qbus Internetagentur GmbH
 * Author URI:        https://qbus.de
 *
 * @package wp-zfinder
 **/

// phpcs:disable
defined(constant_name: 'ABSPATH') or die();

// Initialize Composer autoloader.
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

define( constant_name: 'MF_LOCAL_CAPTCHA_PLUGIN_DIR', value: plugin_dir_path( __FILE__ ) );
define( constant_name: 'MF_LOCAL_CAPTCHA_PLUGIN_URI', value: plugin_dir_url( __FILE__ ) );
define( constant_name: 'MF_LOCAL_CAPTCHA_MAIN_FILE', value: plugin_basename(file:__FILE__) );

// Initialize plugin.
use MfLocalCaptcha\Main;
$main = new Main();
$main->initialize();
