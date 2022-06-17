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
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->register_custom_taxonomies();
	}


    /**
     * Send Notification Email.
     *
     * This function sends a notification email after files have been uploaded.
     *
     * @since 2.1.2
     *
     * @global object $blog_id The ID of the current blog.
     *
     * @redeclarable
     *
     * @param object $user The user that uploaded the files.
     * @param array $uploaded_file_paths An array of full paths of the uploaded
     *        files.
     * @param array $userdata_fields An array of userdata fields, if any.
     * @param array $params The shortcode attributes.
     *
     * @return string Empty if operation was successful, an error message otherwise.
     */
    // public function send_notification_email($user, $uploaded_file_paths, $userdata_fields, $params) {

    //     // $a = func_get_args();
    //     // $a = WFU_FUNCTION_HOOK(__FUNCTION__, $a, $out);
    //     // if (isset($out['vars'])) foreach($out['vars'] as $p => $v) $$p = $v; switch($a) { case 'R': return $out['output']; break; case 'D': die($out['output']); }
        
    //     global $blog_id;

    //     $plugin_options = wfu_decode_plugin_options(get_option( "wordpress_file_upload_options" ));
        
    //     //get consent status
    //     $consent_revoked = ( $plugin_options["personaldata"] == "1" && $params["consent_result"] == "0" );
    //     $not_store_files = ( $params["personaldatatypes"] == "userdata and files" );
    //     //create necessary variables
    //     $only_filename_list = "";
    //     $target_path_list = "";
    //     foreach ( $uploaded_file_paths as $filepath ) {
    //         $only_filename_list .= ( $only_filename_list == "" ? "" : ", " ).wfu_basename($filepath);
    //         $target_path_list .= ( $target_path_list == "" ? "" : ", " ).$filepath;
    //     }
        
    //     //apply wfu_before_email_notification filter
    //     $changable_data['recipients'] = $params["notifyrecipients"];
    //     $changable_data['subject'] = $params["notifysubject"];
    //     $changable_data['message'] = $params["notifymessage"];
    //     $changable_data['headers'] = $params["notifyheaders"];
    //     $changable_data['user_data'] = $userdata_fields;
    //     $changable_data['filename'] = $only_filename_list;
    //     $changable_data['filepath'] = $target_path_list;
    //     $changable_data['error_message'] = '';
    //     $additional_data['shortcode_id'] = $params["uploadid"];
    //     /**
    //      * Customize Notification Email.
    //      *
    //      * This filter allows custom actions to modify the notification email
    //      * that is sent after a file upload.
    //      *
    //      * @since 2.7.3
    //      *
    //      * @param array $changable_data {
    //      *     Email parameters that can be changed.
    //      *
    //      *     @type string $recipients A comma-separated list of email recipients.
    //      *     @type string $subject The email subject.
    //      *     @type string $message The email body.
    //      *     @type array $user_data Additional user data associated with the
    //      *           uploaded files.
    //      *     @type string $filename A comma-separated list of file names.
    //      *     @type string $filepath A comma-separated list of file full paths.
    //      *     @type string $error_message An error message that needs to be
    //      *           populated in case the email must not be sent.
    //      * }
    //      * @param array $additional_data {
    //      *     Additional parameters of the upload.
    //      *
    //      *     @type int $shortcode_id The plugin ID of the upload form.
    //      * }
    //      */
    //     $ret_data = apply_filters('wfu_before_email_notification', $changable_data, $additional_data);
        
    //     if ( $ret_data['error_message'] == '' ) {
    //         $notifyrecipients = $ret_data['recipients'];
    //         $notifysubject = $ret_data['subject'];
    //         $notifymessage = $ret_data['message'];
    //         $notifyheaders = $ret_data['headers'];
    //         $userdata_fields = $ret_data['user_data'];
    //         $only_filename_list = $ret_data['filename'];
    //         $target_path_list = $ret_data['filepath'];

    //         if ( 0 == $user->ID ) {
    //             $user_login = "guest";
    //             $user_email = "";
    //         }
    //         else {
    //             $user_login = $user->user_login;
    //             $user_email = $user->user_email;
    //         }
    //         $search = array ('/%useremail%/', '/%n%/', '/%dq%/', '/%brl%/', '/%brr%/');	 
    //         $replace = array ($user_email, "\n", "\"", "[", "]");
    //         foreach ( $userdata_fields as $userdata_key => $userdata_field ) { 
    //             $ind = 1 + $userdata_key;
    //             array_push($search, '/%userdata'.$ind.'%/');  
    //             array_push($replace, $userdata_field["value"]);
    //         }   
    //         //		$notifyrecipients =  trim(preg_replace('/%useremail%/', $user_email, $params["notifyrecipients"]));
    //         $notifyrecipients =  preg_replace($search, $replace, $notifyrecipients);
    //         $search = array ('/%n%/', '/%dq%/', '/%brl%/', '/%brr%/');	 
    //         $replace = array ("\n", "\"", "[", "]");
    //         $notifyheaders =  preg_replace($search, $replace, $notifyheaders);
    //         $search = array ('/%username%/', '/%useremail%/', '/%filename%/', '/%filepath%/', '/%blogid%/', '/%pageid%/', '/%pagetitle%/', '/%n%/', '/%dq%/', '/%brl%/', '/%brr%/');	 
    //         $replace = array ($user_login, ( $user_email == "" ? "no email" : $user_email ), $only_filename_list, $target_path_list, $blog_id, $params["pageid"], sanitize_text_field(get_the_title($params["pageid"])), "\n", "\"", "[", "]");
    //         foreach ( $userdata_fields as $userdata_key => $userdata_field ) { 
    //             $ind = 1 + $userdata_key;
    //             array_push($search, '/%userdata'.$ind.'%/');  
    //             array_push($replace, $userdata_field["value"]);
    //         }   
    //         $notifysubject = preg_replace($search, $replace, $notifysubject);
    //         $notifymessage = preg_replace($search, $replace, $notifymessage);

    //         if ( $params["attachfile"] == "true" ) {
    //             $notify_sent = wp_mail($notifyrecipients, $notifysubject, $notifymessage, $notifyheaders, $uploaded_file_paths); 
    //         }
    //         else {
    //             $notify_sent = wp_mail($notifyrecipients, $notifysubject, $notifymessage, $notifyheaders); 
    //         }
    //         //delete files if it is required by consent policy
    //         if ( $consent_revoked && $not_store_files ) {
    //             foreach ( $uploaded_file_paths as $file ) wfu_unlink($file, "wfu_send_notification_email");
    //         }
    //         return ( $notify_sent ? "" : WFU_WARNING_NOTIFY_NOTSENT_UNKNOWNERROR );
    //     }
    //     else return $ret_data['error_message'];
    // }

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
    public function notify_admin($subject, $message) {
        // $a = func_get_args();
        // $a = WFU_FUNCTION_HOOK(__FUNCTION__, $a, $out);
        // if (isset($out['vars'])) foreach($out['vars'] as $p => $v) $$p = $v; switch($a) { case 'R': return $out['output']; break; case 'D': die($out['output']); }
        $admin_email = get_option("admin_email");
        if ( $admin_email === false ) return;
        wp_mail($admin_email, $subject, $message);
    }

}

// new Moderni_Form_Notifications();