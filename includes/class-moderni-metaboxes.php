<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Metaboxes {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->register();
	}

    /**
	 * Register custom Post Type "mvf_property" functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register() {

		add_action( "add_meta_boxes", array( $this, "register_meta_boxes" ) );
        add_action( "save_post", array( $this, "save_meta_box_data" ) );
        add_action( "save_post", array( $this, "save_vid_meta_box_data" ) );
        add_action( "save_post", array( $this, "save_gellary_meta_box_data" ) );

	}

    /**
	 * Register Meta boxes for Custom Post Type "mvf_property"
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_meta_boxes() {

        add_meta_box(
            'mvf_property_meta_box_id',
            __( 'Property Details', 'moderni-form' ),
            array( $this, 'meta_box_callback' ),
            MODERNI_FORM_CPT_NAME,
            'normal', //'advance', 'normal', 'side'
            'high' // 'default', 'low', 'core'
        ); // ( $id:string, $title:string, $callback:callable, $screen:string|array|WP_Screen|null, $context:string, $priority:string, $callback_args:array|null )
        add_meta_box(
            'mvf_property_vid_meta_box_id',
            __( 'Project Video', 'moderni-form' ),
            array( $this, 'meta_box_video_callback' ),
            MODERNI_FORM_CPT_NAME,
            'normal', //'advance', 'normal', 'side'
            'high' // 'default', 'low', 'core'
        ); // ( $id:string, $title:string, $callback:callable, $screen:string|array|WP_Screen|null, $context:string, $priority:string, $callback_args:array|null )
        add_meta_box(
            'mvf_project_gellery_meta_box_id',
            __( 'Project Gallery', 'moderni-form' ),
            array( $this, 'meta_box_gellery_callback' ),
            MODERNI_FORM_CPT_NAME,
            'normal', //'advance', 'normal', 'side'
            'high' // 'default', 'low', 'core'
        ); // ( $id:string, $title:string, $callback:callable, $screen:string|array|WP_Screen|null, $context:string, $priority:string, $callback_args:array|null )

	}

    /**
	 * Register Meta boxes callback Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function meta_box_callback( $post ) {

        wp_nonce_field( 'mvf_meta_data_gen', "mvf_meta_data_gen_nonce" );

        $data = get_post_meta( $post->ID, '_mvf_property_detail', true );

        $street			= @$data[ 'street' ] ?: '';
        $street2		= @$data[ 'street2' ] ?: '';
        $city			= @$data[ 'city' ] ?: '';
        $state			= @$data[ 'state' ] ?: '';
        $zip_code		= @$data[ 'zip_code' ] ?: '';
        $name			= @$data[ 'name' ] ?: '';
        $email			= @$data[ 'email' ] ?: '';
        $telephone		= @$data[ 'telephone' ] ?: '';

        echo '<label for="mvf_property_street">' . __( 'Street:', 'moderni-form' ) . '</label><input type="text" class="widefat" size="25" name="mvf_property_street" id="mvf_property_street" value="' . esc_attr( $street ) . '" />';
        echo '<label for="mvf_property_street2">' . __( 'Street 2:', 'moderni-form' ) . '</label><input type="text" class="widefat" size="25" name="mvf_property_street2" id="mvf_property_street2" value="' . esc_attr( $street2 ) . '" />';
        echo '<label for="mvf_property_city">' . __( 'City:', 'moderni-form' ) . '</label><input type="text" class="widefat" size="25" name="mvf_property_city" id="mvf_property_city" value="' . esc_attr( $city ) . '" />';
        echo '<label for="mvf_property_state">' . __( 'State:', 'moderni-form' ) . '</label><input type="text" class="widefat" size="25" name="mvf_property_state" id="mvf_property_state" value="' . esc_attr( $state ) . '" />';
        echo '<label for="mvf_property_zip_code">' . __( 'Zip code:', 'moderni-form' ) . '</label><input type="text" class="widefat" size="25" name="mvf_property_zip_code" id="mvf_property_zip_code" value="' . esc_attr( $zip_code ) . '" />';
        echo '<label for="mvf_property_name">' . __( 'Submitter\'s Name:', 'moderni-form' ) . '</label><input type="url" class="widefat" size="25" name="mvf_property_name" id="mvf_property_name" value="' . esc_attr( $name ) . '" />';
        echo '<label for="mvf_property_email">' . __( 'E-mail:', 'moderni-form' ) . '</label><input type="url" class="widefat" size="25" name="mvf_property_email" id="mvf_property_email" value="' . esc_attr( $email ) . '" />';
        echo '<label for="mvf_property_telephone">' . __( 'Telephone/Mobile:', 'moderni-form' ) . '</label><input type="url" class="widefat" size="25" name="mvf_property_telephone" id="mvf_property_telephone" value="' . esc_attr( $telephone ) . '" />';

	}
    /**
	 * Register Meta boxes callback Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function meta_box_video_callback( $post ) {
        wp_nonce_field( 'mvf_meta_vid_data_gen', "mvf_meta_vid_data_gen_nonce" );

        $data = get_post_meta( $post->ID, '_mvf_project_vid_url', true );

        echo '<label for="mvf_property_vid_url">' . __( 'Uploaded Video:', 'moderni-form' ) . '</label><input type="url" class="widefat" size="25" name="mvf_property_vid_url" id="mvf_property_vid_url" value="' . esc_attr( $data ) . '" />';

	}
    /**
	 * Register Meta boxes callback Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function meta_box_gellery_callback( $post ) {
        wp_nonce_field( 'mvf_meta_gallery_data_gen', "mvf_meta_gallery_data_gen_nonce" );

		echo '<table class="form-table">';
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, '_mvf_project_gallery', true);

			// begin a table row with
			echo '<tr>
			<th><label for="mvf_project_gallery">' . __( "Add Project Gallery Items" ) . '</label></th>
			<td>';

			$meta_html = null;
			if ($meta) {
				$meta_html .= '<ul class="moderni_form_gallery_list">';
				$meta_array = explode(',', $meta);
				foreach ($meta_array as $meta_gallery_item_id) {
						$meta_html .= '<li><div class="moderni_form_gallery_container"><span class="moderni_form_close"><img id="' . esc_attr($meta_gallery_item_id) . '" src="' . wp_get_attachment_thumb_url($meta_gallery_item_id) . '"></span></div></li>';
				}
				$meta_html .= '</ul>';
			}
			echo '<input id="moderni_form_gallery" type="hidden" name="moderni_form_gallery" value="' . esc_attr($meta) . '" />
			<span id="moderni_form_gallery_src">' . $meta_html . '</span>
			<div class="morderni_form_button_container"><input id="moderni_form_gallery_button" type="button" value="Add Gallery" /></div>';

			echo '</td></tr>';

		echo '</table>'; // end table

	}

    /**
	 * Register Meta boxes Data Save/Store Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function save_meta_box_data( $post_id ) {

        if( ! isset( $_POST[ 'mvf_meta_data_gen_nonce' ] ) ) return $post_id;
        $nonce = $_POST[ 'mvf_meta_data_gen_nonce' ];

        if( ! wp_verify_nonce( $nonce, 'mvf_meta_data_gen' ) ) return $post_id;
        if( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) return $post_id;
        if( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;

        $data = array(
            'street'        => isset( $_POST['mvf_property_street'] ) ? sanitize_text_field( $_POST['mvf_property_street'] ) : '',
            'street2'       => isset( $_POST['mvf_property_street2'] ) ? sanitize_text_field( $_POST['mvf_property_street2'] ) : '',
            'city'          => isset( $_POST['mvf_property_city'] ) ? sanitize_text_field( $_POST['mvf_property_city'] ) : '',
            'state'         => isset( $_POST['mvf_property_state'] ) ? sanitize_text_field( $_POST['mvf_property_state'] ) : '',
            'zip_code'      => isset( $_POST['mvf_property_zip_code'] ) ? sanitize_text_field( $_POST['mvf_property_zip_code'] ) : '',
            'name'       	=> isset( $_POST['mvf_property_name'] ) ? sanitize_url( $_POST['mvf_property_name'] ) : '',
            'email'       	=> isset( $_POST['mvf_property_email'] ) ? sanitize_url( $_POST['mvf_property_email'] ) : '',
            'telephone'     => isset( $_POST['mvf_property_telephone'] ) ? sanitize_url( $_POST['mvf_property_telephone'] ) : '',
        );

        // Update Meta Field
        update_post_meta( $post_id, '_mvf_property_detail', $data );
	}

    /**
	 * Register Meta boxes Data Save/Store Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function save_vid_meta_box_data( $post_id ) {

        if( ! isset( $_POST[ 'mvf_meta_vid_data_gen_nonce' ] ) ) return $post_id;
        $nonce = $_POST[ 'mvf_meta_vid_data_gen_nonce' ];

        if( ! wp_verify_nonce( $nonce, 'mvf_meta_vid_data_gen' ) ) return $post_id;
        if( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) return $post_id;
        if( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;

        $data = isset( $_POST['mvf_property_vid_url'] ) ? sanitize_url( $_POST['mvf_property_vid_url'] ) : '';

        // Update Meta Field
        update_post_meta( $post_id, '_mvf_project_vid_url', $data );
	}

    /**
	 * Register Meta boxes Data Save/Store Functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function save_gellary_meta_box_data( $post_id ) {

		// Verify nonce
		if( ! isset( $_POST[ 'mvf_meta_gallery_data_gen_nonce' ] ) ) return $post_id;
		$nonce = $_POST[ 'mvf_meta_gallery_data_gen_nonce' ];

		if( ! wp_verify_nonce( $nonce, 'mvf_meta_gallery_data_gen' ) ) return $post_id;
		if( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) return $post_id;
		if( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;

		$new_meta_value = esc_attr( $_POST[ 'moderni_form_gallery' ] );
		$meta_key       = '_mvf_project_gallery';
		$meta_value     = get_post_meta( $post_id, $meta_key, true );

		// If theres a new meta value and the existing meta value is empty
		if ( $new_meta_value && $meta_value == null ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			// If theres a new meta value and the existing meta value is different
		} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		} elseif ( $new_meta_value == null && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

	}



}

new Moderni_Form_Metaboxes();