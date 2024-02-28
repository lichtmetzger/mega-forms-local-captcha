<?php
/**
 * Main plugin initialization.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

use MfLocalCaptcha\Rest\RestRoutes;

/**
 * Initialize Mega Forms Local Captcha plugin.
 */
class Main {
    /**
     * Starts our own session handler.
     *
     * @return bool
     */
    public function startSession(): bool {
        if (!session_id()) {
            session_start();
            return true;
        }

        return false;
    }

    /**
     * Initializes the main plugin features.
     *
     * @return void
     */
    public function loadMain(): void {
        // Additional settings.
        $settings = new Settings();
        $settings->initialize();

        // Captcha code frontend views.
        $views = new Views();
        $views->initialize();

        // Submission validation.
        $submissions = new Submissions();
        $submissions->initialize();

        // REST endpoints.
        $rest = new RestRoutes();
        $rest->initialize();

        add_action('wp_enqueue_scripts', [$this, 'enqueueGlobalFiles']);
    }

    /**
     * Registers various actions to load the
     * main plugin features at specific times.
     *
     * @return void
     */
    public function initialize(): void {
        // Start our own session handler.
        add_action('init', [$this, 'startSession'], 1);

        // Register translations before the main plugin features.
        $translations = new Translations();
        add_action('init', [$translations, 'register'], 5);

        // Initialize the main plugin.
        add_action('init', [$this, 'loadMain']);
    }

    /**
     * Registers the plugin's main CSS/JS file on the frontend.
     *
     * @return void
     */
    public function enqueueGlobalFiles(): void {
        wp_register_style('mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'assets/css/main.css', false, '1.1');
        wp_enqueue_style('mf-local-captcha');

        wp_register_script('mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'assets/js/main.js', ['jquery'], '1.0', true);
        wp_enqueue_script('mf-local-captcha');

        // Pass translation variables to main script.
        wp_localize_script(
            'mf-local-captcha',
            'mflcTrans',
            [
                'read_captcha' => __('Have verification code read out', 'mega-forms-local-captcha'),
            ]
        );
    }
}
