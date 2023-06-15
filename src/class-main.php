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
		add_action( 'init', array( $this, 'start_session' ), 1 );

		// Register translations before everything else
		$translations = new Translations();
		add_action( 'init', array( $translations, 'register' ), 5 );

		add_action( 'init', array( $this, 'load_main' ), 10 );
	}

	public function start_session() {
		if ( ! session_id() ) {
			session_start();
		}
	}

	public function load_main() {
		new Settings();
		new Views();
		new Submissions();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_styles' ) );
	}

	public function enqueue_global_styles() {
		wp_register_style( 'mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'css/main.css', false, '1.1' );
		wp_enqueue_style( 'mf-local-captcha' );
	}
}
