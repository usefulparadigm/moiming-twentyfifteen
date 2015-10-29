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

