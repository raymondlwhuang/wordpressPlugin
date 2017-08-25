<?php
/*
  Plugin Name: Add post column
  Plugin URI: http://code.tutsplus.com
  Description: Demo of adding new column to the post display
  Version: 1.0
  Author:  My Demo
  Author URI: http://tech4sky.com
 */

class Add_post_column {
	public function __construct () {
		add_filter('manage_posts_columns',array($this,'set_column_name'));
		add_action('manage_posts_custom_column',array($this,'render_column'));
	}
	public function set_column_name($default) {
		$default['feature_image'] = 'Feature Image';
		return $default;
	}
	public function render_column($column_name,$post_id) {
		if($column_name=='feature_image') {
			$post_featured_image = MY_TEMPLATE_URL . '/images/placeholder.png';
			$thumbnail_id = get_post_thumbnail_id($post_id);
			$post_thumbnail_img = wp_get_attachment_image_src($thumbnail_id);
			$post_featured_image = $post_thumbnail_img[0] ? $post_thumbnail_img[0] : $post_featured_image;
			echo '<img src="' . $post_featured_image . '"  width="55"  height="55" />';
		}
	}
}

$add_post_column = new Add_post_column;