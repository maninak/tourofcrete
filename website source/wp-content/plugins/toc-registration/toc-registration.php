<?php
/*
Plugin Name: Tour of Crete Registration - Mika
Plugin URI: http://tourofcrete.com
Description: Registration Form for Tour of Crete
Author: Octobers
Version: 1.0
Author URI: http://octobers.eu
*/

//SETUP
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
include( plugin_dir_path( __FILE__ ) . '/functions.php');

function toc_registration_plugin_install(){
    //Do some installation work
}
register_activation_hook(__FILE__,'toc_registration_plugin_install'); 



//SCRIPTS
function toc_registration_plugin_scripts(){
    wp_register_script('toc_registration_script',plugin_dir_url( __FILE__ ).'js/toc-scripts.js');
    wp_enqueue_script('toc_registration_script');

	wp_enqueue_style( 'toc_registration_style', plugin_dir_url( __FILE__ ).'css/style.css');
	wp_enqueue_style( 'ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
}

add_action('wp_enqueue_scripts','toc_registration_plugin_scripts'); 

//SHORTCODE THAT DISPLAYS REGISTRATION FORM
add_shortcode("toc-registration-form", "toc_registration_form_handler");


