<?php
/*
Custom Plugn: Plugin Base    
Description: this script allow you to manage a one post type initied by this plugin 
Version: 1.5
Author: Kasun Peiris 
Author URI: http://kasunpeiris.com/
License: GPLv2
Notes: Please refere http://codex.wordpress.org/ for more information about the wordpress functions and how to use them. 
Thanks: Tristan
Special Notes: Please update the top commenting refer to http://codex.wordpress.org/Writing_a_Plugin
 
****Include this file in the theam functions file****
 1. action hooks and shortcodes.
 2. register plugin in the admin menu
 3. register plugin settings page under the WP settings  
 4. function for display all the input fields in the backend.
 5. Form for show in the backend.
 
*/
//global variable for saving the settings.
$form_fields_options= get_option('map_settings');

//add actions to admin menu,andmin init
add_action('admin_menu','intractive_map_actions');
add_action( 'admin_init', 'intractive_map_admin_init' );

//shortcode to show the plugin data in the front end 
add_shortcode('formfields1', 'formfields1');
//function for the shortcode:this can be changed according the way you want to display data from the plugin
function formfields1() {
  	
  $items = array();
  //get the data from the saved array and add in the loop
  $form_fields_options= get_option('map_settings');
  foreach ($form_fields_options as $key => $value) {
    
    if ($value == 1) {
      $src = '/wp-content/uploads/2014/10/open.png';
    } else {
      $src = '/wp-content/uploads/2014/10/closed.png';
    }
    $item = array($key, $src);
    $items[] = $item;
  }
  ?>
   <script>
     jQuery(document).ready(function(){
       <?php
        foreach ($items as $item) {
        ?>
            jQuery(".trail-<?php echo $item[0]; ?>").attr('src', '<?php echo $item[1]; ?>');
        <?php 
        }
       ?>
     });
   </script>
  <?php
}

//function for the admin menu: this will allow to show the plugin setting under settings.
function intractive_map_actions(){
	//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_options_page( 'Intractive Map Options','Intactive Map Options','manage_options',_FILE_,'intractive_map_admin');
	
}
//function for the admin init 
function intractive_map_admin_init(){
	
	add_action( 'admin_post_save_intractive_map_options','process_intractive_map_options' );
}
//action hook for saving the plugin data 
add_action('admin_init','process_intractive_map_options');

//functions for register the settings in the database
function process_intractive_map_options(){
	register_setting('map_settings_group','map_settings');
}

//this function will register under add_option_page
function intractive_map_admin() {
	//global variable to save the field options under map settings
	global $form_fields_options;
	//form for configure plugin settings( action will go in to the options.php)
	?>
	
	<div class="wrap">
	
	<h2>Intractive Map Settings</h2>
	<form method="post" action="options.php">
		<?php 
		settings_fields( 'map_settings_group');
		do_settings_sections( 'map_settings_group' );
		
		// echo "<pre>";
		// print_r($form_fields_options);
		// echo "</pre>";
		 	
		?> 
	
	<h2>Cross Coutry Ski Trail</h2>
<!--map_settings setting an array to save the data( find this under the shortcode)-->
<table>
	<tr><th>Trail Name</th><th>Open</th><th>Close</th></tr>
	
	<tr><td style="width: 150px"><label>Salt Lake City</label></td>
			<td><input type="radio" name="map_settings[SLC]" value="1" <?php  if($form_fields_options['SLC']=="1"){echo "checked=1";}?>></td><td><input type="radio" name="map_settings[SLC]" value="0" <?php  if($form_fields_options['SLC']=="0"){echo "checked=1";}?>> </td></tr>
			
	<tr><td style="width: 150px"><label>Vancouver</label></td>
			<td><input type="radio" name="map_settings[VAN]" value="1" <?php  if($form_fields_options['VAN']=="1"){echo "checked=checked";}?> </td><td><input type="radio" name="map_settings[VAN]" value="0" <?php  if($form_fields_options['VAN']=="0"){echo "checked=1";}?>> </td></tr>
			
	<tr><td style="width: 150px"><label>Seefeld</label></td>
			<td><input type="radio" name="map_settings[SF]" value="1" <?php  if($form_fields_options['SF']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[SF]" value="0" <?php  if($form_fields_options['SF']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr>
		<td style="width: 150px"><label>Torino</label></td>
			<td><input type="radio" name="map_settings[TO]" value="1" <?php  if($form_fields_options['TO']=="1"){echo "checked=checked";}?>>  </td><td><input type="radio" name="map_settings[TO]" value="0" <?php  if($form_fields_options['TO']=="0"){echo "checked=checked";}?>>  </td></tr>
	<tr><td style="width: 150px"><label>Sochi</label></td>
		<td><input type="radio" name="map_settings[SC]" value="1" <?php if($form_fields_options['SC']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[SC]" value="0" <?php if($form_fields_options['SC']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr><td style="width: 150px"><label>Nagano</label></td>
			<td><input type="radio" name="map_settings[NA]" value="1" <?php if($form_fields_options['NA']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[NA]" value="0" <?php if($form_fields_options['NA']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr><td style="width: 150px"><label>Lillehammer</label></td>
		<td><input type="radio" name="map_settings[LI]" value="1" <?php if($form_fields_options['LI']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[LI]" value="0" <?php if($form_fields_options['LI']=="0"){echo "checked=checked";}?>> </td></tr>
</table>
<table>
	<hr>
	<h2>Snow Shoe Trail</h2>
	<tr><th>Trail Name</th><th>Open</th><th>Close</th></tr>
	<tr><td style="width: 150px"><label>Lynx Snowshoe</label></td>
			<td><input type="radio" name="map_settings[LY]" value="1" <?php if($form_fields_options['LY']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[LY]" value="0" <?php if($form_fields_options['LY']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr><td style="width: 150px"><label>Fox Snowshoe</label></td>
			<td><input type="radio" name="map_settings[FX]" value="1"<?php if($form_fields_options['FX']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[FX]" value="0"<?php if($form_fields_options['FX']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr><td style="width: 150px"><label>Lookout Snowshoe</label></td>
			<td><input type="radio" name="map_settings[LO]" value="1" <?php if($form_fields_options['LO']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[LO]" value="0" <?php if($form_fields_options['LO']=="0"){echo "checked=checked";}?>> </td></tr>
	<tr><td style="width: 150px"><label>Beaver Snowshoe</label></td>
			<td><input type="radio" name="map_settings[BE]" value="1" <?php if($form_fields_options['BE']=="1"){echo "checked=checked";}?>> </td><td><input type="radio" name="map_settings[BE]" value="0" <?php if($form_fields_options['BE']=="0"){echo "checked=checked";}?>> </td></tr> 
</table>	
	<?php submit_button();//wp submit button ?>
</form>
</div>
<?php 



}