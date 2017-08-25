<?php
/*
  Plugin Name: Add sub menu to admin panel
  Plugin URI: http://driving.ca
  Description: This is a domo for how to add a sub menu to the admin menu.
  Version: 1.0
  Author:  My Demo
  Author URI: http://driving.ca
 */

class drv_my_testing {
    
    public  $hook 		= 'drv_testing_widget_settings';
    private $dependancies 	= array( 'jquery-ui-datepicker', 'jquery-ui-sortable' );
    private $css 		= 'testing-widget-settings.css';
    private $js 		= 'testing-widget-settings.js';
    private $plugin 		= 'testing-widget-settings';
    private $count 		= 0;
	private $options = array();
    
    public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', 					array( $this, 'admin_menu' ) );
    }
    public function admin_init() {
	
		register_setting( $this->hook, $this->hook );

		add_settings_section( $this->hook, NULL, '__return_false', $this->hook );
		add_settings_field( $this->hook . '_blocks', __( '', $this->hook ), array( $this, $this->hook . '_blocks' ), $this->hook, $this->hook );

    }
	public function drv_testing_widget_settings_blocks($arg) {
	echo '<p>id: ' . $arg['id'] . '</p>';             // id: eg_setting_section
	echo '<p>title: ' . $arg['title'] . '</p>';       // title: Example settings section in reading
	echo '<p>callback: ' . $arg['callback'] . '</p>'; // callback: eg_setting_section_callback_function

	}
	public function admin_menu () {
            add_theme_page( 'Testing Widget Settings', 'Testing Widget Settings', 'edit_theme_options', $this->hook, array( $this, $this->hook . '_render_page' ) );
		
	}
    public function drv_testing_widget_settings_render_page() {
	
		?>
	
		<div class="wrap">
	
			<h2><?php echo get_admin_page_title(); ?>
			<?php if ( isset( $_GET [ 'default' ] ) || isset( $_GET [ 'new' ] ) ) { ?> 
			
				<a href="<?php echo menu_page_url($this->hook, FALSE); ?>" class="add-new-h2"> 
					<?php echo esc_html( 'Show all' ); ?>
				</a>
			
			<?php } else if ( ! isset( $_GET [ 'new' ] ) ) { ?> 
			
				<a href="<?php echo menu_page_url($this->hook, FALSE).'&amp;new'; ?>" class="add-new-h2"> 
					<?php echo esc_html( 'Add new' ); ?>
				</a> 
			
			<?php } ?>
			</h2>
		
			<?php settings_errors(); ?>

			<form method="post" id="testing_widget_form" name="testing_widget_form" action="options.php">
	
				<div class="testing-widget-settings">
					<?php
						wp_nonce_field( $this->hook, $this->hook.'_nonce' );
	 
						settings_fields( $this->hook );
		
						do_settings_sections( $this->hook );
			
					?>
				</div>
	
			</form>
		
		</div>
	
		<?php
    }	
}
$drv_my_testing = new drv_my_testing;