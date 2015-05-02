<!--
Custom Post Type: Single Item Listing Page  
Description: page will allow to show single items in your post type.
Version: 1.3
Author: Kasun Peiris 
Author URI: http://kasunpeiris.com/
License: GPLv2
Notes: Please refere http://codex.wordpress.org/ for more information about the wordpress functions and how to use them.
Thanks: Tristan
***Add This File in to your theam directory***
-->
<?php get_header(); // get the template header?>

<?php  
//getting the post meta data to fill the information on the page (custom post type are saving all the informaiton in the meta data.)
$post_meta = get_post_meta($post->ID);
//get the post details 
$post = get_post();

?>
<!--
	you can change this mark up according to your use of the post type. 
	1. meta data comes with an array in this instance we have save our meta data in $post_meta variable
	2. you can use print_r for see all the meta data saved on your single post.
	3. to echo out the meta data use $post_meta['saved_meta_data_name_in_post'][0];
	 -->	
<div id="jobrow"class="row" class="paddingTB-10">
	<div class="breadcrumbs">
		<!-- Breadcrumb NavXT 5.1.1 -->
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Go to Barrie Area Physician Recruitment." href="http://baphysician.dev.tygershark.com/" class="home">Home</a>
		</span> &gt; 
		<span typeof="v:Breadcrumb"><span property="v:title"><a href="/physician-opportunities/specialty-job-postings/">specialty job postings</a></span></span>
		&gt; 
		<span typeof="v:Breadcrumb"><span property="v:title">job details</span></span>			
	</div>
							
	<div class="wpb_row vc_row-fluid standard_section" style="padding-top: 0px; padding-bottom: 0px; ">
		<div class="col span_12 dark left">
			<div class="vc_span12 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element  paddingLR-5">
						<div class="wpb_wrapper">
							<h1 class="pageHead large"><span >Job Details</span><br>
							<span class="pageHead-thick"><?php the_title(); //get the tittle of the post?></span></h1>
						</div> 
					</div> 
					
				</div> 
			</div> 
		</div>
	</div>
<div class="wpb_row vc_row-fluid standard_section  paddingLR-5  " style="padding-top: 0px; padding-bottom: 0px; "><div class="col span_12 dark left">
	<div class="vc_span8 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
		<div class="wpb_wrapper">		
			<div class="wpb_text_column wpb_content_element  paddingL-5">
				<div class="wpb_wrapper">
					<h2 class="pageHead">Job Description</h2>
						<p><?php echo $post_meta['job_discription'][0]; ?></p>
					<h2 class="pageHead">Position Summary</h2>
						<p><?php echo $post_meta['job_position_summary'][0]; ?></p>
				</div> 
			</div> 
		</div> 
	</div> 
	<div class="vc_span4 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
		<div class="wpb_wrapper">
			<div class="wpb_text_column wpb_content_element ">
				<div class="wpb_wrapper">
					<section id="job-more-details">
						<p>Posting Date: <span><?php echo get_the_date(); ?></span></p>
						<p>Job Category: <span><?php echo $post_meta['job_catogery'][0]; ?></span></p>
						<p>Job Type: <span><?php echo $post_meta['job_type'][0]; ?></span></p>
						<p>Duration: <span><?php echo $post_meta['job_duration'][0]; ?></span></p>
						<p>Salary/Rate: <span><?php echo $post_meta['job_salary'][0]; ?></span></p>
						<p>OpenNumber of Positions: <span><?php echo $post_meta['number_of_positions'][0]; ?></span></p>
						<p>Start Date: <span><?php echo $post_meta['job_start_date'][0]; ?></span></p>
						<p style="display: none !important; overflow: hidden;" class="button">
							<a class="nectar-button medium regular-button eModal-2" style="visibility: visible; background-color: rgb(17, 37, 81);" href="#" data-color-override="#112551" data-hover-color-override="false" data-hover-text-color-override="#fff">Apply Now </a>
						</p>
						<p class="button">
							<a class="nectar-button medium regular-button open_modal_now" style="visibility: visible; background-color: rgb(17, 37, 81);" href="#" data-color-override="#112551" data-hover-color-override="false" data-hover-text-color-override="#fff">Apply Now </a>
						</p>
					</section>
					
				</div> 
			</div> 
		<div class="wpb_text_column wpb_content_element ">
			<div class="wpb_wrapper">
				
			</div> 
		</div> 
		</div> 
	</div> 
	</div>
</div>	
</div>

<?php get_footer();// get the template footer?>