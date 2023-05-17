<?php

namespace Qbus\MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

use Exception;

class Submissions {
    public function __construct() {

        add_action( 'mf_submission_validation', [$this, 'validate'], 10, 1 );

    }

    public function validate($object) {
        
        // If MobiCMS captcha is enabled, validate it
		if (mfget_option('mobicaptcha_status', false)) {
			$result = mfpost('_mf_captcha_code', $object->posted, '');
			$session = mf_session()->get('_mf_captcha_code');
			
			if ($result !== null && $session !== null) {
				if (strtolower($result) == strtolower($session)) {
					// CAPTCHA code is correct
				} else {
					// CAPTCHA code is incorrect, show an error to the user
					throw new Exception(__('Submission failed, you didn\'t complete the captcha challenge successfully.', 'mega-forms-local-captcha'));
				}
			}
		}

    }
}