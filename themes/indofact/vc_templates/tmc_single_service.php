<?php
	$atts = vc_map_get_attributes( 'tmc_single_service', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
	if($layout == 'img_text')
	{
		$output .='<div class="service-right-desc '.esc_attr($el_class).'">
						<span class="image_hover ">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="manufacture-image">
						</span>
						<h5>'.esc_attr($title).'</h5>
						'.wp_kses_post($content).'
					</div>';
	}
	if($layout == 'img_text_two')
	{
		$ImageAlign = '';
		$TextAlign  = '';
		if($image_align == 'right')
		{
			$ImageAlign = 'chemical-special-img';
			$TextAlign  = 'chemical-special-txt';
		}
		$output .='<div class="specialization-cl '.esc_attr($el_class).'">
						<div class="special-img image_hover '.esc_attr($ImageAlign).'">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="special-image">
						</div>
						<div class="special-text '.esc_attr($TextAlign).'">
							<h3>'.esc_attr($title).'</h3>
							'.wp_kses_post($content).'
						</div>
					</div>';
	}
	elseif($layout == 'two_img_text')
	{
		$output .='	<div class="service-right-desc">
                    	<div class="wdt-100">
							<div class="cnc-img">
								<span class="image_hover ">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="cnc-image">
								</span>
							</div>
							<div class="cnc-img cnc-img2">
								<span class="image_hover ">
									<img src="'.wp_get_attachment_url($image_two).'" class="img-responsive zoom_img_effect" alt="cnc-image">
								</span>
							</div>
                        </div>
						<h5>'.esc_attr($title).'</h5>
						'.wp_kses_post($content).'
					</div>';
	}
	elseif($layout == 'heading_text')
	{
		$output .='	<div class="specialization-cl">
						<div class="special-text project-mission">
							<h3>'.esc_attr($title).'</h3>
							'.wp_kses_post($content).'
						</div>
                    </div>';
	}
	elseif($layout == 'any_question')
	{
		$Link = vc_build_link($link);
		$output .='	<div class="have-queston '.esc_attr($el_class).'">
						'.wp_kses_post($content).'
						<h3>'.esc_attr($title).'</h3>
						<a data-animation="animated fadeInUp" class="header-requestbtn black-request-btn hvr-bounce-to-right" href="'.esc_attr($Link['url']).'">'.esc_attr($Link['title']).'</a>
					</div>';
	}
	wp_reset_postdata();
	echo translate($output);
?>