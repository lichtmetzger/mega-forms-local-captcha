<?php
/**
 * Register a callback function for the register_get_captcha_route REST route.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha\Rest;

use MfLocalCaptcha\Audio\Mp3;
use MfLocalCaptcha\Mobicms\Captcha\Code;
use MfLocalCaptcha\Mobicms\Captcha\Image;
use WP_REST_Response;

/**
 * Register GetCaptchaCallback class.
 */
class GetCaptchaCallback {

    /**
     * Register the callback method.
     *
     * @return WP_REST_Response Multidimensional array with detailed data.
     */
    public function initialize(): WP_REST_Response {
        $img_base64 = null;
        $mp3_base64 = false;
        $code = (string)new Code();
        $mp3 = new Mp3();

        if ($code) {
            $_SESSION['_mf_captcha_code'] = $code;

            // Fields.
            $img_base64 = esc_html(new Image($code));
            $mp3_base64 = $mp3->generateStreamFromCode($code);

            // Merge subdata into main data.
            $response_message = 'Captcha successfully generated.';
        } else {
            // No data is found.
            $response_message = 'Captcha could not be generated.';
        }

        $response_data = [
            'message' => $response_message,
            'image_base64' => $img_base64,
            'mp3_base64' => $mp3_base64,
        ];

        return new WP_REST_Response($response_data);
    }
}
