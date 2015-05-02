<?php
/*
Custom Post Type: Custom post type base.  
Description: this script allow you to add custom post type details from the WP backend 
Version: 1.0
Author: Kasun Peiris 
Author URI: http://kasunpeiris.com/
License: GPLv2
Notes: Please refere http://codex.wordpress.org/ for more information about the wordpress functions and how to use them. 
Thanks: Tristan
 
****Include this file in the theam functions file****
 1. register the custom post type.
 2. register the custom post type taxonom.
 3. initiation of meta boxes
 4. function for display all the input fields in the backend.
 5. Validate all the inputs and save in the post type  
 
*/

//add a action hook for the init 
add_action( 'init', 'banner_ads_form_submissions' );
// function for the action hook
function banner_ads_form_submissions() {
  register_post_type( 'banner_ads',
    array(
      'labels' => array(
      'name' => 'Banner Ads',
      'singular_name' => 'Banner Ad',
      'add_new' => 'Add New Banner',
      'add_new_item' => 'Add New Banner Ads',
      'edit' => 'Edit',
      'edit_item' => 'Edit Banner Ad',
      'new_item' => 'New Banner Ad',
      'view' => 'View',
      'view_item' => 'View Banner Ads',
      'search_items' => 'Search Banner Ads',
      'not_found' => 'No Banner Ads found',
      'not_found_in_trash' =>
      'No Banner Ads found in Trash',
      'parent' => 'Parent Banner Ad'
    ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'thumbnail' ),
      'taxonomies' => array('banner_category'),
      //'menu_icon' => plugins_url( 'assets/images/galleryicon.png', __FILE__ ),
      'has_archive' => true
    )
  );
  register_taxonomy(
    'banner_category', // taxonomy name
    'banner_ads', // post type
    array(
      'labels' => array(
        'name' => 'Banner Category',
        'add_new_item' => 'Add New Banner Category',
        'new_item_name' => "New Banner Category Name"
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true
    )
  );
  flush_rewrite_rules();
}

//add action hook for the admin init to display meta boxes in the backend 
add_action( 'admin_init', 'banner_ad_meta_box_init' );
//funciton to add meta boxes
function banner_ad_meta_box_init() {
  add_meta_box(
    'banner_ad_meta_box',
    'Banner Details',
    'banner_ad_meta_box_display',
    'banner_ads', 'normal', 'high' 
  );
}
//function to show meta boxes in the admin panel
function banner_ad_meta_box_display( $banner_add ) {
	//storing all the inserted value in variables
  $banner_title = esc_html( get_post_meta( $banner_add->ID, 'banner_title', true ) );
  $banner_url = esc_html( get_post_meta( $banner_add->ID, 'banner_url', true ) );
  $banner_size = esc_html( get_post_meta( $banner_add->ID, 'banner_size', true ) );
  $approved = esc_html( get_post_meta( $banner_add->ID, 'approved', true ) );
  ?>
  <table>
  	<tr>
      <td style="width: 150px">Banner Title</td>
      <td>
      <input type="text" size="80" name="field_banner_title" value="<?php echo $banner_title; ?>" />  
      </td>
    </tr>
  	
    <tr>
      <td style="width: 150px">URL</td>
      <td>
      <input type="text" size="80" name="field_banner_url" value="<?php echo $banner_url; ?>" />  
      </td>
    </tr>
    <tr>
    	
    </tr>
    
    <tr>
      <td style="width: 150px">Banner Size</td>
      <td>
      	<input type="radio" name="radio_banner_size" value="1" <?php if($banner_size=="1") echo "checked=1"; ?>/> 468 X 60  <br>
      	<input type="radio" name="radio_banner_size" value="2" <?php if($banner_size=="2") echo "checked=1"; ?>/> 250 X 250  <br>
      	<input type="radio" name="radio_banner_size" value="3" <?php if($banner_size=="3") echo "checked=1"; ?> /> 728 X 90   <br>
      </td>
    </tr>
    <tr>
      <td style="width: 150px">Approve</td>
      <td>
      	<input type="radio" name="approval" value="1" <?php if($approved=="1") echo "checked=1"; ?>/> yes  <br>
      	<input type="radio" name="approval" value="2" <?php if($approved=="2") echo "checked=1"; ?> /> no   <br>
      </td>
    </tr>
  </table>
  <?php  
}
 // action hook to save the inserted values in the database     
add_action( 'save_post', 'banner_ad_meta_box_save', 10, 2 );
//function for the action hook
function banner_ad_meta_box_save( $banner_add_id, $banner_add ) {
//sanatize the user input data and update the post meta data on the custom post type
  if ( $banner_add->post_type == 'banner_ads' ) {
    if ( isset( $_POST['field_banner_title'] ) &&
      $_POST['field_banner_title'] != '' ) {
      update_post_meta( $banner_add_id, 'banner_title',
      $_POST['field_banner_title'] );
    }
  }
  
  if ( $banner_add->post_type == 'banner_ads' ) {
   
    if ( isset( $_POST['field_banner_url'] ) &&
      $_POST['field_banner_url'] != '' ) {
      update_post_meta( $banner_add_id, 'banner_url',
      $_POST['field_banner_url'] );
    }
  }
  if ( $banner_add->post_type == 'banner_ads' ) {
    
    if ( isset( $_POST['radio_banner_size'] ) &&
      $_POST['radio_banner_size'] != '' ) {
      update_post_meta( $banner_add_id, 'banner_size',
      $_POST['radio_banner_size'] );
    }
  }
   if ( $banner_add->post_type == 'banner_ads' ) {
    
    if ( isset( $_POST['approval'] ) &&
      $_POST['approval'] != '' ) {
      update_post_meta( $banner_add_id, 'approved',
      $_POST['approval'] );
    }
  }
  
}


?>