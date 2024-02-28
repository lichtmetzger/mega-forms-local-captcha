<?php
/**
 * Register Rest endpoints.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha\Rest;

/**
 * Register RestRoutes class.
 */
class RestRoutes {

    /**
     * Setup Rest routes.
     *
     * @return void
     */
    public function initialize(): void {
        add_action('rest_api_init', [$this, 'registerGetCaptchaRoute']);
    }

    /**
     * Register a route to receive a captcha image.
     * This results in the URL /wp-json/mega-forms/v1/get-captcha/
     *
     * @return void
     */
    public function registerGetCaptchaRoute(): void {
        $get_captcha_callback = new GetCaptchaCallback();

        register_rest_route(
            'mega-forms/v1',
            '/get-captcha/',
            [
                'methods' => 'GET',
                'callback' => [$get_captcha_callback, 'initialize'],
                'permission_callback' => '__return_true',
                // No arguments.
                'args' => [],
            ],
        );
    }
}
