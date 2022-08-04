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
class Moderni_Form_Notifications {

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
     * Send Notification Email to Admin.
     *
     * This function sends a notification email to admin.
     *
     * @since 1.0.0
     *
     * @redeclarable
     *
     * @param string $subject The email subject.
     * @param string $message The emal message.
     */
    public static function notify_admin( $project_id, $user_id='GUEST' ) {
                
        
        $admin_mail = get_option( 'admin_email' );
        $site_name = get_bloginfo("name");
        
        /* ************************* */
        $to = $admin_mail;
        
        $option_subject = @get_option('moderni_form_admin_mail_subject') ? get_option('moderni_form_admin_mail_subject') : $site_name . ' | ' . __('New Project') . ', ' . get_the_title( $project_id ) . '[#' . $project_id . '] ' . __( ' has been inserted.');        
        
        $option_body = @get_option('moderni_form_admin_mail_body') ? get_option('moderni_form_admin_mail_body') : '<p>' . __( "congratulation! New project" ) . '[#' . $project_id . ']' . __(' is inserted by user') . '[#' . $user_id . '].</p>';
		
		$option_body .= Moderni_Form_Notifications::get_project_detail( $project_id, $option_body );
        
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $site_name . ' <' . $admin_mail . '>',
            'Reply-To: ' . $site_name . ' <' . $admin_mail . '>',
        );
    
		$subject = $option_subject;
		$body = $option_body;
		$attachments = count( Moderni_Form_Notifications::get_project_gallery_attachments( $project_id ) ) > 0 ? Moderni_Form_Notifications::get_project_gallery_attachments( $project_id ) : array();
		
        wp_mail( $to, $subject, $body, $headers, $attachments );
        
    }
	
	public static function get_project_detail( $project_id, $email_content = '' ) {
		$email_content .= '<h3>' . __( "Project Details" ) . ':</h3>';
		$email_content = Moderni_Form_Notifications::get_project_meta_data( $project_id, $email_content );
		$email_content = Moderni_Form_Notifications::get_project_video_link( $project_id, $email_content );
		//$email_content = Moderni_Form_Notifications::get_project_gallery_images( $project_id, $email_content );
		
		return $email_content;
	}
	
	public static function get_project_meta_data( $project_id, $email_content = '' ) {
		
		$data = get_post_meta( $project_id, '_mvf_property_detail', true );

        $street			= @$data[ 'street' ] ?: '';
        $street2		= @$data[ 'street2' ] ?: '';
        $city			= @$data[ 'city' ] ?: '';
        $state			= @$data[ 'state' ] ?: '';
        $zip_code		= @$data[ 'zip_code' ] ?: '';
        $name			= @$data[ 'name' ] ? $data[ 'name' ] . '[#GUEST]': '';
        $email			= @$data[ 'email' ] ?: '';
        $telephone		= @$data[ 'telephone' ] ?: '';

        $email_content .= '<p><b>' . __( 'Street', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $street ) . '</p>';
        $email_content .= '<p><b>' . __( 'Street 2', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $street2 ) . '</p>';
        $email_content .= '<p><b>' . __( 'City', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $city ) . '</p>';
        $email_content .= '<p><b>' . __( 'State', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $state ) . '</p>';
       	$email_content .= '<p><b>' . __( 'Zip code', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $zip_code ) . '</p>';
		if($name) $email_content .= '<p><b>' . __( 'Submitter\'s Name', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $name ) . '</p>';
        if($email) $email_content .= '<p><b>' . __( 'E-mail', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $email ) . '</p>';
        if($telephone) $email_content .= '<p><b>' . __( 'Telephone/Mobile', 'moderni-form' ) . '</b>:&nbsp;' . esc_html( $telephone ) . '</p>';
		
		return $email_content;
	}

	public static function get_project_video_link( $project_id, $email_content = '' ) {

		$vid_url = get_post_meta( $project_id, '_mvf_project_vid_url', true );
		if( $vid_url ) {
			$email_content .= '<p><a href="' . $vid_url . '" target="_blank"><b><i>' . __( "Uploaded Video Clip Link" ) . '</i></b></a></p>';
		}
		return $email_content;
	}
	
	public static function get_project_gallery_images( $project_id, $email_content = '' ) {

		$project_meta_data = get_post_meta( $project_id, '_mvf_project_gallery', true );
			if ($project_meta_data) {
				$email_content .= '<ul style="list-style:none;">';
				$meta_array = explode(',', $project_meta_data);
				foreach ($meta_array as $meta_gallery_item_id) {
						$email_content .= '<li><img id="' . esc_attr($meta_gallery_item_id) . '" src="' . wp_get_attachment_thumb_url( $meta_gallery_item_id ) . '" style="display:block;width:300px;height:auto;" /></li>';
				}
				$email_content .= '</ul>';
			}
		
		return $email_content;
	}

	public static function get_project_gallery_attachments( $project_id ) {

		$project_meta_data = get_post_meta( $project_id, '_mvf_project_gallery', true );
		$attachment_array = array();
		if ($project_meta_data) {
			$meta_array = explode(',', $project_meta_data);
			foreach ($meta_array as $meta_gallery_item_id) {
				$attachment_array[] = wp_get_attachment_image_src( $meta_gallery_item_id, 'full' );
			}
		}
		return $attachment_array;
	}
}
