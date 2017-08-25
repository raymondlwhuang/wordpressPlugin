<?php
/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author:  My Demo
  Author URI: http://tech4sky.com
 */
class registration_plugin {
	public function __construct() {
		add_shortcode( 'cr_custom_registration-posts', array($this,'custom_registration_function') );
	}
	public function custom_registration_function() {
		if ( isset($_POST['submit'] ) ) {
			$this->registration_validation($_POST['username'],$_POST['password'],$_POST['email'],$_POST['website'],$_POST['fname'],$_POST['lname'],$_POST['nickname'],$_POST['bio']);
			 
			// sanitize user form input
			global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
			$username   =   sanitize_user( $_POST['username'] );
			$password   =   esc_attr( $_POST['password'] );
			$email      =   sanitize_email( $_POST['email'] );
			$website    =   esc_url( $_POST['website'] );
			$first_name =   sanitize_text_field( $_POST['fname'] );
			$last_name  =   sanitize_text_field( $_POST['lname'] );
			$nickname   =   sanitize_text_field( $_POST['nickname'] );
			$bio        =   esc_textarea( $_POST['bio'] );
	 
			// call @function complete_registration to create the user
			// only when no WP_error is found
			$this->complete_registration($username,$password,$email,$website,$first_name,$last_name,$nickname,$bio);
		}
	 
		$this->registration_form($username,$password,$email,$website,$first_name,$last_name,$nickname,$bio);
	}
	public function registration_form($username, $password, $email, $website, $first_name, $last_name, $nickname, $bio) {
		echo '<div id="msg"></div>
				<form name="register" class="register" action="'. $_SERVER['REQUEST_URI'] .'" method="post">
					<div>
					<label for="username">Username <strong>*</strong></label>
					<input type="text" name="username" value="' . ( isset( $_POST['username'] ) ? $_POST['username'] : null ) . '">
					</div>
					 
					<div>
					<label for="password">Password <strong>*</strong></label>
					<input type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $_POST['password'] : null ) . '">
					</div>
					 
					<div>
					<label for="email">Email <strong>*</strong></label>
					<input type="text" name="email" value="' . ( isset( $_POST['email'] ) ? $_POST['email'] : null ) . '">
					</div>
					 
					<div>
					<label for="website">Website</label>
					<input type="text" name="website" value="' . ( isset( $_POST['website'] ) ? $_POST['website'] : null ) . '">
					</div>
					 
					<div>
					<label for="firstname">First Name</label>
					<input type="text" name="fname" value="' . ( isset( $_POST['fname'] ) ? $_POST['fname'] : null ) . '">
					</div>
					 
					<div>
					<label for="website">Last Name</label>
					<input type="text" name="lname" value="' . ( isset( $_POST['lname'] ) ? $_POST['lname'] : null ) . '">
					</div>
					 
					<div>
					<label for="nickname">Nickname</label>
					<input type="text" name="nickname" value="' . ( isset( $_POST['nickname'] ) ? $_POST['nickname'] : null ) . '">
					</div>
					 
					<div>
					<label for="bio">About / Bio</label>
					<textarea name="bio" rows="8" cols="60">'.(isset( $_POST['bio'] ) ? $_POST['bio'] : null).'</textarea>
					</div>
					<input type="submit" name="submit" value="Register" />
				</form>
			
			</div>';
	}
	public function registration_validation( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio )  {	
		global $reg_errors;
		$reg_errors = new WP_Error;
		if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
			$reg_errors->add('field', 'Required form field is missing');
		}
		if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
			$reg_errors->add('field', 'Required form field is missing');
		}
		if ( 4 > strlen( $username ) ) {
			$reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
		}
		if ( username_exists( $username ) )
			$reg_errors->add('user_name', 'Sorry, that username already exists!');
		if ( ! validate_username( $username ) ) {
			$reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
		}
		if ( 5 > strlen( $password ) ) {
				$reg_errors->add( 'password', 'Password length must be greater than 5' );
			}
		if ( !is_email( $email ) ) {
			$reg_errors->add( 'email_invalid', 'Email is not valid' );
		}
		if ( email_exists( $email ) ) {
			$reg_errors->add( 'email', 'Email Already in use' );
		}
		if ( ! empty( $website ) ) {
			if ( ! filter_var( $website, FILTER_VALIDATE_URL ) ) {
				$reg_errors->add( 'website', 'Website is not a valid URL' );
			}
		}
		if ( is_wp_error( $reg_errors ) ) {
		 
			foreach ( $reg_errors->get_error_messages() as $error ) {
			 
				echo '<div>';
				echo '<strong>ERROR</strong>:';
				echo $error . '<br/>';
				echo '</div>';
				 
			}
		 
		}	
	}
	public function complete_registration() {
		global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
		if ( 1 > count( $reg_errors->get_error_messages() ) ) {
			$userdata = array(
			'user_login'    =>   $username,
			'user_email'    =>   $email,
			'user_pass'     =>   $password,
			'user_url'      =>   $website,
			'first_name'    =>   $first_name,
			'last_name'     =>   $last_name,
			'nickname'      =>   $nickname,
			'description'   =>   $bio,
			);
			$user = wp_insert_user( $userdata );
			echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';   
		}
	}
}
$myplugin = new registration_plugin();

