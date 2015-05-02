<?php
/*
Custom Post Type: All Posts in loop with Sortcode  
Description: page will allow to show all the post items
Version: 1.3
Author: Kasun Peiris 
Author URI: http://kasunpeiris.com/
License: GPLv2
Notes: Please refere http://codex.wordpress.org/ for more information about the wordpress functions and how to use them. 
Thanks: Tristan
 
 ****Include this file in the theam functions file****
   
1. adding a shortcode so we can display the results on the front end.
2. query the database on the post type
3. loop the database query in a foreach loop and add the post meta data to the markup
 */
add_shortcode('custom_listing_view', 'custom_listing_view');
function custom_listing_view() {
	$query_params = array( 'post_type' => 'listing', 'post_status' => 'publish', 'posts_per_page' => 10 );
	// Execution of post query
	$the_query = new WP_Query;
	$the_query->query( $query_params );
	
	//loop to fetch all the posts
	foreach ($the_query->posts as $post) {
				
				$id = $post->ID;
				$url = $post->guid;
				$title = $post->post_title;
				$userdata = get_userdata($post->post_author);
				$author = $userdata->data->display_name;
				$date = $post->post_date;
				$date = date('F j, Y', strtotime(substr($date, 0, 10)));
				$excerpt = $post->post_excerpt;
				$post_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				if (!isset($post_image) || !$post_image || $post_image == "") {
					$post_image = 'http://placehold.it/350x250';
				}
				$post_meta = get_post_meta($id);
				
				
	?>
		
	<div class="col span_12" style="border-top:1px solid #ccc;padding:20px;">
		<div class="vc_span8 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper job">
						<h2 class="lato-thick"><a href="<?php echo $url;?>"><?php echo $title; ?> </a></h2>
						<p><?php echo $post_meta['job_excerpt'][0]; ?></p>
					</div> 
				</div> 
			</div> 
		</div> 
	 
		<div class="vc_span4 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<p style="text-align: right;" class="date-status">
							<strong><?php echo $date; ?> | <?php echo $post_meta['job_status'][0]; ?></strong>
						</p>
						<p class="button"><a class="nectar-button medium regular-button" href="<?php echo $url;?>" data-color-override="#112551" data-hover-color-override="false" data-hover-text-color-override="#fff" style="visibility: visible; background-color: rgb(17, 37, 81);"><span>View Job Posting</span> </a>
						</p>
	
					</div> 
				</div> 
			</div> 
		</div> 
	</div>
	</div>
<?php
	}//ending loop
	}//ending function

?>