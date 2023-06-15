<?php

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

class Settings {
	public function initialize() {

		// Tabs.
		add_filter( 'mf_option_tabs', array( $this, 'manage_option_tabs' ), 10, 1 );

		// Options.
		add_filter( 'mf_settings_options', array( $this, 'manage_options' ), 10, 1 );

	}

	public function manage_option_tabs( $tabs ) {

		// Insert a new subtab for local captcha into preexisting "Integrations"
		$tabs['integrations']['children']['local-captcha'] = __( 'Local Captcha', 'mega-forms-local-captcha' );

		return $tabs;

	}

	public function manage_options( $options ) {

		// Create new local captcha options
		$options['local-captcha'] = array(
			'mobicaptcha_status' => array(
				'priority'     => 10,
				'type'         => 'switch',
				'label'        => __( 'Enable MobiCMS Captcha', 'mega-forms-local-captcha' ),
				'desc'         => __( 'Switch this on to enable locally generated MobiCMS captchas on all forms.', 'mega-forms-local-captcha' ),
				'value'        => mfget_option( 'mobicaptcha_status', false ),
				'sanitization' => 'boolean',
			),
		);

		return $options;

	}
}
