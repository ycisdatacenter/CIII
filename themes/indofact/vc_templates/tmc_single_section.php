<?php
	$atts = vc_map_get_attributes( 'tmc_single_section', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);

	if($layout == 'heading_text')
	{
		$output .='<div class="head-section wdt-100 '.esc_attr($el_class).'">
						<div class="col-lg-5 col-md-6 col-sm-4 col-xs-12">
							<h3>'.esc_attr($title).'</h3>
						</div>
						<div class="col-lg-7 col-md-6 col-sm-8 col-xs-12">
						'.wp_kses_post($content).'
						</div>
					</div>';
	}
	elseif($layout == 'heading_image')
	{
		$output .='<section class="bestthing-section '.esc_attr($el_class).'">
						<div class="container">
							<div class="row ">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bestthing-text-column">
									<h2>'.esc_attr($title).' 
									<span>'.esc_attr($title_two).'</span></h2>
									'.wp_kses_post($content).'
								</div>
							</div>
						</div>
						<div class="bestthing-img">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive" alt="wordpress-image">
						</div>
					</section>';
	}
	elseif($layout == 'bold_headng_image')
	{
		$output .='	<section class="hight-level-section '.esc_attr($el_class).'">
						<div class="container">
							<div class="row">
								<div class="col-md-12 text-center">
									<h2>'.esc_attr($title).' <span>'.esc_attr($title_two).'</span> '.esc_attr($title_three).'</h2>
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12 col-xs-12">
								'.wp_kses_post($content).'
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12 col-xs-12 text-center">
								<ul class="icon_size">';
									if($layout_one == 'Vision_icon')
									{
									$output .='
									 <li class="vision-icon"><i class="fa '.esc_attr($vis_icon).'"></i>'.esc_attr($line_one).'</li>';
									}
									else
									{
								 $output .='<li class="vision-icon home2_icon" style="background-image:url('.wp_get_attachment_url($vis_image).');">'.esc_attr($line_one).'</li>';
									 }
									if($layout_second == 'Values_icon')
									{
									$output .=' <li class="value-icon"><i class="fa '.esc_attr($val_icon).'"></i>'.esc_attr($line_two).'</li>';
									}
									else
									{
									$output .='<li class="value-icon home2_icon" style="background-image:url('.wp_get_attachment_url($val_image).');">'.esc_attr($line_two).'</li>';
									}
									if($layout_third == 'Mission_icon')
									{
									$output .='<li class="mission-icon"><i class="fa '.esc_attr($mis_icon).'"></i> '.esc_attr($line_three).'</li>';
									}
									else
									{
									$output .='<li class="mission-icon home2_icon" style="background-image:url('.wp_get_attachment_url($mis_image).');">'.esc_attr($line_three).'</li>';	
									}
								$output .='</ul></div>
							</div>
						</div>
					</section>';
	}
	elseif($layout == 'heading_text_two')
	{
		$output .='	<div class="head-section '.esc_attr($el_class).'">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<h3>'.esc_attr($title).'</h3>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							'.wp_kses_post($content).'
						</div>
					</div>';
	}
	elseif($layout == 'company_history')
	{
		$output .='	<div class="history-list text-center '.esc_attr($el_class).'">
						<span class="top-img">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive" alt="humble-image">
						</span>
						<div class="history-list-middle">
							<div class="white-circle">
								<div class="white-circle-border">
									<div class="yellow-circle">'.esc_attr($year).'</div>
								</div>
							</div>
							<span class="year-circle"></span>
						 </div>
						<h5>'.esc_attr($title).'</h5>
						'.wp_kses_post($content).'
					</div>';
	}
	elseif($layout == 'static')
	{
		$output .='	<section class="static-section stats'.esc_attr($el_class).'">
						<div class="container">
							<div class="row">
								<div class="col-md-12 text-center">
									<h2><span>'.esc_attr($title).'</span></h2>
									'.wp_kses_post($content).'
								</div>
								<ul>
									<li>
										<h2 class="counter">'.esc_attr($number).'</h2>
										<p> '.esc_attr($line_one).'</p>
									</li>
									<li>
										<h2 class="counter">'.esc_attr($number_two).'</h2>
										<p> '.esc_attr($line_two).'</p>
									</li>
									<li>
										<h2 class="counter">'.esc_attr($number_three).'</h2>
										<p> '.esc_attr($line_three).'</p>
									</li>
									<li>
										<h2 class="counter">'.esc_attr($number_four).'</h2>
										<p> '.esc_attr($line_four).'</p>
									</li>
								</ul>
							</div>
						</div>
					</section>';
	}
	elseif($layout == 'need_support')
	{
		$output .='	<div class="wdt-100 marbtm50 '.esc_attr($el_class).'">
						<h3 class="marbtm30">'.esc_attr($title).'</h3>
						'.wp_kses_post($content).'
					</div>';
	}
	elseif($layout == 'contact_help')
	{
		$output .='	<div class="contact-help '.esc_attr($el_class).'"  style="background-image:url('.wp_get_attachment_url($image).');">
						<h4>'.esc_attr($title).'</h4>
						'.wp_kses_post($content).'
					</div>';
	}
	elseif($layout == 'contact_help_two')
	{
		$output .='<div class="contact-help '.esc_attr($el_class).'" style="background-image:url('.wp_get_attachment_url($image).'); --background-image-call:url('.wp_get_attachment_url($image_two).')">
                    	 <div class="office-info-col wdt-100">
                    	<h4>'.esc_attr($title).'</h4>                       
                        <ul class="office-information">
                        	<li class="'.esc_attr($icon_one).'">
                            <span class="info-txt">'.esc_attr($line_one).'</span>
                            </li>
                            <li class="'.esc_attr($icon_two).'">
                            <span class="info-txt fnt_17">'.esc_attr($line_two).'</span>
                            </li>
                            <li class="'.esc_attr($icon_three).'">
                            <span class="info-txt fnt_17">'.esc_attr($line_three).'</span>
                            </li>
                        </ul>                       
                    </div>
                    </div>';
	}
	elseif($layout == 'who_we_are')
	{
		$varlink = vc_build_link($whowrlink);
		$output .='<div class="whowearelay1"><h3 class="'.esc_attr($head_class).'">'.esc_attr($title).'</h3>
                    <span class="image_hover wdt-100 img marbtm30">
               	    <img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="whoare-image">
                    </span>
                    <p class="fnt-17">'.esc_attr($content_two).'</p>
                    <a data-animation="animated fadeInUp" class="header-requestbtn black-request-btn hvr-bounce-to-right" href="'.esc_attr($varlink['url']).'">'.esc_attr($varlink['title']).'</a></div>';
	}
	elseif($layout == 'bestthing_in_wordpress')
	{
		$output .='<section class="'.esc_attr($el_class).'">
						<div class="container">
							<div class="row ">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bestthing-text-column">
									<h2>
										'.esc_attr($title).'
										<span>'.esc_attr($title_two).'</span>
									</h2>
									<p class="fnt-17">'.esc_attr($description_one).'</p>
								</div>							
							</div>
						</div>						
					</section>';
	}
	elseif($layout == 'who_we_are_two')
	{
		$varlink = vc_build_link($whowrlink);
		$output .='<div class="row '.esc_attr($el_class).'">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 img">
							<span class="image_hover">
								<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="about-image">
							</span>
						</div>						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 martop30">
							<h3>'.esc_attr($title).'</h3>
							<p class="fnt-17">'.esc_attr($content_two).'</p>
							<a data-animation="animated fadeInUp" class="header-requestbtn more-infobtn hvr-bounce-to-right" href="'.esc_attr($varlink['url']).'">'.esc_attr($varlink['title']).'</a>
						</div>						
					</div>';
	}

	elseif($layout == 'who_we_are_three')
	{
		$varlink = vc_build_link($whowrlink);
		$output .='<div class="row '.esc_attr($el_class).'">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="whowearethree-paragraph" style="background-color:'.esc_attr($whoweare_back_color).';">
								<h3>'.esc_attr($title).'</h3>
								<p class="fnt-17">'.esc_attr($content_two).'</p>
								<a class="whowearethree" href="'.esc_attr($varlink['url']).'">'.esc_attr($varlink['title']).'</a>
							</div>						
						</div>
					</div>';			
	}

	elseif($layout == 'static_two')
	{
		$output .='<section class="static-section home3-static stats'.esc_attr($el_class).'">
						<div class="container">
							<div class="row">							
								<ul>
									<li>
										<h4 class="counter">'.esc_attr($number).'</h4>
										<p> '.esc_attr($line_one).'</p>
									</li>
									<li>
										<h4 class="counter">'.esc_attr($number_two).'</h4>
										<p> '.esc_attr($line_two).'</p>
									</li>
									<li>
										<h4 class="counter">'.esc_attr($number_three).'</h4>
										<p> '.esc_attr($line_three).'</p>
									</li>
									<li>
										<h4 class="counter">'.esc_attr($number_four).'</h4>
										<p> '.esc_attr($line_four).'</p>
									</li>
								</ul>
							</div>							
						</div>
					</section>';
	}
	elseif($layout == 'certifield_section')
	{
		$varlink = vc_build_link($whowrlink);
		$output .='<section class="certifield-section stats'.esc_attr($el_class).'">
					<div class="container">
						<h4 class="won-txt">'.esc_attr($description_one).'</h4>
						<a data-animation="animated fadeInUp" class="header-requestbtn contactus-btn more-info hvr-bounce-to-right" href="'.$varlink['url'].'">'.$varlink['title'].'</a>
						
					</div>
				</section>';
	}
	elseif($layout == 'bestthing_in_wordpress_two')
	{
		$output .='<div class="bestthing-text-column home4-bestthing-txt '.esc_attr($el_class).'">
							<h2>'.esc_attr($title).' 
					<span>'.esc_attr($title_two).'</span></h2>
							<p class="fnt-17">'.esc_attr($description_one).'</p>
							</div>';
	}
	elseif($layout == 'static_three')
	{
		$output .='<div class="'.esc_attr($static_class).'">							
						<ul>
							<li>
								<h2 class="counter">'.esc_attr($number).'</h2>
								<p> '.esc_attr($line_one).'</p>
							</li>
							<li>
								<h2 class="counter">'.esc_attr($number_two).'</h2>
								<p> '.esc_attr($line_two).'</p>
							</li>
							<li>
								<h2 class="counter">'.esc_attr($number_three).'</h2>
								<p> '.esc_attr($line_three).'</p>
							</li>
							<li>
								<h2 class="counter">'.esc_attr($number_four).'</h2>
								<p> '.esc_attr($line_four).'</p>
							</li>
						</ul>
					</div>';
	}
	elseif($layout == 'project_agri_one')
	{
		$output .='<div class="marbtm50 wdt-100 '.esc_attr($el_class).'">
						<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
							<span class="portfolio-img-column image_hover">
								<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
							</span>
						</div>
						<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 project-desc">
							<h3 class="marbtm30">'.esc_attr($title).'</h3>
							<p class="fnt-17 marbtm30"><strong>'.esc_attr($sub_title).'</strong></p>
							<p>'.wp_kses_post($content).'</p>
						</div>
					</div>';
	}
	elseif($layout == 'project_agri_three')
	{
		$output .=' <div class="col-md-12 marbtm50 wdt-100">
                    	<h4>'.esc_attr($title).'</h4>
                        <p class="mar-btm20">'.wp_kses_post($content).'</p>
                    </div>';
	}
	elseif($layout == 'project_elect_one')
	{
		$output .='<div class="wdt-100  '.esc_attr($el_class).'">
						<div class="col-md-12">
							<span class="portfolio-img-column image_hover">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
							</span>
						</div>						
					</div>';
	}
	elseif($layout == 'project_elect_three')
	{
		$output .='  <div class="col-md-12 marbtm50 wdt-100 '.esc_attr($el_class).'">
                    	<h3 class="marbtm30">'.esc_attr($title).'</h3>
                        <p class="fnt-17 mar-btm20"><strong>'.esc_attr($sub_title).'</strong> </p>
                        <p class="mar-btm20">'.wp_kses_post($content).'</p>                      
                    </div>';
	}
	elseif($layout == 'project_factory_three')
	{
		$output .='<div class="wdt-100 marbtm50 '.esc_attr($el_class).'">                     	
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="marbtm30">'.esc_attr($title).'</h3>
							<p class="fnt-17 mar-btm20"><strong>'.esc_attr($sub_title).'</strong> </p>
							<p class="mar-btm20">'.wp_kses_post($content).'</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<span class="scope-img image_hover">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
							</span>
						</div>
					</div>';
	}
	elseif($layout == 'project_gas_one')
	{
		$output .='<div class="marbtm50 wdt-100 '.esc_attr($el_class).'">
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 project-desc1">
                	<h3 class="marbtm30">'.esc_attr($title).'</h3>
                    <p class="fnt-17 marbtm30"><strong>'.esc_attr($sub_title).'</strong></p>
                    <p>'.wp_kses_post($content).'</p>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                	<span class="portfolio-img-column image_hover">
               	    <img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
                    </span>
                </div>
            	
                
                </div>';
	}
	elseif($layout == 'about_left')
	{
		$varlink = vc_build_link($whowrlink);
		$output .='<h3 class="marbtm30">'.esc_attr($title).'</h3>                   
					<div class="fnt-17">'.wp_kses_post($content).'</div>
					<div class="row">
						<div class="col-md-6">
							<ul>
								<li><i class="fa '.esc_attr($icon_one).'"></i> '.esc_attr($line_one).'</li>
								<li><i class="fa '.esc_attr($icon_two).'"></i> '.esc_attr($line_two).'</li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul>
								<li><i class="fa '.esc_attr($icon_three).'"></i> '.esc_attr($line_three).'</li>
								<li><i class="fa '.esc_attr($icon_four).'"></i> '.esc_attr($line_four).'</li>
							</ul>
						</div>
					</div>
                    <a data-animation="animated fadeInUp" class="aboutleft-requestbtn more-infobtn hvr-bounce-to-right" href="'.esc_attr($varlink['url']).'">'.esc_attr($varlink['title']).'</a>';
	}
	wp_reset_postdata();
	echo translate($output);
?>