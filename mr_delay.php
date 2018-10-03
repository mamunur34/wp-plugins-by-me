<?php
/*
Plugin Name: Mr Delay
Plugin URI:  
Description: This is custom plugin, tailored for CadCam quote button show
Version: 0.1.0
Author: Md Mamunur Rasid 
Author URI: https://www.upwork.com/o/profiles/users/_~018526cb97aef21e26/
Text Domain: mr_delay 
*/

add_action( 'wp_ajax_my_action', 'my_action' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action' );

add_action( 'wp_ajax_my_action', 'my_action' );

function my_action() {
	global $wpdb; // this is how you get access to the database

	$whatever = intval( $_POST['whatever'] );

	$whatever += 10;

        //echo $whatever;
		echo do_shortcode('[popup_anything id="18619"]');

	wp_die(); // this is required to terminate immediately and return a proper response
}

//add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here
add_action( 'wp_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
			var data = {
				'action': 'my_action',
				'whatever': 1234
				};

 
			jQuery( "#mr_fixed_btn" ).click(function() {
				  //alert( "Handler for .click() called." );
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						//alert('Got this from the server: ' + response);
						console.log(response);
						jQuery( "#mr_fixed_btn").html(response);
						
					});
				});


		 
	});
	</script> <?php
}