<?php
/*
 * 
 * Portfolio category template
 *
 */

get_header();
?>

<!-- PORTFOLIO -->
<section class="module p-tb-content">
    <div class="container">
    <div class="row">

	<!-- SECONDARY-2 -->	    
	<?php
	if ( vedanta_lets_get_sidebar_2() == true ):
		get_sidebar( '2' );
	endif;
	?>
	<!-- END SECONDARY-2 -->

	<!-- PRIMARY -->
	<div id="primary" class="<?php vedanta_layout_class( $type = 1 ); ?> post-content">
	    <?php get_template_part( 'template-parts/content', 'portfolio-archive' ); ?>
	</div>
	<!-- END PRIMARY -->

	<!-- SECONDARY-1 -->
	<?php
	if ( vedanta_lets_get_sidebar() == true ) {
		get_sidebar();
	}
	?>
	<!-- END SECONDARY-1 -->

    </div>
    </div>
</section>
<!-- END PORTFOLIO -->

<?php
get_footer();
