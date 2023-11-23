<?php
/**
 * Plugin settings.
 *
 * @package mega-forms-local-captcha
 * @author Danny Schmarsel <dsc@qbus.de>
 */

namespace MfLocalCaptcha;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

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
	public function initialize() {

		// Tabs.
		add_filter( 'mf_option_tabs', array( $this, 'manage_option_tabs' ), 10, 1 );

		// Options.
		add_filter( 'mf_settings_options', array( $this, 'manage_options' ), 10, 1 );

	}

	/**
	 * Add new settings tabs to Mega Forms.
	 *
	 * @param  array $tabs Preregistered tabs.
	 * @return array
	 */
	public function manage_option_tabs( $tabs ) {

		// Add subtab to "Integrations".
		$tabs['integrations']['children']['local-captcha'] = __( 'Local Captcha', 'mega-forms-local-captcha' );

		return $tabs;

	}

	/**
	 * Add new option pages to a settings tab.
	 *
	 * @param  array $options Preregistered option page content.
	 * @return array
	 */
	public function manage_options( $options ) {

		// Create new local captcha options.
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
