<?php
/**
 * Register a callback function for the register_get_captcha_route REST route.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha\Rest;

use \WP_REST_Response;
use Mobicms\Captcha\Image;
use Mobicms\Captcha\Code;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

/**
 * Register GetCaptchaCallback class.
 */
class GetCaptchaCallback {

	/**
	 * Register the callback method.
	 *
	 * @param  WP_REST_Request $request The current request object.
	 * @return array Multi-dimensional array with detailed data.
	 */
	public function initialize( $request ) {
		$img_base64 = null;
		$code       = (string) new Code();

		if ( $code ) {
			$_SESSION['_mf_captcha_code'] = $code;

			// Fields.
			$img_base64 = esc_html( new Image( $code ) );

			// Merge subdata into main data.
			$response_message = 'Captcha successfully generated.';
		} else {
			// No data is found.
			$response_message = 'Captcha could not be generated.';
		}

		$response_data = array(
			'message'      => $response_message,
			'image_base64' => $img_base64,
		);

		$response = new WP_REST_Response( $response_data );

		return $response;
	}

}
