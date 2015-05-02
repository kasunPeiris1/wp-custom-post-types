<?
/*
Custom Post Type: allow user to insert custom posts.  
Description: this script allow you to add custom post type details from front end  
Version: 1.4
Author: Kasun Peiris
Author URI: http://kasunpeiris.com/
License: GPLv2
Notes: Please refere http://codex.wordpress.org/ for more information about the wordpress functions and how to use them. 
Thanks: Tristan
 
****Include this file in the theam functions file****
 1. create a shortcode
 2. Inserting the post and updating the meta data
 3. Initiation of featured Image
 4. form to display on the fron end
   
 
*/
//adding a sortcode
add_shortcode( 'new_banner_adds', 'new_banner_adds' );

//function for sortcode
function new_banner_adds() {
  //check if the request methord is post
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //initiation of inserting post
    $post_id = wp_insert_post(
      array(
        'comment_status'  => 'closed',
        'ping_status'   => 'closed',
        'post_author'   => 1,
        'post_title'    =>  $_POST['add_title'] ,
        'post_status'   => 'publish',
        'post_type'   => 'banner_ads'
      )
    );
    
    if ($post_id) {
      update_post_meta( $post_id, 'banner_title', $_POST['add_title']);
      update_post_meta( $post_id, 'banner_url', $_POST['url']);
      update_post_meta( $post_id, 'banner_size', $_POST['bannerSize']);
	  
  	  //image upload
  	  
  	  if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
     		 $upload_overrides = array( 'test_form' => false );
     	 	$file = wp_handle_upload( $_FILES['bannerAddImage'], $upload_overrides );
      //
      $attachment = array(
          'post_mime_type' => $file['type'],
          'post_title' => preg_replace('/\.[^.]+$/', '', $file['url']),
          'post_content' => '',
          'post_status' => 'inherit',
      );
     
      $attach_id = wp_insert_attachment( $attachment, $file['url'], $post_id );
      
      // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      
      // Generate the metadata for the attachment, and update the database record.
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file['file'] );
    	echo "<pre>";
    	echo print_r($file);
    	echo "</pre>";
      wp_update_attachment_metadata( $attach_id, $attach_data );
      //updating the thumnail with the post id and the attach Id
      update_post_meta($post_id,'_thumbnail_id',$attach_id);
  
      
      $thumbnail_id=get_post_thumbnail_id( $post_id );
      set_post_thumbnail( $post_id, $thumbnail_id );
      
      if (!empty($_POST['add_Categories'])) {
        wp_set_object_terms($post_id, $_POST['add_Categories'], 'banner_category');
      }
    
    }
    
  }
  
  ?>
 <!--form to display on the front end. make sue you have enctype if we are uploading images-->
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form_item">
      <label for="title">Banner Title / Name</label>
      <input type="text" name="add_title" id="title" />
    </div>
     <div class="form_item">
      <label for="url">URL</label>
      <input type="text" name="url" id="url" />
    </div>
    
    <div class="form_item">
      <label>Banner Sizes :</label><br>
      <input type="radio" name="bannerSize" value="1" id="1R"/>
      <label for="1R">468 X 60 </label><br>
      <input type="radio" name="bannerSize" value="2" id="2R"/>
      <label for="2R">250 X 250</label><br>
      <input type="radio" name="bannerSize" value="3" id="3R"/>
      <label for="3R">728 X 90</label><br>
    </div>
    
    <div class="form_item">
      <label for="">Upload Your Banner Here</label>
      <div class="upload_file_container">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000000000" />
        <input type="file" name="bannerAddImage" id="bannerAddImage"/>
      </div>
    </div>
    
	<label>Select Banner Categories</label>   
    <div class="form_item">

      <?php
      
      //looping the taxonomy catogeries to show in the front end
      $taxonomies = array( 'banner_category', );
      
      $args = array( 'hide_empty' => false );
      $terms = get_terms($taxonomies, $args);
      $i = 0;
      foreach ($terms as $term) {
        echo '<div class="single_box">';
        echo '<input type="checkbox" name="add_Categories['.$i.']" value="'.$term->slug.'" id="'.$term->slug.'"/>';
        echo '<label for="'.$term->slug.'">'.$term->name.'</label>';
        echo '</div>';
        $i++;
      }
      ?>
    </div>
    <div class="form_item">
      <input type="submit" name="submit" value="Submit" />
    </div>
  </form>
  
  <?php
}
