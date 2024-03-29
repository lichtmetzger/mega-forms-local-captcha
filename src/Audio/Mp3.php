<?php
/**
 * MP3 stream handling.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha\Audio;

use Exception;
use MfLocalCaptcha\duncan3dc\Speaker\Providers\GoogleProvider;
use MfLocalCaptcha\duncan3dc\Speaker\TextToSpeech;

/**
 * Register Mp3 class.
 */
class Mp3 {

    /**
     * Generates a base64-encoded MP3 stream, if possible.
     *
     * @param string $code Alphanumeric captcha code string.
     * @return bool|string Base-64 encoded MP3 stream or false.
     */
    public function generateStreamFromCode(string $code): bool|string {
        mfget_option('mobicaptcha_tts_locale') ? $locale = mfget_option('mobicaptcha_tts_locale') : $locale = 'en';
        $tts_provider = new GoogleProvider($locale);
        $tts = new TextToSpeech($code, $tts_provider);

        // Try generating an MP3 file - we might run into API limits here.
        try {
            $mp3_base64 = base64_encode($tts->getAudioData());
        } catch (Exception) {
            return false;
        }

        return $mp3_base64;
    }
}
