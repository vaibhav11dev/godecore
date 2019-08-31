<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ( $product->is_featured() || $product->is_on_sale() ){
	?>
	<div class="hot-sale-wrapper">
		<?php if ( $product->is_featured() ) : ?>

			<?php echo apply_filters( 'vedanta_featured', '<span class="featured">' . esc_html__( 'Hot!', 'godecore' ) . '</span>', $post, $product ); ?>

		<?php endif;?>
		<?php if ( $product->is_on_sale() ) : ?>

			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'godecore' ) . '</span>', $post, $product ); ?>

		<?php endif;?>
	</div>
	<?php
}
