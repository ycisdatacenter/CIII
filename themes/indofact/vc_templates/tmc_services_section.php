<?php
	$atts = vc_map_get_attributes( 'tmc_services_section', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
	$output .='<div class="service_section1">
					<div class="row">
						<div class="col-md-8">
							<img src="'.wp_get_attachment_url($image).'" alt="'.esc_attr($title).'" class="img-responsive">
						</div>
						<div class="col-md-4">
							<div class="right_sec">
								<i class="fa fa-quote-left"></i>
								<div class="simple-text">
								'.wp_kses_post($content).'
								</div>
								<i class="fa fa-quote-right"></i>
								<h5><i class="fa fa-minus"></i> '.esc_attr($title).'</h5>
							</div>
						</div>
					</div>
				 </div>';
	wp_reset_postdata();
	echo translate($output);
?>