<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 *
 * @package GoDecore
 */

?>

<section class="no-results not-found">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'godecore' ); ?></h1>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf( '<p>%1$s<a href="%2$s">%3$s</a></p>', esc_html__( 'Ready to publish your first post?', 'godecore' ), esc_url( admin_url( 'post-new.php' ), esc_html__( 'Get started here', 'godecore' ) ));

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'godecore' ); ?></p>
                        <?php
                        get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'godecore' ); ?></p>
                        <?php
                        get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
