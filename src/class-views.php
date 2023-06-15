<?php

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

use Mobicms\Captcha\Image;
use Mobicms\Captcha\Code;

class Views {
	public function __construct() {

		add_action( 'mf_after_hidden_inputs', array( $this, 'afterHiddenInputs' ), 10 );

	}

	public function afterHiddenInputs() {

		// If MobiCMS Captcha is enabled, load it
		if ( mfget_option( 'mobicaptcha_status', false ) ) {
			$code       = (string) new Code();
			$storedCode = $_SESSION['_mf_captcha_code'];

			/*
			 * When embedding a contact form on an Elementor page, _mf_captcha_code is set multiple times,
			 * but only one captcha image is created on the first run.
			 *
			 * This results in an unsolvable captcha since the last stored code doesn't neccessarily match the captcha image.
			 * The exact reason for this behaviour is unknown.
			 * As a workaround, we make sure that generated captcha codes are appended to each other in the session.
			 * We then check against all of those in the mf_submission_validation hook.
			 *
			*/
			if ( ! $storedCode ) {
				$_SESSION['_mf_captcha_code'] = $code;
			} else {
				$_SESSION['_mf_captcha_code'] = $storedCode . ',' . $code;
			}

			echo '<div class="mf_input_captcha_wrapper">
				<span class="mf_label">' . __( 'Verification code', 'mega-forms-local-captcha' ) . '</span>
				<span class="mf_required">*</span>
				<div class="mf_input_captcha">
					<img alt="' . __( 'Verification code', 'mega-forms-local-captcha' ) . '" src="' . new Image( $code ) . '">
					<input type="text" placeholder="ABCD" name="_mf_captcha_code">
				</div>
			</div>';
		}

	}
}
