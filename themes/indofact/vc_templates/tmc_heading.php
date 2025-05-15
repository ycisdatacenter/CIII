<?php
	$atts = vc_map_get_attributes( 'tmc_heading', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
	if($layout == 'style_one')
	{
		$output .='<div class="'.esc_attr($container_class).'">
						<'.esc_attr($tag).' class="'.esc_attr($el_class).'">'.esc_attr($title).'</'.esc_attr($tag).'>
					</div>';
	}
	elseif($layout == 'style_two')
	{
		$output .='';
	}
	wp_reset_postdata();
	echo translate($output);
?>