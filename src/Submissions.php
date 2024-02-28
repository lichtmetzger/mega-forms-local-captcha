<?php
/**
 * Submission validation.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

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
    public function initialize(): void {
        add_action('mf_submission_validation', [$this, 'validate']);
    }

    /**
     * Validate the MobiCMS captcha code against the submitted one.
     *
     * @param object $object Contains all submitted form data.
     * @return bool
     * @throws Exception if the captcha code is not correct.
     */
    public function validate(object $object): bool {

        // If MobiCMS captcha is enabled, validate it.
        if (mfget_option('mobicaptcha_status', false)) {
            $result = mfpost('_mf_captcha_code', $object->posted, '');
            $session = $_SESSION['_mf_captcha_code'];
            $codes = array_map('strtolower', explode(',', $session));

            if (null !== $result && !empty($codes)) {
                if (in_array(strtolower($result), $codes, true)) {
                    // CAPTCHA code is correct.
                    return true;
                } else {
                    // CAPTCHA code is incorrect, show an error to the user.
                    throw new Exception(__('Submission failed, you didn\'t complete the captcha challenge successfully.', 'mega-forms-local-captcha'));
                }
            }
        }

        return false;
    }
}
