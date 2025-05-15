<?php
	$atts = vc_map_get_attributes( 'tmc_contact_info', $atts );
	extract ($atts);
	$output = '';
	if($layout == 'img_text')
	{
		$output .='	<div class="row '.esc_attr($el_class).'">';
						if($add_title || $add_text)
						{	
							$output .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 contact-info-column text-center">
											<img src="'.wp_get_attachment_url($add_image).'" alt="address-icon">
											<h4>'.esc_attr($add_title).'</h4>
											<p class="fnt-17">'.esc_attr($add_text).'</p>
										</div>';
						}
						if($phn_text || $phn_text_two)
						{
							$output .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  contact-info-column text-center">
											<img src="'.wp_get_attachment_url($phn_image).'" alt="phone-icon">
											<h4>'.esc_attr($phn_title).'</h4>
											<p class="fnt-17">'.esc_attr($phn_text).'<br/> '.esc_attr($phn_text_two).'</p>
										</div>';
						}
						if($eml_text || $eml_text_two)
						{
							$output .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  contact-info-column text-center">
											<img src="'.wp_get_attachment_url($eml_image).'" alt="message-icon">
											<h4>'.esc_attr($eml_title).'</h4>
											<p class="fnt-17">'.esc_attr($eml_text).'<br/> '.esc_attr($eml_text_two).'</p>
										</div>';
						}	
		$output .='</div>';
	}
	wp_reset_postdata();
	echo translate($output);
?>