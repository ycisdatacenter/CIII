<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
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
	exit; // Exit if accessed directly
}

global $post, $product,$tmc_option;

$cats = get_the_terms( $post->ID, 'product_cat' );
$tags = get_the_terms( $post->ID, 'product_tag' );	?>
<ul class="prd-info-list">
	
<?php	
if(!empty($cats))
{ ?>
	<li><span>Categories:</span>
		<?php
		foreach ($cats as $cat)
		{	?>
			<span class="meta_list"><?php echo esc_attr($cat->name); ?></span>
        <?php	
        } ?>
	</li>
<?php
}	?>

<?php	
if(!empty($tags))
{ ?>
	<li><span>Tags:</span>
		<?php
		foreach ($tags as $tag)
		{	?>
			<span class="meta_list"><?php echo esc_attr($tag->name);?></span>
        <?php	
        } ?>
	</li>
<?php
}	?>
	
</ul>
<div class="header-socials footer-socials product-socials"> 
   <a href="<?php echo esc_attr($tmc_option['woo_facebook']);?>"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
   <a href="<?php echo esc_attr($tmc_option['woo_tw']);?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
   <a href="<?php echo esc_attr($tmc_option['woo_google_plus']);?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a> 
   <a href="<?php echo esc_attr($tmc_option['woo_linkedin']);?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
</div>