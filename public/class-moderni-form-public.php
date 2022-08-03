<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/public
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        
        $this->register();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moderni_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moderni_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/moderni-form-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moderni_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moderni_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/moderni-form-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'mvf_scripts', array(
			"root"		=> esc_url( site_url() ),
			'ajaxUrl'	=> esc_url( admin_url( 'admin-ajax.php' ) ),
			// 'uploadUrl'	=> wp_upload_dir()['url'], // path, url, subdir, baseurl, basedir, error
		) );

	}
    
    public function register() {
    	add_action( "init", array( $this, "initiate_func" ) );
    }
    
    public function initiate_func() {
    	add_shortcode( "moderni-video-upload", array( $this, "moderni_video_upload_shortcode" ) );
    	add_shortcode( "moderni-form-project-view", array( $this, "moderni_form_project_frontend_view_shortcode" ) );
    }

	/*
    *	ShortCode
    *	[moderni-video-upload]
    */
	public function moderni_video_upload_shortcode( $atts=array(), $content=null, $shortcode_name='moderni-video-upload' ) {
		ob_start();
		?>
		<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="https://fontawesome.com/releases/v5.15/css/all.css"/>

		<?php require_once MODERNI_FORM_PLUGIN_DIR_PATH . '/public/partials/moderni-form-public-project-form-2.php'; ?>

		<script defer>
			jQuery(document).ready(function(){					
				jQuery("#mvf_project_submit_form").on( "submit", event => {
					event.preventDefault();
					let product_id=null;
					var file_data = jQuery('#mvf_video').prop('files')[0];
					const form_data = new FormData();
					form_data.append('file', file_data);
					form_data.append('action', 'mvf_project_video_uploader');

					jQuery.ajax({
						beforeSend:(xhr) => {
							xhr.setRequestHeader( 'X-WP-Nonce', jQuery("#mvf_project_video_nonce").val() );
							console.log("__START__");
							jQuery('[for="terms"]').html('');
							jQuery('body').append( `
								<div id="mvfLoader" style="position:fixed;top:0;left:0;bottom:0;right:0;width:100%;height:100%;z-index:999999999;background-color:#ffffff95;">
									<div style="display:flex;justify-content:center;align-items:center;width:100%;height:100%;">
										<img src="<?php echo MODERNI_FORM_PLUGIN_DIR_URL . 'public/images/Infinity.gif'; ?>" width="200" height="200" />
									</div>
								</div>
							` ).fadeIn(500);
						},
						url: mvf_scripts.ajaxUrl,
						type: 'post',
						data: {
							'mvf_title': jQuery("#mvf_title").val() ? jQuery("#mvf_title").val()  : '',
							'mvf_type': jQuery("#mvf_type").val() ? jQuery("#mvf_type").val() : '',
							'mvf_detail': jQuery("#mvf_detail").val() ? jQuery("#mvf_detail").val() : '',
							'mvf_street': jQuery("#mvf_street").val() ? jQuery("#mvf_street").val() : '',
							'mvf_street2': jQuery("#mvf_street2").val() ? jQuery("#mvf_street2").val() : '',
							'mvf_city': jQuery("#mvf_city").val() ? jQuery("#mvf_city").val() : '',
							'mvf_state': jQuery("#mvf_state").val() ? jQuery("#mvf_state").val() : '',
							'mvf_zip_code': jQuery("#mvf_zip_code").val() ? jQuery("#mvf_zip_code").val() : '',
							'mvf_email': jQuery("#mvf_email").val() ? jQuery("#mvf_email").val() : '',
							'mvf_telephone': jQuery("#mvf_telephone").val() ? jQuery("#mvf_telephone").val() : '',
							'action': 'mvf_project_uploader'
						},
						success: ( result,status,xhr ) => {
							console.log(status, result)
							//jQuery('[for="terms"]').html(`<br/><br/><b style="text-transform:capitalize;">${status}!</b>, your project id is - ${result}.`);

							if( result ) {
								product_id = result;
								form_data.append('project_id', product_id);
							}

							jQuery.ajax({
								url: mvf_scripts.ajaxUrl,
								type:"POST",
								processData: false,
								contentType: false,
								data:  form_data,
								success: function(result,status,xhr) {
									console.log(status, result);
									//jQuery('[for="terms"]').append(`<br/><b style="text-transform:capitalize;">${status}!</b>, your video attachment id is - ${result}.`);

								},
								error: function(xhr,status,error) {
									console.error(status, error, xhr);
									jQuery('body').find("#mvfLoader").remove();
									jQuery('[for="terms"]').html(`<br/><p style="color:green;"><b style="text-transform:capitalize;">Congratulations!</b> Your project was successfully submitted.</p><p style="color:red;"><b style="text-transform:capitalize;">${status}!</b>, ${error} occured while uploading new video clip.</p>`); // ${xhr.responseText}
								},
								complete:( xhr, status) => {
									console.log("_COMPLETED__", status)
									
									const file_data_imgs = jQuery('#mvf_gallary_image').prop('files');
									const form_data_imgs = new FormData();
									
									// Read selected files
									for (var index = 0; index < file_data_imgs.length; index++) {
										form_data_imgs.append("files[]", file_data_imgs[index]);
									}
									form_data_imgs.append('project_id', product_id);
									form_data_imgs.append('action', 'mvf_project_gallery_uploader');

									jQuery.ajax({
										url: mvf_scripts.ajaxUrl,
										type:"POST",
										processData: false,
										contentType: false,
										data:  form_data_imgs,
										success: function(result,status,xhr) {
											console.log(status, result);
											jQuery('[for="terms"]').html(`<br/><p style="color:green;"><b style="text-transform:capitalize;">${status}!</b> Congratulations! Your submission was successful.</p>`);
										},
										error: function(xhr,status,error) {
											console.error(status, error, xhr);
											jQuery('body').find("#mvfLoader").remove();
											jQuery('[for="terms"]').html(`<br/><p style="color:green;"><b style="text-transform:capitalize;">Congratulations!</b> Your project detail and video clip were successfully submitted.</p><p style="color:red;"><b style="text-transform:capitalize;">${status}!</b>, ${error} occured while uploading new galley.</p>`); // ${xhr.responseText}
										},
										complete:( xhr, status) => {
											jQuery('body').find("#mvfLoader").remove();
											console.log("_COMPLETED__", status)}
									});
								}
							});
						},
						error: ( xhr,status,error ) => {
							jQuery('body').find("#mvfLoader").remove();
							console.log(status, error, xhr)
							jQuery('[for="terms"]').html(`<br/><p style="color:red;"><b style="text-transform:capitalize;">${status}!</b>, ${error} occured while inserting new project.</p>`); // ${xhr.responseText}
						},
						complete: (xhr,status) => {
							console.log("__COMPLETE__", status, xhr)
						}
					});
				});
			});
		</script>

		<?php
		return ob_get_clean();
	}
	
	/**
	 * [moderni-form-project-view id="$post_id"]
	 */
	public function moderni_form_project_frontend_view_shortcode( $atts=array(), $content=null, $shortcode_name='moderni-form-project-view' ) {
		
		$attributes = shortcode_atts( array(
			'id'	=> $atts['id'] ?: null
		), $atts, $shortcode_name );

		ob_start();
		?>

		<?php //require_once MODERNI_FORM_PLUGIN_DIR_PATH . '/public/partials/moderni-form-public-project-display.php'; ?>
		
		<?php require_once MODERNI_FORM_PLUGIN_DIR_PATH . '/public/partials/moderni-form-project-single-page.php'; ?>


		<?php
		return ob_get_clean();

	}

}