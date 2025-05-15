<?php
	$atts = vc_map_get_attributes( 'tmc_maintenance', $atts );
	extract( $atts ); 
	global $tmc_option;
	$output .= '<div class=" container maintenance-container">
					<div class="maintenance-section">
						
						<span class="maintenance-img">
							<img src="'.esc_url($tmc_option['maintenance_img']['url']).'" alt="Maintenance-image">
						</span>	
					</div>
				</div>
				<div class="maintenance-desc">
							<span class="subhead">'.esc_attr($tmc_option['maintenance_subtitle']).'</span>
						</div>';
				if(isset($tmc_option['maintenance_footer_switch']) && $tmc_option['maintenance_footer_switch'] == '1')
				{
					$output .= '<div class="maintenance-footer">
									'.esc_attr($tmc_option['maintenance_footer_text']).'
								</div>';
				}
	wp_reset_postdata();
	echo translate($output);
?>