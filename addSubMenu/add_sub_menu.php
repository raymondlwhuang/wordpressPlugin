<?php
	
class SubMenuSetUp {
	public function __construct() {
		add_action('admin_menu',array($this,'admin_menu'));
	}
	public function admin_menu () {
		add_submenu_page ( 'themes.php', 'Sub menu', 'Sub menu', 'manage_options', 'create_sub_menu', array($this,'sub_menu') );
		//add_theme_page( 'Sub menu', 'Sub menu', 'manage_options', 'create_sub_menu', array($this,'sub_menu') );
	}
	public function sub_menu () {
		echo "<h2>Sub Menu</h2>";
	}
}

$my_submenu = new SubMenuSetUp;	