<?php
/**
 * Plugin views.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

use Mobicms\Captcha\Image;
use Mobicms\Captcha\Code;
use MfLocalCaptcha\Audio\Mp3;

/**
 * Register frontend captcha code views.
 */
class Views {
	/**
	 * Register an action to load the
	 * frontend captcha box at a specific time.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'mf_after_hidden_inputs', array( $this, 'after_hidden_inputs' ), 10 );
	}

	/**
	 * Loads the captcha code after the hidden input fields of a form.
	 *
	 * @return void
	 */
	public function after_hidden_inputs() {

		// If MobiCMS Captcha is enabled, load it.
		if ( mfget_option( 'mobicaptcha_status', false ) ) {
			$code        = (string) new Code();
			$stored_code = $_SESSION['_mf_captcha_code'] ?? '';
			$mp3         = new Mp3();
			$mp3_stream  = $mp3->generate_stream_from_code( $code );

			if ( $mp3_stream ) {
				$html_audio_element = '
				<div class="mf-captcha-play-audio">
					<audio id="captcha-player" src="data:audio/mp3;base64,' . $mp3_stream . '" type="audio/mp3"></audio>
					<div class="play-button" onclick="document.getElementById(\'captcha-player\').play()">'
						. esc_html( __( 'Have verification code read out', 'mega-forms-local-captcha' ) ) .
					'</div>
				</div>';
			} else {
				$html_audio_element = '
				<div class="mf-captcha-play-audio">
					<div class="api-error">'
					. esc_html( __( 'An audio file cannot be generated at the moment. Please try again later.', 'mega-forms-local-captcha' ) ) . '
					</div>
				</div>';
			}

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
			if ( ! $stored_code ) {
				$_SESSION['_mf_captcha_code'] = $code;
			} else {
				$_SESSION['_mf_captcha_code'] = $stored_code . ',' . $code;
			}

			echo '<div class="mf_input_captcha_wrapper">
				<span class="mf_label">' . esc_html( __( 'Verification code', 'mega-forms-local-captcha' ) ) . '</span>
				<span class="mf_required">*</span>
				<div class="mf_input_captcha">
					<img alt="' . esc_html( __( 'Verification code', 'mega-forms-local-captcha' ) ) . '" class="mf-captcha-image" src="' . esc_html( new Image( $code ) ) . '">
					<input type="text" placeholder="ABCD" name="_mf_captcha_code" class="mf-captcha-image">
				</div>
				<div class="mf_captcha_functions">
					<div class="mf-captcha-regenerate">' . esc_html( __( 'Regenerate verification code', 'mega-forms-local-captcha' ) ) . '</div>
					' . $html_audio_element . '
					<div class="error-response"></div>
				</div>
			</div>';
		}

	}
}
