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
    }

	/*
    *	ShortCode
    *	[moderni-video-upload]
    */
	public function moderni_video_upload_shortcode( $attr=array(), $content=null, $shortcode_name='moderni-video-upload' ) {
		ob_start();
		?>
			<form method ="post" action="" name="upload_project_video" id="mvf_project_submit_form"  enctype="multipart/form-data" style="display: flex;flex-direction: column;gap: 1rem;">
				<label for="mvf_title">Your Project Name/Title:</label>
				<input type="text" value="" name="mvf_title" id="mvf_title" class="" required />

				<label for="mvf_type">Your project_type:</label>
				<input type="text" value="" name="mvf_type" id="mvf_type" class="" required />
				
				<label for="mvf_street">Street Name:</label>
				<input type="text" value="" name="mvf_street" id="mvf_street" class="" required />
				
				<label for="mvf_street2">Street Name - 2:</label>
				<input type="text" value="" name="mvf_street2" id="mvf_street2" class="" required />
				
				<label for="mvf_city">Your City:</label>
				<input type="text" value="" name="mvf_city" id="mvf_city" class="" required />
				
				<label for="mvf_state">Your State:</label>
				<input type="text" value="" name="mvf_state" id="mvf_state" class="" required />
				
				<label for="mvf_zip_code">Your Zip Code:</label>
				<input type="text" value="" name="mvf_zip_code" id="mvf_zip_code" class="" required />
				
				<label for="mvf_video">Your Video Files</label>
				<input type="file" value="" accept="video/*" name="video_content" id="mvf_video" class="" required multiple="multiple" camera />

				<?php //wp_nonce_field( plugin_basename( __FILE__ ), 'mvf_project_video_nonce' ); ?>

				<input name="security" value="<?php echo wp_create_nonce("uploadingFile"); ?>" type="hidden">
	

				<label for="mvf_submit_button"></label>
				<input type="submit" value="Submit" name="upload_project_video" id="mvf_submit_button" class="btn">

				<div id="mvfNotifications"></div>

			</form>
			<script defer>
				jQuery(document).ready(function(){					
					jQuery("#mvf_project_submit_form").on( "submit", event => {
						event.preventDefault();

						var file_data = jQuery('#mvf_video').prop('files')[0];
						var form_data = new FormData();
						form_data.append('file', file_data);
                        form_data.append('action', 'mvf_project_Video_uploader');

						jQuery.ajax({
							beforeSend:(xhr) => {
								xhr.setRequestHeader( 'X-WP-Nonce', jQuery("#mvf_project_video_nonce").val() );
								console.log("__START__");
								jQuery("#mvfNotifications").html('')
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
								'mvf_type': jQuery("#mvf_type").val() ?jQuery("#mvf_type").val() : '',
								'mvf_street': jQuery("#mvf_street").val() ?jQuery("#mvf_street").val() : '',
								'mvf_street2': jQuery("#mvf_street2").val() ?jQuery("#mvf_street2").val() : '',
								'mvf_city': jQuery("#mvf_city").val() ? jQuery("#mvf_city").val() : '',
								'mvf_state': jQuery("#mvf_state").val() ? jQuery("#mvf_state").val() : '',
								'mvf_zip_code': jQuery("#mvf_zip_code").val() ? jQuery("#mvf_zip_code").val() : '',
								'action': 'mvf_project_uploader'
							},
							success: ( result,status,xhr ) => {
								console.log(status, result)
								jQuery("#mvfNotifications").html(`<p style="color:green;">>>&nbsp;<b>${status}!</b>, your project id is - ${result}</p>`);
								if( result ) form_data.append('project_id', result);
								jQuery.ajax({
									url: mvf_scripts.ajaxUrl,
									type:"POST",
									processData: false,
									contentType: false,
									data:  form_data,
									success: function(result,status,xhr) {
										console.log(status, result);
										jQuery("#mvfNotifications").append(`<p style="color:green;">>>&nbsp;<b>${status}!</b>, your video attachment id is - ${result}</p>`);
									},
									error: function(xhr,status,error) {
										console.error(status, error, xhr);
										jQuery('body').find("#mvfLoader").remove();
										jQuery("#mvfNotifications").append(`<p style="color:red;">>>&nbsp;<b>${status}!</b>, ${error} occured while uploading new video clip. ${xhr.responseText}</p>`);
									},
									complete:( xhr, status) => {
										jQuery('body').find("#mvfLoader").remove();
										console.log("_COMPLETED__", status)}
								});
							},
							error: ( xhr,status,error ) => {
								jQuery('body').find("#mvfLoader").remove();
								console.log(status, error, xhr)
								jQuery("#mvfNotifications").append(`<p style="color:red;">>>&nbsp;<b>${status}!</b>, ${error} occured while inserting new project. ${xhr.responseText}</p>`);
							},
							complete: (xhr,status) => {
								// jQuery('body').find("#mvfLoader").remove();
								console.log("__COMPLETE__", status, xhr)
							}
						});
					});
				});
			</script>

		<?php
		return ob_get_clean();
	}

}