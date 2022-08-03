<?php
/**
 * Fired during plugin handling AJAX actions
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 */

/**
 * Fired during plugin handling AJAX actions.
 *
 * This class defines all code necessary to run during the plugin's AJAX activities.
 *
 * @since      1.0.0
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Ajax_Handler {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public function init() {

        add_action( "wp_ajax_nopriv_mvf_project_uploader", array( $this, "mvf_project_uploader" ) );
        add_action( "wp_ajax_mvf_project_uploader", array( $this, "mvf_project_uploader" ) );

        add_action( "wp_ajax_nopriv_mvf_project_gallery_uploader", array( $this, "mvf_project_gallery_uploader" ) );
        add_action( "wp_ajax_mvf_project_gallery_uploader", array( $this, "mvf_project_gallery_uploader" ) );

        add_action( "wp_ajax_nopriv_mvf_project_video_uploader", array( $this, "mvf_project_video_uploader" ) );
        add_action( "wp_ajax_mvf_project_video_uploader", array( $this, "mvf_project_video_uploader" ) );

	}

    public function mvf_project_gallery_uploader() {

        $project_id = $_POST['project_id'] ?: round(microtime(true));
        $attachment_ids = array();
    
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
    
        $files = $_FILES["files"];

        if($files) {

            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $file = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    );
                    $_FILES = array("upload_file" => $file);
                    $attachment_id = media_handle_upload("upload_file", 0);
        
                    if (is_wp_error($attachment_id)) {
                        // There was an error uploading the image.
                        echo "Error adding file";
                    } else {
                        $attachment_ids[] = $attachment_id;
                    }
                }
            }
            $value = implode(',',$attachment_ids);
            update_post_meta( $project_id, '_mvf_project_gallery', $value );
          
            if( $project_id ) Moderni_Form_Notifications::notify_admin( $project_id, get_current_user_id() );
			
			echo $value ? __("Gallery Image ID(s)") . ': ' . $value : 0;
            die();
            
        }
        
        echo __("No images are found to upload");
        die();

    }



    public function mvf_project_video_uploader() {

        $project_id = $_POST['project_id'] ?: round(microtime(true));
    
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        // echo $_FILES["upload"]["name"];
        $uploadedfile = $_FILES['file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    
        // echo $movefile['url'];
        if ($movefile && !isset($movefile['error'])) {
            $video_url = $movefile["url"];
            $upload_dir = wp_upload_dir();
            $video_data = file_get_contents($video_url);
            $filename = basename($video_url);
            if(wp_mkdir_p($upload_dir['path']))
                $file = $upload_dir['path'] . '/' . $filename;
            else
                $file = $upload_dir['basedir'] . '/' . $filename;
            file_put_contents($file, $video_data);
    
            $wp_filetype = wp_check_filetype($filename, null );
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            if( $project_id ) {
    
                $attach_id = wp_insert_attachment( $attachment, $file, $project_id);
                
                if( $attach_id &&  ! is_wp_error( $attach_id ) ) {
    
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
    
                    $media_link = wp_get_attachment_url( $attach_id ); // get_the_permalink( $attach_id );
                    update_post_meta( $project_id, '_mvf_project_vid_url',  $media_link );
    
                }
                echo $attach_id;
            }
        } else {
            /**
             * Error generated by _wp_handle_upload()
            * @see _wp_handle_upload() in wp-admin/includes/file.php
            */
            echo $movefile['error'];
        }
        die();
    }

    public function mvf_project_uploader() {
        $title          = $_POST['mvf_title'] ?: '';
        $type           = $_POST['mvf_type'] ?: '';
        $detail         = $_POST['mvf_detail'] ?: '';
        $street         = $_POST['mvf_street'] ?: '';
        $street2        = $_POST['mvf_street2'] ?: '';
        $city           = $_POST['mvf_city'] ?: '';
        $state          = $_POST['mvf_state'] ?: '';
        $zip_code       = $_POST['mvf_zip_code'] ?: '';
        $name           = $_POST['mvf_name'] ?: '';
        $email          = $_POST['mvf_email'] ?: '';
        $telephone      = $_POST['mvf_telephone'] ?: '';
    
        $args = array(
          'post_type'       => MODERNI_FORM_CPT_NAME,
          'post_title'      => wp_strip_all_tags( $title ),
          'post_content'    => $detail,
          'post_status'     => 'publish',
          'post_author'     => get_current_user_id(),
          'meta_input'      => array(
              '_mvf_property_detail' => array(
                  'street'		    => wp_strip_all_tags( $street ),
                  'street2'		    => wp_strip_all_tags( $street2 ),
                  'city'			=> wp_strip_all_tags( $city ),
                  'state'			=> wp_strip_all_tags( $state ),
                  'zip_code'		=> wp_strip_all_tags( $zip_code ),
                  'name'		    => wp_strip_all_tags( $name ),
                  'email'		    => wp_strip_all_tags( $email ),
                  'telephone'		=> wp_strip_all_tags( $telephone ),
              ),
          ),
        );
    
        $project_id = wp_insert_post( $args );
    
        if( ! is_wp_error( $project_id ) ) {
    
            if( $type ) {
                $type_id = esc_html( $type );
                wp_set_post_terms( $project_id, array( (int) $type_id ), MODERNI_FORM_CT_NAME, false );
            }

            //if( $project_id ) Moderni_Form_Notifications::notify_admin( $project_id, get_current_user_id() );

            echo $project_id;
            die();
        }
        echo 0;
        die();
    }

}

$instance = new Moderni_Form_Ajax_Handler();
$instance->init();