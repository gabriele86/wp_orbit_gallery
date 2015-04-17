<?php
/* Plugin Name: Orbit Slider Plugin
 Plugin URI: http://1stwebdesigner.com/
 Description: Slider Component for WordPress using Orbit foundation
 Version: 1.0
 Author: Gabriele Bassi
 Author URI: https://github.com/gabriele86/wp_orbit_gallery
 License: GPLv2 or later
 */

function orbit_slider_activation() {
}

register_activation_hook(__FILE__, 'orbit_slider_activation');

function orbit_slider_deactivation() {
}

register_deactivation_hook(__FILE__, 'orbit_slider_deactivation');

add_action();

add_action('wp_enqueue_scripts', 'orbit_scripts');
function orbit_scripts() {

	wp_register_script('foundation_init', plugins_url('js/foundation.min.js', __FILE__));

	wp_register_script('orbit_core', plugins_url('js/foundation/foundation.orbit.js', __FILE__), array("jquery"));

}



function orbit_styles() {

	wp_register_style('orbit_default', plugins_url('css/foundation.css', __FILE__));

	wp_register_style('orbit_custom', plugins_url('css/custom.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'orbit_styles');

add_action('add_meta_boxes', 'orbit_slider_meta_box');

add_action('admin_menu', 'orbit_settings');

function orbit_settings() {

	add_menu_page('Orbit Slider Settings', 'Orbit Slider Settings', 'administrator', 'orbit_settings', 'orbit_display_settings');

}

function orbit_display_settings() {
	include (dirname(__FILE__) . '/include/options.php');

}

add_shortcode("orbit_slider", "orbit_display_slider");
function orbit_display_slider($attr, $content) {

	$options = get_option('orbit_slider_options');

	extract(shortcode_atts(array('id' => ''), $attr));

	$gallery_images = get_post_meta($id, "_orbit_gallery_images", true);

	$gallery_images = ($gallery_images != '') ? json_decode($gallery_images) : array();

	$plugins_url = plugins_url();

	$html = '
<div class="slideshow-wrapper">
  <div class="preloader"></div>
<div id="slides" data-orbit data-options="
                  pause_on_hover:' . $options['pauseOnHover'] . ';
                  animation_speed:' . $options["animationSpeed"] . ';
                  navigation_arrows:' . $options["directionalNav"] . ';
                  bullets:' . $options["bullets"] . ';
                  timer:' . $options["timer"] . ';
                  slide_number: false;">

';

	foreach ($gallery_images as $gal_img) {

		if ($gal_img != "") {

			$html .= "<img alt='' src='$gal_img'  />";

		}

	}

	$html .= '
 
</div>
</div>
';

	wp_register_script('orbit', plugins_url('js/orbit.js', __FILE__));
	wp_enqueue_script('orbit');

	return $html;

}

add_action('init', 'orbit_register_slider');

function orbit_register_slider() {

	$labels = array('menu_name' => _x('Orbit sliders', 'orbitjs_slider'), );

	$args = array('labels' => $labels, 'hierarchical' => true, 'description' => 'Slideshows', 'supports' => array('title', 'editor'), 'public' => true, 'show_ui' => true, 'show_in_menu' => true, 'show_in_nav_menus' => true, 'publicly_queryable' => true, 'exclude_from_search' => true, 'has_archive' => false, 'query_var' => true, 'can_export' => true, 'rewrite' => true, 'capability_type' => 'post');

	register_post_type('orbitjs_slider', $args);

}

/* Define  */
add_filter('manage_edit-orbitjs_slider_columns', 'orbit_set_custom_edit_slidesjs_slider_columns');
add_action('manage_orbitjs_slider_posts_custom_column', 'orbit_custom_slidesjs_slider_column', 10, 2);

function orbit_set_custom_edit_slidesjs_slider_columns($columns) {
	return $columns + array('slider_shortcode' => __('Shortcode'));
}

function orbit_custom_slidesjs_slider_column($column, $post_id) {

	$slider_meta = get_post_meta($post_id, "_orbit_slider_meta", true);
	$slider_meta = ($slider_meta != '') ? json_decode($slider_meta) : array();

	switch ($column) {
		case 'slider_shortcode' :
			echo "[orbit_slider id='$post_id']";
			break;
	}
}

add_action('add_meta_boxes', 'orbit_slider_meta_box');

function orbit_slider_meta_box() {

	add_meta_box("orbit-slider-images", "Slider Images", 'orbit_view_slider_images_box', "orbitjs_slider", "normal");
}

function orbit_view_slider_images_box() {
	global $post;

	$gallery_images = get_post_meta($post -> ID, "_orbit_gallery_images", true);
	$gallery_images = ($gallery_images != '') ? json_decode($gallery_images) : array();

	// Use nonce for verification
	$html = '<input type="hidden" name="orbit_slider_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

	$html .= '<table class="form-table">';

	$html .= "
          <tr>
            <th style=''><label for='Upload Images'>Image 1</label></th>
            <td><input name='gallery_img[]' id='wdc_slider_upload' type='text' value='" . $gallery_images[0] . "'  /></td>
          </tr>
          <tr>
            <th style=''><label for='Upload Images'>Image 2</label></th>
            <td><input name='gallery_img[]' id='wdc_slider_upload' type='text' value='" . $gallery_images[1] . "' /></td>
          </tr>
          <tr>
            <th style=''><label for='Upload Images'>Image 3</label></th>
            <td><input name='gallery_img[]' id='wdc_slider_upload' type='text'  value='" . $gallery_images[2] . "' /></td>
          </tr>
          <tr>
            <th style=''><label for='Upload Images'>Image 4</label></th>
            <td><input name='gallery_img[]' id='wdc_slider_upload' type='text' value='" . $gallery_images[3] . "' /></td>
          </tr>
          <tr>
            <th style=''><label for='Upload Images'>Image 5</label></th>
            <td><input name='gallery_img[]' id='wdc_slider_upload' type='text' value='" . $gallery_images[4] . "' /></td>
          </tr>          

        </table>";

	echo $html;
}

/* Save Slider Options to database */
add_action('save_post', 'orbit_save_slider_info');

function orbit_save_slider_info($post_id) {

	// verify nonce
	if (!wp_verify_nonce($_POST['orbit_slider_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('orbitjs_slider' == $_POST['post_type'] && current_user_can('edit_post', $post_id)) {

		/* Save Slider Images */
		//echo "<pre>";print_r($_POST['gallery_img']);exit;
		$gallery_images = (isset($_POST['gallery_img']) ? $_POST['gallery_img'] : '');
		$gallery_images = strip_tags(json_encode($gallery_images));
		update_post_meta($post_id, "_orbit_gallery_images", $gallery_images);

	} else {
		return $post_id;
	}
}
