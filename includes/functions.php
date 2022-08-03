<?php
if ( ! defined( 'WPINC' ) ) exit;

// Register admin scripts for custom fields
function morderni_form_load_wp_admin_style() {
    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
    // admin always last
    wp_enqueue_style( 'morderni_form_admin_css', MODERNI_FORM_PLUGIN_DIR_URL . 'admin/css/morderni_form_admin.css' );
    wp_enqueue_script( 'morderni_form_admin_script', MODERNI_FORM_PLUGIN_DIR_URL . 'admin/js/morderni_form_admin.js' );
}
add_action( 'admin_enqueue_scripts', 'morderni_form_load_wp_admin_style' );


function user_can_save( $post_id, $plugin_file, $nonce ) {

    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $plugin_file ) );

    // Return true if the user is able to save; otherwise, false.
    return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

}

function has_files_to_upload( $id ) {
    return ( ! empty( $_FILES ) ) && isset( $_FILES[ $id ] );
}

function get_custom_post_type_template( $template ) {
    global $post;
    // $plugin_root_dir = WP_PLUGIN_DIR.'/moderni-form/';
    // if ( is_archive() || is_post_type_archive ( MODERNI_FORM_CPT_NAME ) ) {
    // if( get_post_type($post) == MODERNI_FORM_CPT_NAME ) {
    if( is_object( $post ) && $post->post_type === MODERNI_FORM_CPT_NAME ) {
         $template = MODERNI_FORM_PLUGIN_DIRNAME . '/template-parts/' . MODERNI_FORM_CPT_NAME . '-template.php';
    }
    return $template;
}

// add_filter( 'archive_template', 'get_custom_post_type_template' ) ;
// add_filter( 'single_template', 'get_custom_post_type_template' ) ;
// add_filter( 'singular_template', 'get_custom_post_type_template' ) ;
// add_filter( 'template_include', 'get_custom_post_type_template' ) ;



/**
 * ////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */

function moderni_form_frontend($content){
    global $post;
    // return '>> -- >> ' . $post->ID;
    if( post_password_required() ) return $content;
    if( get_post_type() != MODERNI_FORM_CPT_NAME || !is_main_query() ) return $content;
    return $content.do_shortcode("[moderni-form-project-view id={$post->ID}]");
}
add_filter( 'the_content', 'moderni_form_frontend');
/**
 * ////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */

// add_filter( "theme_post_templates", "moderni_custom_template" );
// add_filter( "theme_page_templates", "moderni_custom_template" );
function moderni_custom_template( $templates ) {
    $template_path = MODERNI_FORM_PLUGIN_DIRNAME . '/template-parts/' . MODERNI_FORM_CPT_NAME . '-template.php';

    $templates = array_merge( $templates, array( $template_path     => __( "Project Archive Template" ) ));
    return $templates;
}


//Add our custom template to the admin's templates dropdown
add_filter( 'theme_page_templates', 'pluginname_template_as_option', 10, 3 );
add_filter( 'theme_post_templates', 'pluginname_template_as_option', 10, 3 );
add_filter( 'theme_' . MODERNI_FORM_CPT_NAME . '_templates', 'pluginname_template_as_option', 10, 3 );
function pluginname_template_as_option( $templates, $theme, $post ){

    $templates['template-parts/' . MODERNI_FORM_CPT_NAME . '-template.php'] = __( "Project Archive Template" );

    return $templates;

}

//When our custom template has been chosen then display it for the page
add_filter( 'template_include', 'pluginname_load_template', 99 );
function pluginname_load_template( $template ) {

    global $post;
    $custom_template_slug   = 'template-parts/' . MODERNI_FORM_CPT_NAME . '-template.php';
    $page_template_slug     = get_page_template_slug( $post->ID );

    if( $page_template_slug == $custom_template_slug ){
        // return plugin_dir_path( __FILE__ ) . $custom_template_slug;
        $file_template = MODERNI_FORM_PLUGIN_DIRNAME . '/template-parts/' . MODERNI_FORM_CPT_NAME . '-template.php';
        if( file_exists( $file_template ) ) return $file_template;
        else return $template;
    }

    return $template;

}

function moderni_form_project_insertion_notification( $project_id, $attachment_id ) {
	
	$option_subject = @get_option('moderni_form_mail_subject') ? get_option('moderni_form_mail_subject') : __('New project') . '[#' . $project_id . ']' . __(' has been inserted!');
	$option_body = @get_option('moderni_form_mail_body') ? get_option('moderni_form_mail_body') : __('New Project ID') . ' ' . $project_id . __(' and its video attachment ID is') . ' ' . $attachment_id . '.';
	
    $option_from = get_option( 'admin_email' );
	$site_name = get_bloginfo("name");
	
	/* ************************* */
	$to = $option_from;
	
	$subject = str_replace( '{project_id}', $project_id, $option_subject);
	$subject = str_replace( '{attachment_id}', $attachment_id, $subject);
	
	
	$body = str_replace( '{project_id}', $project_id, $option_body);
	$body = str_replace( '{attachment_id}', $attachment_id, $body);
	
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . $site_name . ' <' . $option_from . '>',
		'Reply-To: ' . $site_name . ' <' . $option_from . '>',
	);

	wp_mail( $to, $subject, $body, $headers );
	
}