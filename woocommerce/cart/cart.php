<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' );
?>

<div class="row">
<div class="col-lg-8">
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="cart-with-coupon">
	    <div class="table-responsive">
		<table class="table cart-table shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		    <thead>
			<tr>
			    <th class="product-remove">&nbsp;</th>
			    <th class="product-thumbnail">&nbsp;</th>
			    <th class="product-name"><?php esc_html_e( 'Product', 'godecore' ); ?></th>
			    <th class="product-price"><?php esc_html_e( 'Price', 'godecore' ); ?></th>
			    <th class="product-quantity"><?php esc_html_e( 'Quantity', 'godecore' ); ?></th>
			    <th class="product-subtotal"><?php esc_html_e( 'Total', 'godecore' ); ?></th>
			</tr>
		    </thead>
		    <tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			    $_product	 = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
			    $product_id	 = apply_filters( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );

			    if ( $_product && $_product->exists() && $cart_item[ 'quantity' ] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink	 = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

				    <td class="product-remove col-trash">
					<?php
					// @codingStandardsIgnoreLine
					echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
					'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash"></i></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'godecore' ), esc_attr( $product_id ), esc_attr( $_product->get_sku() )
					), $cart_item_key );
					?>
				    </td>

				    <td class="product-thumbnail col-thumbnail"><?php
					$thumbnail		 = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $product_permalink ) {
					    echo wp_kses_post($thumbnail);
					} else {
					    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
					}
					?></td>

				    <td class="product-name col-title" data-title="<?php esc_attr_e( 'Product', 'godecore' ); ?>"><?php
					if ( ! $product_permalink ) {
					    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
					} else {
					    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h5 class="m-b-5"><a href="%s">%s</a></h5>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
					}

					// Meta data.
					echo wc_get_formatted_cart_item_data( $cart_item );

					// Backorder notification.
					if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item[ 'quantity' ] ) ) {
					    echo '<span class="backorder_notification text-xs">' . esc_html__( 'Available on backorder', 'godecore' ) . '</span>';
					}
					?></td>

				    <td class="product-price col-price" data-title="<?php esc_attr_e( 'Price', 'godecore' ); ?>">
					<?php
					echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
				    </td>

				    <td class="product-quantity col-quantity" data-title="<?php esc_attr_e( 'Quantity', 'godecore' ); ?>"><?php
					if ( $_product->is_sold_individually() ) {
					    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
					} else {
					    $product_quantity = woocommerce_quantity_input( array(
						'input_name'	 => "cart[{$cart_item_key}][qty]",
						'input_value'	 => $cart_item[ 'quantity' ],
						'max_value'	 => $_product->get_max_purchase_quantity(),
						'min_value'	 => '0',
						'product_name'	 => $_product->get_name(),
					    ), $_product, false );
					}

					echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
					?></td>

				    <td class="product-subtotal col-subtotal" data-title="<?php esc_attr_e( 'Total', 'godecore' ); ?>">
					<?php
					echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item[ 'quantity' ] ), $cart_item, $cart_item_key );
					?>
				    </td>
				</tr>
				<?php
			    }
			}
			?>

		    </tbody>
		</table>
	    </div>
	    <?php do_action( 'woocommerce_cart_contents' ); ?>


	    <?php if ( wc_coupons_enabled() ) { ?>
    	    <!-- COUPON -->
    	    <div class="coupon">
    		<div class="row">
    		    <div class="col-sm-9">
    			<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'godecore' ); ?></label>
    			<input type="text" name="coupon_code" class="form-control input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'godecore' ); ?>" />
    		    </div>
    		    <div class="col-sm-3">
    			<input type="submit" class="button btn btn-block btn-round btn-dark m-t-xs-20 btn-base" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'godecore' ); ?>" />
    		    </div>
			<?php do_action( 'woocommerce_cart_coupon' ); ?>
    		</div>
    	    </div>
    	    <!-- END COUPON -->
	    <?php } ?>

	    <div class="col-sm-12 btn-update-cart">
		<button type="submit" class="button btn btn-round btn-lg btn-base" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'godecore' ); ?>"><?php esc_html_e( 'Update cart', 'godecore' ); ?></button>
	    </div>
	    <div class="clearfix"></div>

	    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

	    <?php do_action( 'woocommerce_after_cart_contents' ); ?>

	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>
</div>
<!-- END TABLE WITH COUPON -->
<div class="col-lg-4">
    <div class="cart-collaterals">
	<?php
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	do_action( 'woocommerce_cart_collaterals' );
	?>

        <div class="cart-totals-buttons">
	    <?php woocommerce_cart_totals(); ?>
	    <div class="text-right wc-proceed-to-checkout">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt btn btn-round btn-lg btn-base wc-forward">
		    <?php esc_html_e( 'Proceed to checkout', 'godecore' ); ?>
		</a>
	    </div>
	    <?php do_action( 'woocommerce_cart_actions' ); ?>
        </div>  

    </div>
</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
