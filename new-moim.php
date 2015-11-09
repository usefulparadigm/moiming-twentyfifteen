<?php
/**
 * Template Name: 새 모임
 *
 * @author Dave Kim
 * @link http://usefulparadigm.com/
 * @uses Advanced Custom Fields
 */

if ( !is_user_logged_in() ) { wp_redirect( wp_login_url() ); exit; }

add_filter('acf/pre_save_post' , 'my_pre_save_post' );
function my_pre_save_post( $post_id ) {
	// bail early if not a new post
	if( $post_id !== 'new' ) {
		return $post_id;
	}

	// vars
	$title = $_POST['fields']['field_5625a4d812692']; // CHANGE THIS field key!!
    $content = $_POST['fields']['field_5625a50812693']; // CHANGE THIS field key!!
	
	// Create a new post
	$post = array(
		'post_status'	=> 'publish', #'draft'
		'post_type'		=> 'moim',
		'post_title'	=> wp_strip_all_tags($title),
        'post_content'  => $content,
	);	
	
	// insert the post
	$post_id = wp_insert_post( $post );

    // change return url to the post
    // $_POST['return'] = add_query_arg(array('post_id' => $post_id), $_POST['return']);
    $return_url = get_permalink($post_id);
    if ( $return_url ) {
        $_POST['return'] = add_query_arg( 'updated', 'true', $return_url );
    }
	
	// return the new ID
	return $post_id;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=moim_featured_image', 'my_set_moim_featured_image', 10, 3);
function my_set_moim_featured_image( $value, $post_id, $field  ){
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
    return $value;
}

acf_form_head();
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            	<header class="entry-header">
            		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            	</header>

                <div class="entry-content">
    
                    <?php
                    $options = array(
                        'post_id' => 'new',
                        'field_groups' => array(47, 115), // CHANGE THIS field group id!!
                        'submit_value' => '만들기',
                    );
                    acf_form( $options );
                    ?>

                </div>
            </article>
		</main>
	</div>

<?php get_footer(); ?>
