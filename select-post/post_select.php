<?php
/*
  Plugin Name: Post Selection
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: My Demo
  Author URI: http://tech4sky.com
 */
class post_select {
	public function __construct() {
		add_shortcode( 'recent-posts', array($this,'recent_posts_function') );
	}

	function recent_posts_function() {
	   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => 1));
	   if (have_posts()) :
		  while (have_posts()) :
		     the_post();
			 $return_string = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
		  endwhile;
	   endif;
	   wp_reset_query();
	   echo $return_string;
	}

}
$post_select = new post_select(); 
// The callback function that will replace [book]

