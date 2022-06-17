<?php

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


// add_action( "init", "mvf_ajax_calls" );

// function mvf_ajax_calls() {
//     add_action( "wp_ajax_nopriv_mvf_project_uploader", "mvf_project_uploader" );
//     add_action( "wp_ajax_mvf_project_uploader", "mvf_project_uploader" );

//     add_action( "wp_ajax_nopriv_mvf_project_Video_uploader", "mvf_project_Video_uploader" );
//     add_action( "wp_ajax_mvf_project_Video_uploader", "mvf_project_Video_uploader" );
// }

// function mvf_project_uploader() {
//     $title = $_POST['mvf_title'] ?: '';
//     $type = $_POST['mvf_type'] ?: '';
//     $street = $_POST['mvf_street'] ?: '';
//     $street2 = $_POST['mvf_street2'] ?: '';
//     $city = $_POST['mvf_city'] ?: '';
//     $state = $_POST['mvf_state'] ?: '';
//     $zip_code = $_POST['mvf_zip_code'] ?: '';

//     $args = array(
//       'post_type'       => MODERNI_FORM_CPT_NAME,
//       'post_title'      => wp_strip_all_tags( $title ),
//       'post_content'    => '',
//       'post_status'     => 'publish',
//       'post_author'     => get_current_user_id(),
//       'meta_input'      => array(
//           '_mvf_property_detail' => array(
//               'street'		    => wp_strip_all_tags( $street ),
//               'street2'		    => wp_strip_all_tags( $street2 ),
//               'city'			=> wp_strip_all_tags( $city ),
//               'state'			=> wp_strip_all_tags( $state ),
//               'zip_code'		=> wp_strip_all_tags( $zip_code ),
//           ),
//       ),
//     );

//     $project_id = wp_insert_post( $args );

//     if( ! is_wp_error( $project_id ) ) {

//         if( $type ) {
//             $type = esc_html( $type );
//             $type_slug = str_replace( ' ', '-', strtolower( $type ) );
//             $project_type = term_exists( $type, MODERNI_FORM_CT_NAME );
//             if ( ! $project_type ) {
//                 $project_type = wp_insert_term( $type, MODERNI_FORM_CT_NAME, array( 'slug' => $type_slug ) );
//             }                     
//             // It works fine, does not create a new term, and simply attaches the existing ID
//             wp_set_post_terms( $project_id, array( (int) $project_type['term_id'] ), MODERNI_FORM_CT_NAME, false );
//         }
//         // wp_send_json_success( array( 'project_id'   =>  $project_id ), 200 );
//         echo $project_id;
//         die();
//     }
//     echo 0;
//     die();
// }

// function mvf_project_Video_uploader() {


//     $project_id = $_POST['project_id'] ?: round(microtime(true));

//     if (!function_exists('wp_handle_upload')) {
//         require_once(ABSPATH . 'wp-admin/includes/file.php');
//     }
//     // echo $_FILES["upload"]["name"];
//     $uploadedfile = $_FILES['file'];
//     $upload_overrides = array('test_form' => false);
//     $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

//     // echo $movefile['url'];
//     if ($movefile && !isset($movefile['error'])) {
//         $video_url = $movefile["url"];
//         $upload_dir = wp_upload_dir();
//         $video_data = file_get_contents($video_url);
//         $filename = basename($video_url);
//         if(wp_mkdir_p($upload_dir['path']))
//             $file = $upload_dir['path'] . '/' . $filename;
//         else
//             $file = $upload_dir['basedir'] . '/' . $filename;
//         file_put_contents($file, $video_data);

//         $wp_filetype = wp_check_filetype($filename, null );
//         $attachment = array(
//             'post_mime_type' => $wp_filetype['type'],
//             'post_title' => sanitize_file_name($filename),
//             'post_content' => '',
//             'post_status' => 'inherit'
//         );
//         if( $project_id ) {

//             $attach_id = wp_insert_attachment( $attachment, $file, $project_id);
            
//             if( $attach_id &&  ! is_wp_error( $attach_id ) ) {

//                 $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
//                 wp_update_attachment_metadata( $attach_id, $attach_data );

//                 update_post_meta( $project_id, '_mvf_project_vid_url',  esc_url( get_the_permalink( $attach_id ) ) );
//                 // $vid_url_data = array( "vid_url" => esc_url( get_the_permalink( $attach_id ) ) );
//                 // update_post_meta( $project_id, '_mvf_property_detail', $vid_url_data  );

//             }
//             // wp_send_json_success( array( 'vid_id'   =>  $attach_id ), 200 );
//             echo $attach_id;
//         }
//     } else {
//         /**
//          * Error generated by _wp_handle_upload()
//         * @see _wp_handle_upload() in wp-admin/includes/file.php
//         */
//         echo $movefile['error'];
//     }
//     die();
// }