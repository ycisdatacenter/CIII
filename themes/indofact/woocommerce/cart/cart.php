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
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<section>
<div class="row_inner_wrapper clearfix">
<div class="row_inner container clearfix">
<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart">
	<thead>
		<tr>
			
			<th class="product-thumbnail"><?php _e( 'Product', 'indofact' ); ?></th>
			<th class="product-name"><?php _e( '', 'indofact' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'indofact' ); ?></th>
			<th class="product-quantity"><?php _e( 'QTY', 'indofact' ); ?></th>
			<th class="product-subtotal"><?php _e( 'SUBTOTAL', 'indofact' ); ?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$product_content = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$product_des= $_product->get_description();
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo esc_attr($thumbnail);
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="product-name" data-title="<?php _e( 'Product', 'indofact' ); ?>">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a><p class="gap">', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
								//echo ($_product->get_description());
								echo substr($product_des,0,100);
							}

							// Meta data
							echo wc_get_formatted_cart_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'indofact' ) . '</p>';
							}
						?>
					</td>

					<td class="product-price" data-title="<?php _e( 'Price', 'indofact' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity" data-title="<?php _e( 'Quantity', 'indofact' ); ?>">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

					<td class="product-subtotal" data-title="<?php _e( 'Total', 'indofact' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash"></i></a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								esc_html( 'Remove this item', 'indofact' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="row bottom-box">

				<div class="col-lg-3 col-md-3 col-sm-6 pull-right add-to-cart-wrap">
				<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Shopping Cart', 'indofact' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</div>
			</td>
		</tr>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>


<?php if ( wc_coupons_enabled() ) { ?>
				<div class="discount-codes">
					<h4>Discount Codes</h4>
               <div class="codes-field">
                  <label>Enter Your Coupon Code If you have one.</label>
					<input type="text" name="coupon_code" class="codes-input" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'indofact' ); ?>" /> 
					<input type="submit" class="apply-coupon" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'indofact' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
					</div>
				<?php } ?>
<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>				
<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>
</div>
</div>
</section>
<?php do_action( 'woocommerce_after_cart' ); ?>
