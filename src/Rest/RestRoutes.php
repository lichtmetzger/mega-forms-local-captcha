<?php
/**
 * Register Rest endpoints.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha\Rest;

use MfLocalCaptcha\Rest\ExampleCallback;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

/**
 * Register RestRoutes class.
 */
class RestRoutes {

	/**
	 * Setup Rest routes.
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'rest_api_init', array( $this, 'register_get_captcha_route' ) );
	}

	/**
	 * Register a route to receive a captcha image.
	 * This results in the URL /wp-json/mega-forms/v1/get-captcha/
	 *
	 * @return void
	 */
	public function register_get_captcha_route() {
		$get_captcha_callback = new GetCaptchaCallback();

		register_rest_route(
			'mega-forms/v1',
			'/get-captcha/',
			array(
				'methods'             => 'GET',
				'callback'            => array( $get_captcha_callback, 'initialize' ),
				'permission_callback' => '__return_true',
				// No arguments.
				'args'                => array(),
			),
		);
	}

}
