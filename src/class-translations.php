<?php

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

class Translations {
	public function register() {
		// Relative path to WP_PLUGIN_DIR
		load_plugin_textdomain( 'mega-forms-local-captcha', false, 'mega-forms-local-captcha/languages/' );
	}
}
