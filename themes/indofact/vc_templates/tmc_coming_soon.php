<?php
	$atts = vc_map_get_attributes( 'tmc_coming_soon', $atts );
	extract( $atts ); 
	global $tmc_option;
	$content 	= wpb_js_remove_wpautop($content, true);
	$near_date 	= esc_attr($tmc_option['date_near']);
	if($near_date == '')
	{
		$near_date = '12/31/2020';
	}
		
	$coming_logo = get_template_directory_uri() .'/assets/images/tmp/black-logo.png';
	$time_now=mktime(date('H')+5,date('i')+30,date('s'));
	$currentDate = date('m/d/Y H:i:s', $time_now);
	
	 $start_date = new DateTime($currentDate);
	 $since_start = $start_date->diff(new DateTime($near_date));
	 $totalDays = $since_start->days;
	 $year = $since_start->y;
	 $month = $since_start->m;
	 $days = $since_start->d;
	 $hours = $since_start->h;
	 $minutes = $since_start->i;
	 $seconds = $since_start->s;
	
	$output .= '<div class="comingsoon-page">
					<a class="logo" href="'.home_url( '/' ).'">';
						if (isset($tmc_option['coming_logo']['url'] )):
							$output .= '<img src="'.esc_url($tmc_option['coming_logo']['url']).'" class="img-responsive" alt="logo-image">';
						elseif($logo ) :
							$output .= '<img src="'.esc_url( $coming_logo ).'" class="img-responsive" alt="logo-image">';
						endif;
		$output .= '</a>
					<h2>'.esc_attr($tmc_option['coming_title']).' </h2>';
						if(isset($tmc_option['timer_switch']) && $tmc_option['timer_switch'] == '1')
						{
							$output .= '<ul id="clockdiv" class="coming-list">
									<li>
										<span class="number day">'.esc_attr($totalDays).'</span>
										<span class="days">'.esc_attr($tmc_option['timer_day_text']).'</span>
									</li>
									<li>
										<span class="number hour">'.esc_attr($hours).'</span>
										<span class="days">'.esc_attr($tmc_option['timer_hour_text']).'</span>
									</li>
									<li>
										<span class="number minute">'.esc_attr($minutes).'</span>
										<span class="days">'.esc_attr($tmc_option['timer_min_text']).'</span>
									</li>
									<li>
										<span class="number second">'.esc_attr($seconds).'</span>
										<span class="days">'.esc_attr($tmc_option['timer_sec_text']).'</span>
									</li>
								</ul>
								
					   <a data-animation="animated fadeInUp" class="header-requestbtn learn-more-btn home-link hvr-bounce-to-right" href="'.esc_url(get_permalink($tmc_option['btn_name_link'])).'">'.esc_attr($tmc_option['Btn_name_comm']).'</a>';
						}
						$output .= '</div>';
	wp_reset_postdata();
	echo translate($output);
?>