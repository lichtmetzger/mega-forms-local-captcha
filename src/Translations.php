<?php
/**
 * Plugin translations.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

/**
 * Registers plugin translations.
 */
class Translations {
    /**
     * Register .mo language files.
     *
     * @return void
     */
    public function register(): void {
        // Relative path to WP_PLUGIN_DIR.
        load_plugin_textdomain('mega-forms-local-captcha', false, 'mega-forms-local-captcha/languages/');
    }
}
