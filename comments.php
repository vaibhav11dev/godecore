<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 *
 * @package GoDecore
 */
if ( post_password_required() ) {
	?>
	<p class="password-protected alert"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'godecore' ); ?></p>
	<?php
	return;
}
?>
<!-- COMMENTS -->
<div id="comments" class="comments-area">   
	<?php if ( have_comments() ) { ?>

		<?php
		if ( ! empty( $comments_by_type[ 'comment' ] ) ) {
			vedanta_discussion_title( 'comment' );
		} else {
			// If comments are open, but there are no comments.
			if ( comments_open() ) {
				echo '<h5 class="comment-title text-title text-uppercase">';
				esc_html__( 'No Comments Yet', 'godecore' );
				echo '</h5>';
			}
		}

		if ( ! empty( $comments_by_type[ 'pings' ] ) ) {
			vedanta_discussion_title( 'pings' );
		}

		if ( ! empty( $comments_by_type[ 'comment' ] ) ) {
			?>
			<!--BEGIN .comment-list-->
			<div class="comment-list">
				<?php
				wp_list_comments( array(
					'style'		 => 'div',
					'callback'	 => 'vedanta_comments_callback',
					'end-callback'	 => 'vedanta_comments_endcallback'
				) );
				?>
				<!--END .comment-list-->
			</div>
		<?php } ?>   

		<?php if ( ! empty( $comments_by_type[ 'pings' ] ) ) { ?>    
			<!--BEGIN .pings-list-->
			<div class="comment-list">
				<?php
				wp_list_comments( array(
					'style'		 => 'div',
					'type'		 => 'pings',
					'callback'	 => 'vedanta_pings_callback',
					'end-callback'	 => 'vedanta_pings_endcallback'
				) );
				?>
				<!--END .pings-list-->
			</div>
		<?php }
	}
	?>
</div>
<!--END COMMENTS-->
<?php if ( comments_open() ) { ?>

	<!-- COMMENT FORM -->
	<?php vedanta_custom_comment_form(); ?>
	 <!-- COMMENT FORM -->

	<?php
} 