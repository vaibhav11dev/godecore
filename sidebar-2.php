<?php
/**
 * The sidebar-2 containing the main widget area
 *
 *
 * @package GoDecore
 */
$vedanta_sidebar_css = '';
if ( class_exists( 'Woocommerce' ) ) {
	if ( is_cart() || is_checkout() || is_account_page() || (get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) )) ) {
		$vedanta_sidebar_css = 'display:none';
	}
}
?>

<div id="secondary-2" class="aside sidebar <?php vedanta_sidebar2_class(); ?>"
     <?php
     if ( class_exists( 'Woocommerce' ) ):
	     echo 'style="' . esc_attr($vedanta_sidebar_css) . '"';
     endif;
     ?>>

    <?php
    /* Widgetized Area */
    if ( is_active_sidebar( 'sidebar-2' ) ) :
        dynamic_sidebar( 'sidebar-2' );
    endif;
    ?>
</div>