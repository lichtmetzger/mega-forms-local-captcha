<?php

namespace Qbus\MfLocalCaptcha;

use Qbus\MfLocalCaptcha\Translations;
use Qbus\MfLocalCaptcha\Settings;
use Qbus\MfLocalCaptcha\Views;


if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class Initialize {
    public function __construct() {
        // Register translations before everything else
        $translations = new Translations;
        add_action( 'init', [$translations, 'register'], 5 );

        add_action( 'init', [$this, 'loadMain'], 10 );
    }

    public function loadMain() {
        new Settings;
        new Views;
        add_action( 'wp_enqueue_scripts', [$this, 'enqueueGlobalStyles'] );
    }

    public function enqueueGlobalStyles() {
        wp_register_style( 'mf-local-captcha', MF_LOCAL_CAPTCHA_PLUGIN_URI . 'css/main.css', false, '1.1' );
        wp_enqueue_style( 'mf-local-captcha' );
    }
}