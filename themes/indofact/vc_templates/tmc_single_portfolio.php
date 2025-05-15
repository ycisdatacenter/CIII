<?php
	$atts = vc_map_get_attributes( 'tmc_single_portfolio', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
	if($layout == 'img_text')
	{
		$output .='	<div class="row">
						<div class="marbtm50 wdt-100 '.esc_attr($el_class).'">
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
								<span class="portfolio-img-column image_hover">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
								</span>
							</div>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 project-desc">
								<h3 class="marbtm30">'.esc_attr($title).'</h3>
								'.wp_kses_post($content).'
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'project_details')
	{
		$fbLink = vc_build_link($fb_link);
		$twLink = vc_build_link($tw_link);
		$gpLink = vc_build_link($gp_link);
		$lkLink = vc_build_link($lk_link);
		$output .= '<div class="row">
						<div class="col-md-12 marbtm50 wdt-100">
							<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 black-portfolio-left">
								<ul>
									<li>
										<span class="colleft">'.esc_attr($client_txt).'</span>
										<span class="colrght">'.esc_attr($client_nme).'</span>
									</li>
									<li>
										<span class="colleft">'.esc_attr($skill_txt).' </span>
										<span class="colrght">'.esc_attr($skill_nme).'</span>
									</li>
									<li>
										<span class="colleft">'.esc_attr($web_txt).'</span>
										<span class="colrght">'.esc_attr($web_nme).'</span>
									</li>
									<li>
										<span class="colleft">Share</span>
										<span class="colrght">
											<span class="header-socials portfolio-socials">';
												if($fbLink['url']):
													$output .= '<a href="'.esc_attr($fbLink['url']).'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
												endif;
												if($twLink['url']):
													$output .= '<a href="'.esc_attr($twLink['url']).'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
												endif;
												if($gpLink['url']):
													$output .= '<a href="'.esc_attr($gpLink['url']).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
												endif;
												if($lkLink['url']):	
													$output .= '<a href="'.esc_attr($lkLink['url']).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>'; 
												endif;
								$output .= '</span>
										</span>
									</li>
								</ul>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 portfolio-info-column">
								<ul>
									<li>
										<h4>'.esc_attr($srt_date_txt).'</h4>
										<p>'.esc_attr($srt_date).'</p>
									</li>
									<li>
										<h4>'.esc_attr($end_date_txt).'</h4>
										<p>'.esc_attr($end_date).'</p>
									</li>
									<li>
										<h4>'.esc_attr($cat_txt).'</h4>
										<p>'.esc_attr($cat_nme).'</p>
									</li>
								</ul>
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'title_text')
	{
		$output .= '<div class="row">
						<div class="col-md-12 marbtm50 wdt-100 '.esc_attr($el_class).'">
							<h4>'.esc_attr($title).'</h4>
							'.wp_kses_post($content).'
						</div>
					</div>';
	}
	elseif($layout == 'info_image')
	{
		$output .= '<div class="row">
						<div class="wdt-100 '.esc_attr($el_class).'">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="blog-graylist portfoli-scope">
									<h4>'.esc_attr($title).'</h4>
									'.wp_kses_post($content).'
									<ul>
										<li>'.esc_attr($line_one).'</li>
										<li>'.esc_attr($line_two).'</li>
										<li>'.esc_attr($line_three).'</li>
										<li>'.esc_attr($line_four).'</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<span class="scope-img image_hover ">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="work-scope-image">
								</span>
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'info_left_image')
	{
		$output .= '<div class="row">
						<div class="wdt-100 '.esc_attr($el_class).'">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<span class="scope-img image_hover ">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="work-scope-image">
								</span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="blog-graylist portfoli-scope">
									<h4>'.esc_attr($title).'</h4>
									'.wp_kses_post($content).'
									<ul>
										<li>'.esc_attr($line_one).'</li>
										<li>'.esc_attr($line_two).'</li>
										<li>'.esc_attr($line_three).'</li>
										<li>'.esc_attr($line_four).'</li>
									</ul>
								</div>
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'single_img')
	{
		$output .= '<div class="row">
						<div class="wdt-100 '.esc_attr($el_class).'">
							<div class="col-md-12">
								<span class="portfolio-img-column image_hover">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
								</span>
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'title_text_bold')
	{
		$output .= '<div class="row">
						<div class="col-md-12 marbtm50 wdt-100 '.esc_attr($el_class).'">
							<h3 class="marbtm30">'.esc_attr($title).'</h3>
							'.wp_kses_post($content).'
						</div>
					</div>';
	}
	elseif($layout == 'rgt_img_text')
	{
		$output .= '<div class="row">
						<div class="wdt-100 marbtm50 '.esc_attr($el_class).'">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<h3 class="marbtm30">'.esc_attr($title).'</h3>
								'.wp_kses_post($content).'
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<span class="scope-img image_hover">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
								</span>
							</div>
						</div>
					</div>';
	}
	elseif($layout == 'rgt_image_text')
	{
		$output .= '<div class="row">
						<div class="marbtm50 wdt-100 '.esc_attr($el_class).'">
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 project-desc1">
								<h3 class="marbtm30">'.esc_attr($title).'</h3>
								'.wp_kses_post($content).'
							</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
								<span class="portfolio-img-column image_hover">
									<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
								</span>
							</div>
						</div>
					</div>';
	}
	wp_reset_postdata();
	echo translate($output);
?>