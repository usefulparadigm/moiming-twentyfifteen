<?php
/**
 * The template for displaying single moim
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<?php
        		// Post thumbnail.
        		twentyfifteen_post_thumbnail();
        	?>

        	<header class="entry-header">
        		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        	</header><!-- .entry-header -->

            <div class="entry-content">
            	<?php the_content(); ?>

                <h3>모임 날짜: <?php the_field( 'moim_date' ); ?></h3>
                <h3>모임 장소</h3>
                <?php
                $map = get_field( 'moim_location_map' );
                if( !empty($map) ): ?>

                    <?php echo $map['address']; ?>
                    <iframe 
                        width="600" height="350" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?q=<?php echo $map['address']; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU" allowfullscreen></iframe>

                <?php endif; ?>
            </div><!-- .entry-content -->

        	<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

        </article><!-- #post-## -->

        <div id="attendants" class="comments-area">
    		<h2 class="comments-title">참가신청</h2>
            <?php if ( is_user_logged_in() ): ?>
                <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 11 ) ); ?>
            <?php else: ?>
                <p class="info">
                    참가신청를 하려면 
                    <a href="<?php echo wp_login_url( get_permalink().'#attendants' ); ?>" title="Login">로그인</a>
                    하세요!
                </p>    
            <?php endif; ?>
            
            <?php echo FrmProDisplaysController::get_shortcode( array( 'id' => 97 ) ); ?>
        </div>    
        
        <?php
			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
            // get_template_part( 'content', 'moim' );
            
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
