<?php


add_filter('upload_mimes', 'banner_upload_mimes');
function banner_upload_mimes ($existing_mimes=array()) {
	$existing_mimes['swf'] = 'application/x-shockwave-flash';
	return $existing_mimes;
}


function add_banner_meta_boxes() {
 
    // Define the banner attachment for posts
    add_meta_box(
        'wp_banner_attachment',
        'Flash Banner Attachment',
        'wp_banner_attachment',
        'banners',
        'normal'
    );
    
 
} // end add_banner_meta_boxes
add_action('add_meta_boxes', 'add_banner_meta_boxes');

function wp_banner_attachment() {
 
    wp_nonce_field(plugin_basename(__FILE__), 'wp_banner_attachment_nonce');
     
    $html = '<p class="description">';
        $html .= 'Upload your BANNER here.';
    $html .= '</p>';
    $html .= '<input type="file" id="wp_banner_attachment" name="wp_banner_attachment" value=""  />';
     
    // Grab the array of file information currently associated with the post
    $doc = get_post_meta(get_the_ID(), 'wp_banner_attachment', true);
     
    // Create the input box and set the file's URL as the text element's value
    $html .= '<br/><input type="text" id="wp_banner_attachment_url" name="wp_banner_attachment_url" value=" ' . $doc['url'] . '" size="100" />';
     
    
    echo $html;
 
} // end wp_banner_attachment</p>




function save_banner_meta_data($id) {
 
    /* --- security verification --- */
    if(!wp_verify_nonce($_POST['wp_banner_attachment_nonce'], plugin_basename(__FILE__))) {
      return $id;
    } // end if
       
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $id;
    } // end if
       
    if('page' == $_POST['post_type']) {
      if(!current_user_can('edit_page', $id)) {
        return $id;
      } // end if
    } else {
        if(!current_user_can('edit_page', $id)) {
            return $id;
        } // end if
    } // end if
    /* - end security verification - */
     
    // Make sure the file array isn't empty
    if(!empty($_FILES['wp_banner_attachment']['name'])) {
       
        // Setup the array of supported file types. In this case, it's just PDF.
        //$supported_types = array('application/pdf');
        $supported_types = array('application/x-shockwave-flash');
         
       
        // Get the file type of the upload
        $uploaded_type = $_FILES['wp_banner_attachment']['type'];
       
        
        // Check if the type is supported. If not, throw an error.
        if(in_array($uploaded_type, $supported_types)) {
 
            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['wp_banner_attachment']['name'], null, file_get_contents($_FILES['wp_banner_attachment']['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                add_post_meta($id, 'wp_banner_attachment', $upload);
                update_post_meta($id, 'wp_banner_attachment', $upload);     
            } // end if/else
 
        } else {
            wp_die("The file type that you've uploaded is not Supported.");
        } // end if/else
         
    } // end if
     
} // end save_banner_meta_data
add_action('save_post', 'save_banner_meta_data');

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');