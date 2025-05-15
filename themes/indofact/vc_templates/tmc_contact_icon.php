<?php
	$atts = vc_map_get_attributes( 'tmc_contact_icon', $atts );
	extract ($atts);
	$output = '';
	$output .='<div class="contact_gap text-center wdt-100 '.esc_attr($container_class).'">
            <div class="header-socials header2-socials contact-social"> 
			   <a href="'.esc_attr($url1).'"><i class="fa '.esc_attr($icon1).'" aria-hidden="true"></i></a>
               <a href="'.esc_attr($url2).'"><i class="fa '.esc_attr($icon2).'" aria-hidden="true"></i></a> 
               <a href="'.esc_attr($url3).'"><i class="fa '.esc_attr($icon3).'" aria-hidden="true"></i></a> 
               <a href="'.esc_attr($url4).'"><i class="fa '.esc_attr($icon4).'" aria-hidden="true"></i></a> 
            </div>
         </div>';
	wp_reset_postdata();
	echo translate($output);
?>