<?php
/**
 * indofact functions and definitions
 *
 * @package indofact
 */
/**
 * Define theme constants
 */
//include_once 'custom-elementor.php';
$tmc_theme = wp_get_theme();
if ( $tmc_theme->exists() ) {
	define( 'TMC_THEME_NAME', $tmc_theme->get( 'Name' ) );
	define( 'TMC_THEME_VERSION', $tmc_theme->get( 'Version' ) );
}
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}
add_action( 'after_setup_theme', 'tmc_theme_setup' );
if ( ! function_exists( 'tmc_theme_setup' ) ) {
	function tmc_theme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on industrial, use a find and replace
		 * to change 'indofact' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'indofact', get_template_directory() . '/languages' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	
		if ( ! get_post_meta( get_the_ID(), 'disable_tags', true ) ) {
		the_tags( '<div class="tags media-body">', ' ', '</div>' );
		}
		 
		//Image Croped for Latest News	
        add_image_size( 'tmc-image-370x488-croped', 370, 488, true );
		add_image_size( 'tmc-image-483x480-croped', 483, 480, true );
		//Image Croped for Latest News	
		add_image_size( 'tmc-image-370x253-croped', 370, 253, true );
		//Image Croped for projects
		add_image_size( 'tmc-image-457x485-croped', 457, 485, true );
		//Image Croped for portfolio two
		add_image_size( 'tmc-image-555x429-croped', 555, 429, true );
		//Image Croped for portfolio three
		add_image_size( 'tmc-image-360x278-croped', 360, 278, true );
		//Image Croped for portfolio four
		add_image_size( 'tmc-image-263x203-croped', 263, 203, true );
		//Image Croped for portfolio five
		add_image_size( 'tmc-image-240x185-croped', 240, 185, true );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'tmc' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		
		 /*
		  * Enable support for custome header and background for the images.
		  */
			add_theme_support( 'custom-header' );
		    add_theme_support( 'custom-background' ) ;
		 // This theme styles the visual editor to resemble the theme style.
		 
		 /*
		  * Gutenberg Compatible
		  */
			add_theme_support( 'align-wide' );
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'editor-styles' );
		 
		  //WooCommerce Theme Support
		add_theme_support('woocommerce');
		if ( class_exists('Woocommerce') )
		{
			global $tmc_option;
			$tmc_option = get_option('tmc_option');
			// Increase Number of Related Products to 4
			if (!function_exists('woocommerce_related_output'))
			{
				function woocommerce_related_output() 
				{
					global $product, $orderby, $related;
					$args = array(
									'posts_per_page'	=> '4',
									'columns'			=> '4',
								);
					return $args;
				}
			}
			add_filter( 'woocommerce_output_related_products_args', 'woocommerce_related_output' );
			// Change products per page
			if(!empty($tmc_option['text_shopitems']))
			{
				add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
				function new_loop_shop_per_page( $cols ) {
					global $tmc_option;
		// $cols contains the current number of products per page based on the value stored on Options -> Reading
	   // Return the number of products you wanna show per page.
				  $cols = $tmc_option['text_shopitems'];
				  return $cols;
				}
			}
			// Toggle Sort by Function
			if(isset($tmc_option["switch_shopsorting"]) &&  $tmc_option["switch_shopsorting"] == 0)
			{
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}
			// Toggle Result Count
			if(isset($tmc_option["switch_shopresultcount"]) && $tmc_option["switch_shopresultcount"] == 0)
			{
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			}
			// Toggle Upsell Products
			if(isset($tmc_option["switch_shopupsells"]) && $tmc_option["switch_shopupsells"] == 0)
			{
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
			}
			// Toggle Related Products
			if(isset($tmc_option["switch_shoprelatedproducts"]) && $tmc_option["switch_shoprelatedproducts"] == 0)
			{
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
			}
			// Toggle Add to Cart Button
			if(isset($tmc_option["switch_addtocart"]) && $tmc_option["switch_addtocart"] == 0)
			{
				add_action('init','woocommerce_remove_loop_button');
			}
			// Remove Cart Cross Sells
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			// Remove Add to Cart Button
			function woocommerce_remove_loop_button()
			{
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			}
		} // end if woocommerce class exists
		 add_editor_style( 'assets/css/editor-style.css' );
 
		register_nav_menus(
			array(
				'tmc-primary'   	=> esc_html__( 'Primary','indofact' ),
				'tmc-footer-one' 	=> esc_html__( 'Footer One','indofact' ),
				'tmc-footer-two'	=> esc_html__( 'Footer Two','indofact' ),
				'tmc-service' 		=> esc_html__( 'Service','indofact' )
			)
		);
	}
}
function tmc_read_more_link() {
    return '<a href="' . get_permalink() . '" class="read-more-link">'.esc_html__('Read more','indofact').'</a>';
}
add_filter( 'the_content_more_link', 'tmc_read_more_link' );
//Default Home on breadcumb 
add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
 if ($type[0] === 'home') {
  $title = get_the_title(get_option('page_on_front'));
 }
 return $title;
}, 42, 3);
/************************************************************************
* Set Inner header and footer background image/color.
*************************************************************************/
function backgroundStyle( $key ){
	global $tmc_option;
	$inner_header_style = array();
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-image']))
	{
		$inner_header_style[] = 'background-image: url('.$tmc_option[''.esc_attr($key).'']['background-image'].');';
	}
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-color']))
	{
		$inner_header_style[] = 'background-color: '.$tmc_option[''.esc_attr($key).'']['background-color'].';';
	}
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-repeat']))
	{
		$inner_header_style[] = 'background-repeat: '.$tmc_option[''.esc_attr($key).'']['background-repeat'].';';
	}
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-size']) )
	{
		$inner_header_style[] = 'background-size: '.$tmc_option[''.esc_attr($key).'']['background-size'].';';
	}
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-position']))
	{
		$inner_header_style[] = 'background-position: '.$tmc_option[''.esc_attr($key).'']['background-position'].';';
	}
	if ( isset($tmc_option[''.esc_attr($key).'']) && !empty($tmc_option[''.esc_attr($key).'']['background-attachment']) )
	{
		$inner_header_style[] = 'background-attachment: '.$tmc_option[''.esc_attr($key).'']['background-attachment'].';';
	}
	
	return $inner_header_style;
}
/************************************************************************
* Theme Meta box value.
*************************************************************************/
function metaBox()
{
	$metaData = array();
	$metaData['hide-title'] 				= get_post_meta( get_the_ID(), 'page-hide-title', true );
	$metaData['hide-breadcrumb'] 			= get_post_meta( get_the_ID(), 'page-hide-breadcrumb', true );
	$metaData['header-title'] 				= get_post_meta( get_the_ID(), 'page-header-title', true );
	$metaData['title-color'] 				= get_post_meta( get_the_ID(), 'page-title-color', true );
	$metaData['title-alignment']			= get_post_meta( get_the_ID(), 'page-title-alignment', true );
	$metaData['title-padding-top'] 			= get_post_meta( get_the_ID(), 'page-title-padding-top', true );
	$metaData['title-padding-bottom'] 		= get_post_meta( get_the_ID(), 'page-title-padding-bottom', true );
	$metaData['header-height'] 				= get_post_meta( get_the_ID(), 'page-header-height', true );
	$metaData['hide-background'] 			= get_post_meta( get_the_ID(), 'page-hide-background', true );
	$metaData['background-color'] 			= get_post_meta( get_the_ID(), 'page-background-color', true );
	$metaData['header-image'] 				= get_post_meta( get_the_ID(), 'page-header-image', true );
	$metaData['image-repeat'] 				= get_post_meta( get_the_ID(), 'page-header-image-repeat', true );
	$metaData['image-size'] 				= get_post_meta( get_the_ID(), 'page-header-image-size', true );
	$metaData['image-attachment'] 			= get_post_meta( get_the_ID(), 'page-header-image-attachment', true );
	$metaData['image-position'] 			= get_post_meta( get_the_ID(), 'page-header-image-position', true );
	$metaData['content-padding-top'] 		= get_post_meta( get_the_ID(), 'page-content-padding-top', true );
	$metaData['content-padding-bottom'] 	= get_post_meta( get_the_ID(), 'page-content-padding-bottom', true );
	$metaData['hide-footer'] 				= get_post_meta( get_the_ID(), 'page-hide-footer', true );
	$metaData['footer-background-color'] 	= get_post_meta( get_the_ID(), 'page-footer-background-color', true );
	$metaData['footer-background-image'] 	= get_post_meta( get_the_ID(), 'page-footer-image', true );
	$metaData['footer-image-repeat'] 		= get_post_meta( get_the_ID(), 'page-footer-image-repeat', true );
	$metaData['footer-image-size'] 			= get_post_meta( get_the_ID(), 'page-footer-image-size', true );
	$metaData['footer-image-attachment'] 	= get_post_meta( get_the_ID(), 'page-footer-image-attachment', true );
	$metaData['footer-image-position'] 		= get_post_meta( get_the_ID(), 'page-footer-image-position', true );
	$metaData['footer-title-color'] 		= get_post_meta( get_the_ID(), 'page-footer-title-color', true );
	$metaData['footer-text-color'] 			= get_post_meta( get_the_ID(), 'page-footer-text-color', true );
	$metaData['hide-copyright'] 			= get_post_meta( get_the_ID(), 'page-hide-copyright', true );
	
	return $metaData;	
}
/************************************************************************
* Theme Meta box post type.
*************************************************************************/
function postType(){
	$metaData = '';
	$metaData = metaBox();
	return $metaData;
}
if ( ! function_exists( 'tmc_register_default_sidebars' ) ) {
	function tmc_register_default_sidebars() {
		
		//Right Sidebar
		register_sidebar( array(
			'id'            => 'tmc-right-sidebar',
			'name'          => esc_html__( 'Right Sidebar','indofact' ),
			'description'   => esc_html__( 'Add widgets here to appear in Right Sidebar','indofact'),
			'before_widget' => '<div id="%1$s" class="widget %2$s wdt-100">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="recentTitle"><h4>',
			'after_title'   => '</h4></div>',
		) );
		
		//Left Sidebar
		register_sidebar( array(
			'id'            => 'tmc-left-sidebar',
			'name'          => esc_html__( 'Left Sidebar','indofact' ),
			'description'   => esc_html__( 'Add widgets here to appear in Left Sidebar','indofact'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="recentTitle"><h5 class="h5 as">',
			'after_title'   => '</h5></div>',
		) );
		
		//Services Sidebar
		register_sidebar( array(
			'id'            => 'tmc-services-sidebar',
			'name'          => esc_html__( 'Services Sidebar','indofact' ),
			'description'   => esc_html__( 'Add widgets here to appear in Services Sidebar','indofact'),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<div class="recentTitle"><h5 class="h5 as">',
			'after_title'   => '</h5></div>',
		) );
		//Shop Sidebar
		register_sidebar(array(
				'id'            => 'tmc-shop-sidebar',
				'name'          => esc_html__( 'Shop Sidebar', 'indofact' ),
				'description'   => esc_html__( 'Add widgets here to appear in Shop sidebar', 'indofact' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s wdt-100">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);	
						
		// Register Footer Sidebars
		for ( $footer = 1; $footer < 5; $footer ++ ) 
		{
			register_sidebar( array(
				'id'            => 'tmc-footer-' . $footer,
				'name'          => esc_html__( 'Footer widget ','indofact' ) . $footer,
				'description'   => esc_html__( 'Add widgets here to appear in Footer Widget Area','indofact'),
				'before_widget' => '<div id="%1$s" class="widget %2$s footerBlock normall">',
				'after_widget'  => '<div class="empty-space-sm-30"></div></div>',
				'before_title'  => '<div class="footerTitle"><p class="widget_title">',
				'after_title'   => '</p></div>',
			) );
		}
	}
}
add_action( 'widgets_init', 'tmc_register_default_sidebars', 50 );
/*code to use woocommerce.css*/
function indofact_woocommerce_style_sheet() 
{
	wp_register_style( 'woocommerce', get_stylesheet_directory_uri() . '/woocommerce/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) 
	{
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action('wp_enqueue_scripts', 'indofact_woocommerce_style_sheet');
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function indofact_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'indofact_pingback_header' );
add_action( 'wp_enqueue_scripts', 'tmc_load_theme_scripts_and_styles' );
if( ! function_exists( 'tmc_load_theme_scripts_and_styles' ) ){
	function tmc_load_theme_scripts_and_styles() {
		global $tmc_option;
		if ( ! is_admin() )
		{
			/* Register Styles */
			wp_enqueue_style( 'indofact-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, TMC_THEME_VERSION, 'all' ); 
			wp_enqueue_style( 'indofact-style', get_stylesheet_uri(), null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-responsive', get_template_directory_uri() . '/assets/css/responsive.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-font_awesome_min', get_template_directory_uri() .'/assets/css/font-awesome.min.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-animate', get_template_directory_uri() . '/assets/css/animate.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-animate-min', get_template_directory_uri() . '/assets/css/animate.min.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-responsive_bootstrap_carousel', get_template_directory_uri() . '/assets/css/responsive_bootstrap_carousel.css', null, TMC_THEME_VERSION, 'all' );
			wp_enqueue_style( 'indofact-strock-icon', get_template_directory_uri() . '/assets/css/strock-icon.css', null, TMC_THEME_VERSION, 'all' );
			/* ---------------------------------------------------------------------------
			* Gutenberg
			* --------------------------------------------------------------------------- */
			wp_enqueue_style( 'indofact-gutenberg', get_theme_file_uri('assets/css/gutenberg.css'), false, TMC_THEME_VERSION, 'all' );
			
			/* Register Scripts */
			wp_enqueue_script( 'indofact-slick', get_template_directory_uri() . '/assets/js/slick.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-touchSwipe', get_template_directory_uri() . '/assets/js/jquery.touchSwipe.min.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-responsive-bootstrap-carousel', get_template_directory_uri() . '/assets/js/responsive_bootstrap_carousel.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'indofact-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			
			wp_enqueue_script( 'indofact-waypoints', get_template_directory_uri() . '/assets/js/waypoints.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array( 'jquery' ), TMC_THEME_VERSION, true );
			/* Enqueue Scripts */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}					
		}
	}
}
// Google fonts
function tmc_fonts_url() {
$fonts_url = '';
/* Translators: If there are characters in your language that are not
* supported by Montserrat, translate this to 'off'. Do not translate
* into your own language.
*/
$Montserrat = _x( 'on', 'Montserrat font: on or off','indofact' );
/* Translators: If there are characters in your language that are not
* supported by Open Sans, translate this to 'off'. Do not translate
* into your own language.
*/
$open_sans = _x( 'on', 'Open Sans font: on or off','indofact' );
 
/* Translators: If there are characters in your language that are not
* supported by Lato, translate this to 'off'. Do not translate
* into your own language.
*/
$Lato = _x( 'on', 'Lato Serif font: on or off','indofact' ); 
$poppins = _x( 'on', 'Poppins font: on or off','indofact' );
  
	if ( 'off' !== $Montserrat || 'off' !== $open_sans  ||  'off' !== $Lato  ||  'off' !== $poppins)
	{					
		$font_families = array();
		
			if ( 'off' !== $Montserrat ) 
			{
				$font_families[] = 'Montserrat:100,200,300,400,500,600,700,800,900';
			}
			if ( 'off' !== $open_sans ) 
			{
				$font_families[] = 'Open Sans:300,400,600,700,800';
			}
			if ( 'off' !== $Lato ) 
			{
				$font_families[] = 'Lato:100,300,400,700,900';
			}
			if ( 'off' !== $poppins ) 
			{
				$font_families[] = 'Poppins:100,300,400,700,900';
			}
			
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' )
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
function tmc_scripts_styles() 
{
	wp_enqueue_style( 'fonts', tmc_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'tmc_scripts_styles' );
if( ! function_exists( 'tmc_body_class' ) ) {
	function tmc_body_class( $classes ) {
		
		global $tmc_option;
		$classes[] = tmc_get_header_style();
		if(is_page('maintenance'))
		{
			$classes[] = 'maintenance-body';
		}if(is_page('coming-soon'))
		{
			$classes[] = 'yellow-body';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'tmc_body_class' );
define( 'TMC_INC_PATH', get_template_directory() . '/inc' );
require_once( TMC_INC_PATH . '/tgm/tgm-plugin-registration.php' );
require_once( TMC_INC_PATH . '/theme-essential.php' );
if(get_option('tmc_page_builder') == 'wpbak')
{
	require_once( TMC_INC_PATH . '/visual-composer.php' );
}
function tmc_activate() {
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
		wp_redirect(admin_url('themes.php?page=tmc-theme-activate'));
		exit;
	}
}
add_action('after_setup_theme', 'tmc_activate', 11);
/************************************************************************
* Customize Button of Comment Form
*************************************************************************/
function tmc_form_submit_button($button) {
$button ='<div class="form-field"><input type="submit" value="Submit now" class="form-submit-btn"></div><p>';
return $button;
}
add_filter('comment_form_submit_button', 'tmc_form_submit_button');
	//add_action( 'after_setup_theme', 'tmc_woocommerce_setup' );
	function tmc_woocommerce_setup()
	{
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
	add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // < 2.1
	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +
  
	function woo_custom_product_add_to_cart_text() {
		return __( 'BUY NOW', 'indofact' );
	}
function limit_words($string, $word_limit) {
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
	return implode(' ', array_slice($words, 0, $word_limit)).'..';
}
	function tmc_theme_style() {
		wp_enqueue_style( 'indofact-activate', get_template_directory_uri() . '/assets/css/theme-style.css', null, null, 'all' );
	}
	add_action( 'admin_enqueue_scripts', 'tmc_theme_style' );
	add_action('admin_menu', 'tmc_check_theme_activate');
	function tmc_check_theme_activate()
	{
		add_theme_page(esc_attr__( 'Theme Activate','indofact' ), esc_attr__( 'Theme Activate','indofact' ), 'activate_plugins', 'tmc-theme-activate', 'tmc_theme_activate');
	}
	if ( ! function_exists( 'wp_body_open' ) ) {
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
	}
/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );
/**
 * Change number or products per row 
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		global $tmc_option;	
		$layout_col = 3;
		
		if(function_exists( 'tmc_data_option' ) && class_exists( 'Redux' ))
		{
			if(is_array($tmc_option))
			{
				if($tmc_option['select_woocommercecolumns'] == 'columns-2'){
					$layout_col = 2;
				}
				elseif($tmc_option['select_woocommercecolumns'] == 'columns-4'){
					$layout_col = 4;
				}else{
					$layout_col = 3;
				}
			}
		}
		return $layout_col; // 3 products per row
	}
}

// removing href to the team
function my_inline_script() {
    ?>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var links = document.querySelectorAll('.single_team4>a');
        links.forEach(function(link) {
            link.removeAttribute('href');
        });
		var links = document.querySelectorAll('.team4_content>a');
		links.forEach(function(link) {
            link.removeAttribute('href');
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'my_inline_script');