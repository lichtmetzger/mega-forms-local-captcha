<?php

namespace MfLocalCaptcha;

use MfLocalCaptcha\Translations;
use MfLocalCaptcha\Settings;
use MfLocalCaptcha\Views;


if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

class Main {
	public function initialize() {
		// Start our own session handler.
		add_action( 'init', array( $this, 'start_session' ), 1 );

		// Register translations before the main plugin features.
		$translations = new Translations();
		add_action( 'init', array( $translations, 'register' ), 5 );

		// Initialize the main plugin.
		add_action( 'init', array( $this, 'load_main' ), 10 );
	}

	public function start_session() {
		if ( ! session_id() ) {
			session_start();
		}
	}

	public function load_main() {
		// Load additional settings.
		$settings = new Settings();
		$settings->initialize();

		// Load captcha code frontend views.
		$views = new Views();
		$views->initialize();

		// Load submission validation.
		$submissions = new Submissions();
		$submussions->initialize();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_styles' ) );
	}

	public function enqueue_global_styles() {
		wp_register_style( 'mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'css/main.css', false, '1.1' );
		wp_enqueue_style( 'mf-local-captcha' );
	}
}
