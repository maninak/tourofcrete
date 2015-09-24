<?php
/*
Plugin Name: Tour of Crete Post Types
 
Description: Custom Post Types for the Tour of Crete Website (Venues).
Version: 0.0.1
 
License: A "Slug" license name e.g. GPL2
*/

add_action( 'init', 'create_post_type_venues' );

//CUSTOM POST TYPES

// post type venues
function create_post_type_venues() {
     $args = array(
     		'menu_position' => 10,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
            'rewrite' => array('slug' => _x( 'the-race/venues', 'URL slug', 'wpml_dev' )),
            'supports' => array( 
            		'title','editor','thumbnail','excerpt','revisions'),
            'labels' => array(
            		'name' 					=> __( 'Venues' ),
            		'singular_name' 		=> __( 'venues' )),
            		'add_new'				=> 'Add new Venue',
            		'add_new_item'			=> 'Add new Venue',
            		'edit_item' 			=> 'Edit Venue', 
            		'new_item' 				=> 'New Venue',
            		'view_item' 			=> 'View Venue',
            		'search_items' 			=> 'Search Venue',
            		'not_found' 			=> 'No Venue Found',
            		'not_found_in_trash'	=> 'No Venue Found In Trash'
    );
	 
     register_post_type( 'venues',$args);
     flush_rewrite_rules( false );
      
}

// post type news
function create_post_type_news() {
     $args = array(
     		'menu_position' => 10,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'hierarchical' => true,
			'has_archive' => false,
			'show_in_nav_menus' => true,
			'query_var' => true,
            'rewrite' => array('slug' => _x( 'new', 'URL slug', 'wpml_dev' )),
            'supports' => array( 
            		'title','editor','thumbnail','excerpt','revisions'),
            'labels' => array(
            		'name' 					=> __( 'News' ),
            		'singular_name' 		=> __( 'news' )),
            		'add_new'				=> 'Add new item in News',
            		'add_new_item'			=> 'Add new item in News',
            		'edit_item' 			=> 'Edit News', 
            		'new_item' 				=> 'New News',
            		'view_item' 			=> 'View News',
            		'search_items' 			=> 'Search News',
            		'not_found' 			=> 'No News Found',
            		'not_found_in_trash'	=> 'No News Found In Trash'
    );
	 
     register_post_type( 'news',$args);
     flush_rewrite_rules( false );
      
}

// post type publications
function create_post_type_publications() {
     $args = array(
     		'menu_position' => 10,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'hierarchical' => true,
			'exclude_from_search' => false,
			'has_archive' => false,
			'show_in_nav_menus' => true,
			'query_var' => true,
            'rewrite' => array('slug' => _x( 'project/publication', 'URL slug', 'wpml_dev' ), 'pages'=>false),
            'supports' => array( 
            		'title','editor','thumbnail','excerpt','revisions'),
            'labels' => array(
            		'name' 					=> __( 'Publications' ),
            		'singular_name' 		=> __( 'publications' )),
            		'add_new'				=> 'Add new Publication',
            		'add_new_item'			=> 'Add new Publication',
            		'edit_item' 			=> 'Edit Publication', 
            		'new_item' 				=> 'New Publication',
            		'view_item' 			=> 'View Publication',
            		'search_items' 			=> 'Search Publication',
            		'not_found' 			=> 'No Publication Found',
            		'not_found_in_trash'	=> 'No Publication Found In Trash'
    );
	 
     register_post_type( 'publications',$args);
     flush_rewrite_rules( false );
      
}

 

?>