<?php
/*
=== One Click Demo Import ===
Contributors: smub, proteusthemes
Tags: import, content, demo, data, widgets, settings, redux, theme options
Requires at least: 4.0.0
Tested up to: 5.2.2
Stable tag: 2.5.2
License: GPLv3 or later

/* What about using local import files (from theme folder)? =
You have to use the same filter as in above example, but with a slightly different array keys: `local_*`. The values have to be absolute paths (not URLs) to your import files. To use local import files, that reside in your theme folder, please use the below code. Note: make sure your import files are readable!
*/

function ocdi_import_files()
{
	$demo_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) ); 
	$demo_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $demo_dir ) );
	
	return array(
		array(
			'import_file_name'             => 'Indofact',
			'local_import_file'            => $demo_dir.'demo-data/demo/content.xml',
			'local_import_widget_file'     => $demo_dir.'demo-data/demo/widgets.json',
			'local_import_redux'           => array(
				array(
					'file_path'   => $demo_dir.'demo-data/demo/theme-options.json',
					'option_name' => 'tmc_option',
				),
			),
			'import_preview_image_url'     => $demo_url.'demo-data/demo/screen-image.png',
			'import_notice'                => __( 'Import process may take several minutes depending on the network. if you face any problem. Please contact our <a href="https://support.themechampion.com" target="_blank">Support</a>', 'indofact' ),
			'preview_url'                  => $demo_url,
		),

	);
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

/*

You can set content import, widgets, customizer and Redux framework import files. You can also define a preview image, which will be used only when multiple demo imports are defined, so that the user will see the difference between imports.

Categories can be assigned to each demo import, so that they can be filtered easily. The preview URL will display the "Preview" button in the predefined demo item, which will open this URL in a new tab and user can view how the demo site looks like.

= How to automatically assign "Front page", "Posts page" and menu locations after the importer is done? =

You can do that, with the `pt-ocdi/after_import` action hook. The code would look something like this:

*/
function ocdi_after_import_setup() {
	
	$demo_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
	$demo_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $demo_dir ) );
	
	// Assign menus to their locations.

	$main_menu = get_term_by('name', 'Primary', 'nav_menu');
    $footerone_menu = get_term_by('name', 'Footer One', 'nav_menu');
    $footertwo_menu = get_term_by('name', 'Footer Two', 'nav_menu');
    $service_menu = get_term_by('name', 'Service', 'nav_menu');
	
    set_theme_mod( 'nav_menu_locations' , array( 
              'tmc-primary' => $main_menu->term_id, 
              'tmc-footer-one' => $footerone_menu->term_id,
              'tmc-footer-two' => $footertwo_menu->term_id,
              'tmc-service' => $service_menu->term_id,
             )
    );			 
	
	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	
	
	 //Import Revolution Slider
       if ( class_exists( 'RevSlider' ) )
	   {
           $slider_array = array(
              $demo_dir."demo-data/demo/home1.zip",
              $demo_dir."demo-data/demo/home2.zip",
              $demo_dir."demo-data/demo/home3.zip",
              $demo_dir."demo-data/demo/home4.zip",
              $demo_dir."demo-data/demo/home5.zip",
              $demo_dir."demo-data/demo/home6.zip",
              $demo_dir."demo-data/demo/home7.zip",
              $demo_dir."demo-data/demo/home8.zip",
			  $demo_dir."demo-data/demo/home9.zip",
              $demo_dir."demo-data/demo/home10.zip"
              );

           $slider = new RevSlider();
       
           foreach($slider_array as $filepath){
             $slider->importSliderFromPost(true,true,$filepath);  
           }
           echo ' Slider processed';
      }
	
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );


/*
= How can I disable the ProteusThemes branding notice after successful demo import? =
You can disable the branding notice with a WP filter. All you need to do is add this bit of code to your theme:
*/

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//and the notice will not be displayed.

?>