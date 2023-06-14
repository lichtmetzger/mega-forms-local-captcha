<?php

namespace Qbus\MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

use Exception;

class Submissions {
	public function __construct() {

		add_action( 'mf_submission_validation', array( $this, 'validate' ), 10, 1 );

	}

	public function validate( $object ) {

		// If MobiCMS captcha is enabled, validate it
		if ( mfget_option( 'mobicaptcha_status', false ) ) {
			$result = mfpost( '_mf_captcha_code', $object->posted, '' );
			// $session = mf_session()->get('_mf_captcha_code');
			$session = $_SESSION['_mf_captcha_code'];
			$codes   = array_map( 'strtolower', explode( ',', $session ) );

			if ( $result !== null && $codes !== null ) {
				if ( in_array( strtolower( $result ), $codes ) ) {
					// CAPTCHA code is correct
					// mf_session()->set('_mf_captcha_code', '');
				} else {
					// CAPTCHA code is incorrect, show an error to the user
					throw new Exception( __( 'Submission failed, you didn\'t complete the captcha challenge successfully.', 'mega-forms-local-captcha' ) );
				}
			}
		}

	}
}
