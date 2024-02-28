<?php
/**
 * Plugin settings.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

/**
 * Initialize Mega Forms Local Captcha plugin settings.
 */
class Settings {
    /**
     * Registers various filters to load the
     * plugin settings at specific times.
     *
     * @return void
     */
    public function initialize(): void {

        // Tabs.
        add_filter('mf_option_tabs', [$this, 'manageOptionTabs']);

        // Options.
        add_filter('mf_settings_options', [$this, 'manageOptions']);
    }

    /**
     * Add new settings tabs to Mega Forms.
     *
     * @param array $tabs Preregistered tabs.
     * @return array
     */
    public function manageOptionTabs(array $tabs): array {

        // Add subtab to "Integrations".
        $tabs['integrations']['children']['local-captcha'] = __('Local Captcha', 'mega-forms-local-captcha');

        return $tabs;
    }

    /**
     * Add new option pages to a settings tab.
     *
     * @param array $options Preregistered option page content.
     * @return array
     */
    public function manageOptions(array $options): array {

        // Create new local captcha options.
        $options['local-captcha'] = [
            'mobicaptcha_status' => [
                'priority' => 10,
                'type' => 'switch',
                'label' => __('Enable MobiCMS Captcha', 'mega-forms-local-captcha'),
                'desc' => __('Switch this on to enable locally generated MobiCMS captchas on all forms.', 'mega-forms-local-captcha'),
                'value' => mfget_option('mobicaptcha_status', false),
                'sanitization' => 'boolean',
            ],
            'mobicaptcha_tts_locale' => [
                'priority' => 11,
                'type' => 'text',
                'label' => __('TTS Locale', 'mega-forms-local-captcha'),
                'desc' => __('Enter a locale here that should be used for creating the TTS audio. Example: de, en, fr', 'mega-forms-local-captcha'),
                'value' => mfget_option('mobicaptcha_tts_locale'),
                'sanitization' => 'string',
            ],
        ];

        return $options;
    }
}
