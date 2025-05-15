<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
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
if ( ! empty($tmc_option['shop_sidebar_position'])) 
{
	$sidebar_position = $tmc_option['shop_sidebar_position'];
}
else
{
	$sidebar_position = 'right';
}
$structure = tmc_get_structure( $sidebar_id, $sidebar_type, $sidebar_position ); 

echo html_entity_decode($structure['content_before']);
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	
	if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif;
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
	if ( have_posts() ) :
			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
			$column = $tmc_option['select_woocommercecolumns']; ?>
			<div class="<?php echo html_entity_decode($column); ?>">
				<?php 
				woocommerce_product_loop_start(); 
				woocommerce_product_subcategories();
					while ( have_posts() ) : the_post(); 
						wc_get_template_part( 'content', 'product' );
						endwhile; // end of the loop. 
						woocommerce_product_loop_end(); ?>
			</div>
			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : 
			wc_get_template( 'loop/no-products-found.php' ); 
			endif; 
			
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		echo html_entity_decode($structure['content_after']); 
		
		echo html_entity_decode($structure['sidebar_before']); 
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
			if(isset($tmc_option['shop_sidebar_position']) && $tmc_option['shop_sidebar_position'] != 'no_sidebar') 
			{ ?>
				<div class="sidebar-area default_widgets">
					<?php dynamic_sidebar( 'tmc-shop-sidebar' ); ?>
				</div>
				<?php 
			}
		}
	}	
echo html_entity_decode($structure['sidebar_after']); 
		
		get_footer( 'shop' ); ?>
