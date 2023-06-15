<?php
/**
 * Submission validation.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

use Exception;

/**
 * Register submission .
 */
class Submissions {
	/**
	 * Registers actions to load the
	 * submission validation at a specific time.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'mf_submission_validation', array( $this, 'validate' ), 10, 1 );

	}

	/**
	 * Validate the MobiCMS captcha code against the submitted one.
	 *
	 * @param  object $object Contains all submitted form data.
	 * @throws Exception if the captcha code is not correct.
	 * @return mixed
	 */
	public function validate( $object ) {

		// If MobiCMS captcha is enabled, validate it.
		if ( mfget_option( 'mobicaptcha_status', false ) ) {
			$result  = mfpost( '_mf_captcha_code', $object->posted, '' );
			$session = $_SESSION['_mf_captcha_code'];
			$codes   = array_map( 'strtolower', explode( ',', $session ) );

			if ( null !== $result && null !== $codes ) {
				if ( in_array( strtolower( $result ), $codes, true ) ) {
					// CAPTCHA code is correct.
					return true;
				} else {
					// CAPTCHA code is incorrect, show an error to the user.
					throw new Exception( __( 'Submission failed, you didn\'t complete the captcha challenge successfully.', 'mega-forms-local-captcha' ) );
				}
			}
		}

	}
}
