<?php
/**
 * Main plugin initialization.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

use MfLocalCaptcha\Translations;
use MfLocalCaptcha\Settings;
use MfLocalCaptcha\Views;
use MfLocalCaptcha\Rest\RestRoutes;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

/**
 * Initialize Mega Forms Local Captcha plugin.
 */
class Main {
	/**
	 * Registers various actions to load the
	 * main plugin features at specific times.
	 *
	 * @return void
	 */
	public function initialize() {
		// Start our own session handler.
		add_action( 'init', array( $this, 'start_session' ), 1 );

		// Register translations before the main plugin features.
		$translations = new Translations();
		add_action( 'init', array( $translations, 'register' ), 5 );

		// Initialize the main plugin.
		add_action( 'init', array( $this, 'load_main' ), 10 );
	}

	/**
	 * Starts our own session handler.
	 *
	 * @return bool
	 */
	public function start_session() {
		if ( ! session_id() ) {
			session_start();
			return true;
		}

		return false;
	}

	/**
	 * Initializes the main plugin features.
	 *
	 * @return void
	 */
	public function load_main() {
		// Additional settings.
		$settings = new Settings();
		$settings->initialize();

		// Captcha code frontend views.
		$views = new Views();
		$views->initialize();

		// Submission validation.
		$submissions = new Submissions();
		$submissions->initialize();

		// REST endpoints.
		$rest = new RestRoutes();
		$rest->initialize();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_files' ) );
	}


	/**
	 * Registers the plugin's main CSS/JS file on the frontend.
	 *
	 * @return void
	 */
	public function enqueue_global_files() {
		wp_register_style( 'mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'assets/css/main.css', false, '1.1' );
		wp_enqueue_style( 'mf-local-captcha' );

		wp_register_script( 'mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'assets/js/main.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'mf-local-captcha' );
	}
}
