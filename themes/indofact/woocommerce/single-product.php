<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit; // Exit if accessed directly
}
get_header( 'shop' ); 
global $tmc_option; 
if ( ! empty($tmc_option['shop_sidebar_type'])) 
{
	$sidebar_type = $tmc_option['shop_sidebar_type'];
} 
else 
{
	$sidebar_type = 'wp';
}

if ( $sidebar_type == 'wp' ) 
{
	$sidebar_id = $tmc_option['shop_wp_sidebar'];
}
else 
{
	$sidebar_id = $tmc_option['shop_vc_sidebar'];
}
if ( ! empty( $sidebar_id ) ) 
{
	 $sidebar_id =  $sidebar_id;
} 
else 
{
	$sidebar_id = 'tmc-shop-sidebar';
}
if ( ! empty($tmc_option['shop_detail_layout'])) 
{
	$sidebar_position = $tmc_option['shop_detail_layout'];
}
else 
{
	$sidebar_position = 'right';
}
$structure = tmc_get_structure( $sidebar_id, $sidebar_type, $sidebar_position ); 

echo translate($structure['content_before']);
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );	
	while ( have_posts() ) : the_post(); 
		wc_get_template_part( 'content', 'single-product' ); 
	endwhile; // end of the loop.	
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	
	echo translate($structure['content_after']);
	echo translate($structure['sidebar_before']); 
if ( $sidebar_id ) 
{
	if ( $sidebar_type == 'wp' ) 
	{
		$sidebar = true;
	} 
	else 
	{
		$sidebar = get_post( $sidebar_id );
	}
}
if ( isset( $sidebar ) ) 
{
	if ( $sidebar_type == 'vc' ) 
	{ ?>
		<div class="sidebar-area tmc_sidebar">
			<style type="text/css" scoped>
				<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
			</style>
			<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
		</div>
	<?php 
	} 
	else 
	{ 
		if(isset($tmc_option['shop_detail_layout']) && $tmc_option['shop_detail_layout'] != 'no_sidebar') 
		{ ?>
			<div class="sidebar-area default_widgets">
				<?php dynamic_sidebar( 'tmc-shop-sidebar' ); ?>
			</div>
			<?php 
		} 
	}
}
echo translate($structure['sidebar_after']);
	
	
	
	get_footer( 'shop' ); ?>
