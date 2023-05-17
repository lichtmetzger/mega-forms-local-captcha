<?php

namespace Qbus\MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

use Mobicms\Captcha\Image;
use Mobicms\Captcha\Code;

class Views {
    public function __construct() {

        add_action( 'mf_after_hidden_inputs', [$this, 'afterHiddenInputs'], 10 );

    }

    public function afterHiddenInputs() {
        
        // If MobiCMS Captcha is enabled, load it
		if (mfget_option('mobicaptcha_status', false)) {
			$code = (string) new Code;
			mf_session()->set('_mf_captcha_code', $code);

			echo
			'<div class="mf_input_captcha_wrapper">
				<span class="mf_label">'.__('Verification code', 'mega-forms-local-captcha').'</span>
				<span class="mf_required">*</span>
				<div class="mf_input_captcha">
					<img alt="'.__('Verification code', 'mega-forms-local-captcha').'" src="'.new Image($code).'">
					<input type="text" placeholder="ABCD" name="_mf_captcha_code">
				</div>
			</div>';
		}

    }
}