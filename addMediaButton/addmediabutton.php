<?php
/*
Plugin Name: Media Button
Plugin URI: http://code.tutsplus.com
Description: Adding a media button to the wordpress content editor
Version: 1.0
Author: My Demo
Author URI: http://tech4sky.com
*/

class Add_media_button {
	public function __construct () {
		add_action('media_buttons',array($this,'add_my_media_button'));
		add_action('admin_enqueue_scripts',array($this,'include_media_button_js_file'));
	}
	public function add_my_media_button () {
		echo "<a href='#' id='insert-my-media' class='button'>Add my media</a>";
	}
	public function include_media_button_js_file () {
		wp_enqueue_script ('media_buttons', MY_PLUGIN_URL . '/addMediaButton/media_button.js');
	}
}
$add_media_button = new Add_media_button;