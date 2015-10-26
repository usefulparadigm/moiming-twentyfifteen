<?php

// add_action( 'wp_enqueue_scripts', 'twentyfifteen_parent_theme_enqueue_styles' );
//
// function twentyfifteen_parent_theme_enqueue_styles() {
//     wp_enqueue_style( 'twentyfifteen-style', get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( '-style',
//         get_stylesheet_directory_uri() . '/style.css',
//         array('twentyfifteen-style')
//     );
//
// }

// Hide admin bar if user is not admin
add_filter( 'show_admin_bar' , 'my_function_admin_bar' );
function my_function_admin_bar(){
	return current_user_can( 'manage_options' );
}
