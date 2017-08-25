<?php
/*
  Plugin Name: Demo of how to use $wpdb class to talk to database
  Plugin URI: 
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: My Demo
  Author URI: 
 */
class Talking_to_database {
	public function __construct() {
		add_shortcode('show_post_id',array($this,'short_code_content'));
	}
	public function short_code_content($atts){
		global $wpdb;
		$atts = shortcode_atts( array(
			'post_id' => get_the_ID ()
		), $atts );	
		
		$post_id = $atts['post_id'];
		$results = (array)$wpdb->get_results("SELECT ID FROM wp_posts WHERE ID=$post_id");
		foreach ($results as $result){
			echo "POST ID : " . $result->ID.'</br>';
		}
	}
}
$talking_to_database = new Talking_to_database;

// do use short code in php file other then editor call like this: echo do_shortcode( "[show_post_id post_id=160]" );