<?php
	$atts = vc_map_get_attributes( 'tmc_brochure_button', $atts );
	extract( $atts );
	$output = '';
	$link =  wp_get_attachment_url($btnlink); 
	if(!$link)$link = '#';	
	if ( $btntitle ) :
		$output ='<a class="pdf-button" href="'.esc_url($link).'"  style="background:url('.wp_get_attachment_url($image).') no-repeat 0px 0px;">'.esc_attr($btntitle).'</a>';
		else:
		$output .= esc_html__('Sorry, there is no button.', 'indofact');
	endif;	
	wp_reset_postdata();
	echo translate($output);
?>