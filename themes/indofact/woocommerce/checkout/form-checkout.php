<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  ?>
<section class="pad95-100-top-bottom">
<div class="row_inner_wrapper clearfix">
	<div class="row_inner container clearfix">
<?php
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html( 'You must be logged in to checkout.', 'indofact' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 billing-left">
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<?php do_action( 'woocommerce_checkout_billing' ); ?>
			<?php do_action( 'woocommerce_checkout_shipping' ); ?>	
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		</div>

		<?php endif; ?>

		
		<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 order-rght">
			<div class="section_header color">
				<h4><?php _e( 'Your order', 'indofact' ); ?></h4>
			</div>
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div class="product-orderlst">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			
		</div>

</div>
	
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	</div>
</div>
</section>
