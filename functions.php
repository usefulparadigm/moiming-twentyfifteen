<?php

// Hide admin bar if user is not admin
add_filter( 'show_admin_bar' , 'my_function_admin_bar' );
function my_function_admin_bar(){
	return current_user_can( 'manage_options' );
}

// 참가신청 폼에 히든 필드로 Post ID 추가하기
add_action( 'frm_entry_form', 'my_frm_entry_form' );
function my_frm_entry_form( $form ) {
  echo '<input type="hidden" name="post_id" value="'.get_the_ID().'">';
}

// Add custom query vars
// add_filter( 'query_vars', 'add_my_query_vars_filter' );
// function add_my_query_vars_filter( $vars ) {
//     $vars[] = "loc";
//     return $vars;
// }

// Hooking pre_get_posts
add_action( 'pre_get_posts', 'my_pre_get_posts' );
function my_pre_get_posts( $query ) {
    
    // do not modify queries in the admin
if( is_admin() ) { return $query; }
    
    if ( $query->is_main_query() && is_post_type_archive( 'moim' ) ) {
        
        if( isset($_GET['loc']) ) {
            $meta_query[] = array(
                array(
                    'key' => 'moim_location_map',
                    'value' =>  $_GET['loc'], //$query->query_vars['loc'],
                    'compare' => 'LIKE'
                )
            );
            $query->set( 'meta_query', $meta_query );
        } 
    }
    return $query; 
}