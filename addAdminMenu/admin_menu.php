<?php
/*
  Plugin Name: Add menu to admin panel
  Plugin URI: http://code.tutsplus.com
  Description: This is a domo for how to add extra menu options to the admin panel's menu structure.
  Version: 1.0
  Author:  My Demo
  Author URI: http://tech4sky.com
 */
class Custom_menu {
	public function __construct() {
		add_action('admin_menu',array($this,'add_admin_menu'));
	}
	public function add_admin_menu() {
		   add_menu_page( 'Create top level menu', 'My Menu', 'manage_options', 'top_level_menu', array($this,'menu_function'), MY_TEMPLATE_URL .'/images/add_button_red.png', '6.5' );
	}
	public function menu_function() {
		echo '<h2>Top Level Menu</h2>';
	}
}

$testing = new Custom_menu;