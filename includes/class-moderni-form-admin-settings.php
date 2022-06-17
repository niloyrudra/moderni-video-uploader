<?php

/**
 * Fired during plugin activation
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Admin_settings{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'add_settings' ) );
	}

    public static function add_settings() {
        /**
         * Setting Register
         */
        register_setting( 'mvf_customize', 'mvf_customize' );

        /**
         * Settings Section
         */
        add_settings_section(
            'mvf_customize_section', // ID
            __( 'Customizer', 'moderni-form' ), // Title
            array( __CLASS__, 'settings_customize_section_callback' ), // Callback
            'mvf-settings' // Page
        );

        /**
         * Settings Fields
         */
        // MAXIMUM DURATION
        add_settings_field(
            'mvf_max_duration_field_id', // ID
            __( 'Maximum Duration', 'moderni-form' ), // Title
            array( __CLASS__, 'number_field_callback' ), // Field Callback
            'mvf-settings', // Page
            'mvf_customize_section',
            array(
                'type'          => 'number',
                'option_group'  => 'mvf_customize',
                'name'          => 'mvf_customize[mvf_max_duration]',
                "label_for"     => "mvf_max_duration",
                "label"         => "",
                'value'         => (empty(get_option('mvf_customize')['mvf_max_duration']))
            ? 10 : get_option('mvf_customize')['mvf_max_duration'],
                'description'   => __( 'Set the maximum video duration for uploading.', 'moderni-form' ),
                "class"         => "",
                "placeholder"   => "",
                "ext"           => "minutes"
            )
        );

        // MAXIMUM SIZE
        add_settings_field(
            'mvf_max_size_field_id', // ID
            __( 'Maximum Duration', 'moderni-form' ), // Title
            array( __CLASS__, 'number_field_callback' ), // Field Callback
            'mvf-settings', // Page
            'mvf_customize_section',
            array(
                'type'          => 'number',
                'option_group'  => 'mvf_customize',
                'name'          => 'mvf_customize[mvf_max_size]',
                "label_for"     => "mvf_max_size",
                "label"         => "",
                'value'        => (empty(get_option('mvf_customize')['mvf_max_size']))
            ? 1000000000 : get_option('mvf_customize')['mvf_max_size'],
                'description'  => __( 'Set the maximum video size for uploading in bytes. e.g 1 000 000 000 bytes = 1 gb', 'moderni-form' ),
                "class"         => "",
                "placeholder"   => "",
                "ext"           => "bytes"
            )
        );

    }

    /**
     * Settings callbacks
     */
    public static function settings_customize_section_callback(  ) {

        //echo __( 'Here you can specify the settings for each included functionality.', 'cbb' );
    }

    public static function number_field_callback( $args ) {
        $label_for = $args['label_for'];
        $label = $args['label'] ? $args['label'] . ': ' : '';
        $ext = $args['ext'] ? '<i>' . $args['ext'] . '</i>' : '';
        $class = $args['class'] ?: '';
        $type = $args['type'] ?: 'text';
        $placeholder = $args['placeholder'] ?: '';
        $description = $args['description'] ? '<p class="description">' . $args['description'] . '</p>' : '';
        $name = $args['name'];
        $value = $args['value'];

        echo '<label for="' . $label_for . '">' . $label . '
            <input type="' . $type . '" name="' . $name . '" value="' . $value . '" id="' . $label_for . '" class="' . $class . '" placeholder="' . $placeholder . '" />&nbsp;'. $ext .'
        </label>' . $description;
    }


}

