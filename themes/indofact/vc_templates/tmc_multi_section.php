<?php
	$atts = vc_map_get_attributes( 'tmc_multi_section', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
	if($layout == 'why_choose_us')
	{
		$output .='<section>
         <div class="container">
            <div class="row ">
               <div class="head-section wdt-100">
                  <div class="col-lg-5 col-md-6 col-sm-4 col-xs-12">
                     <h3>'.esc_attr($title).'</h3>
                  </div>
                  <div class="col-lg-7 col-md-6 col-sm-8 col-xs-12 fnt-18">'.wp_kses_post($content).'</div>
               </div>
               <div class="col-md-12">
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes">
                     <i class="'.esc_attr($whychooseus_box1_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box1_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box1_text).'</p>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes" style="border-left: 1px solid;">
                   <i class="'.esc_attr($whychooseus_box2_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box2_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box2_text).'</p>
                      
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes" style="border-left: 1px solid;">
                       <i class="'.esc_attr($whychooseus_box3_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box3_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box3_text).'</p>
                      
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes">
                      <i class="'.esc_attr($whychooseus_box4_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box4_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box4_text).'</p>
                     
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes" style="border-left: 1px solid;">
                     <i class="'.esc_attr($whychooseus_box5_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box5_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box5_text).'</p>
          
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 aboutus-whychoose-boxes" style="border-left: 1px solid;"> 
                     <i class="'.esc_attr($whychooseus_box6_icon).' whychooseus-box-icons"></i>
                     <div class="whychoose-boxes">
                        <h5>'.esc_attr($whychooseus_box6_title).'</h5>
                        <p class="line-height26 marbtm20">'.wp_kses_post($whychooseus_box6_text).'
                        </p>
                    
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>';
	}
	elseif($layout == 'why_choose_us_two')
	{
		$output .='<h3>'.esc_attr($title).'</h3>
                    <ul class="whychoose-list">
                    	<li class="" style="background: url('.wp_get_attachment_url($image).') no-repeat 10px 0px;">
                        	<h4>'.esc_attr($line_one).'</h4>
                            <p class="line-height26">'.esc_attr($desc_one).'</p>
                        </li>
                        <li class="" style="background: url('.wp_get_attachment_url($image_two).') no-repeat 10px 0px;">
                        	<h4>'.esc_attr($line_two).'</h4>
                            <p class="line-height26">'.esc_attr($desc_two).'</p>
                        </li>
                        <li class="" style="background: url('.wp_get_attachment_url($image_three).') no-repeat 10px 0px;">
                        	<h4>'.esc_attr($line_three).'</h4>
                            <p class="line-height26">'.esc_attr($desc_three).'</p>
                        </li>
                    </ul>';
	}
	elseif($layout == 'box_column')
	{
		$output .='<div class="boxes-column '.esc_attr($el_class).'">
						<ul>
							<li>
								<span class="boxes-icons">
								<img src="'.wp_get_attachment_url($image).'" alt="team-icon"> </span>
								<div class="boxes-desc">
									<h4>'.esc_attr($line_one).'</h4>
									<p>'.esc_attr($desc_one).'</p>
								</div>
							</li>
							<li>
								<span class="boxes-icons">
								<img src="'.wp_get_attachment_url($image_two).'" alt="delivery-icon"> </span>
								<div class="boxes-desc">
									<h4>'.esc_attr($line_two).'</h4>
									<p>'.esc_attr($desc_two).'</p>
								</div>
							</li>
							<li>
								<span class="boxes-icons">
								<img src="'.wp_get_attachment_url($image_three).'" alt="quality-icon"> </span>
								<div class="boxes-desc">
									<h4>'.esc_attr($line_three).'</h4>
									<p>'.esc_attr($desc_three).'</p>
								</div>
							</li>						
						</ul>
					</div>';
	}
	elseif($layout == 'banner_bottom')
	{
		$output .='<div class="banner-bottom-boxes index5-boxes '.esc_attr($el_class).'">
                	<ul>
                    	<li class="first-box" style="background:url('.wp_get_attachment_url($bg_image_one).');">
                        	<span class="icons"><img src="'.wp_get_attachment_url($image).'" alt="delivery-icon"></span>
                        	<h4>'.esc_attr($line_one).'</h4>
                        	<p>'.esc_attr($desc_one).'</p>
                        </li>
                        <li class="second-box" style="background:url('.wp_get_attachment_url($bg_image_two).');">
                        	<span class="icons"><img src="'.wp_get_attachment_url($image_two).'" alt="technology-icon"></span>
                        	<h4>'.esc_attr($line_two).'</h4>
                        	<p>'.esc_attr($desc_two).'</p>
                        </li>
                        <li class="third-box" style="background:url('.wp_get_attachment_url($bg_image_three).');">
                        	<span class="icons"><img src="'.wp_get_attachment_url($image_three).'" alt="labor-icon"></span>
                        	<h4>'.esc_attr($line_three).'</h4>
                        	<p>'.esc_attr($desc_three).'</p>
                        </li>
                    </ul>
                </div>';
	}	
	elseif($layout == 'project_agri_two')
	{
		$output .=' <div class="col-md-12 marbtm50 wdt-100 '.esc_attr($el_class).'">
						<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 black-portfolio-left" style="background-color:'.esc_attr($left_bg).'">
							<ul>
								<li>
									<span class="colleft">'.esc_attr($line_one).'</span>
									<span class="colrght">'.esc_attr($desc_one).'</span>
								</li>
								<li>
									<span class="colleft">'.esc_attr($line_two).'</span>
									<span class="colrght">'.esc_attr($desc_two).'</span>
								</li>
								<li>
									<span class="colleft">'.esc_attr($line_three).'</span>
									<span class="colrght">'.esc_attr($desc_three).'</span>
								</li>
								<li>
									<span class="colleft">Share</span>
									<span class="colrght">
									<span class="header-socials portfolio-socials"> 
										<a href="'.esc_attr($url_fb).'"><i class="fa '.esc_attr($icon_fb).'" aria-hidden="true"></i></a> 
										<a href="'.esc_attr($url_tw).'"><i class="fa '.esc_attr($icon_tw).'" aria-hidden="true"></i></a> 
										<a href="'.esc_attr($url_go).'"><i class="fa '.esc_attr($icon_go).'" aria-hidden="true"></i></a> 
										<a href="'.esc_attr($url_li).'"><i class="fa '.esc_attr($icon_li).'" aria-hidden="true"></i></a>	
									</span>
									</span>
								</li>
							</ul>
						</div>                    
						<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 portfolio-info-column" style="background-color:'.esc_attr($right_bg).'">
							<ul>
								<li>
									<h4>'.esc_attr($pro_start_date_text).'</h4>
									<p>'.esc_attr($pro_start_date).'</p>
								</li>
								<li>
									<h4>'.esc_attr($pro_end_date_text).'</h4>
									<p>'.esc_attr($pro_end_date).'</p>
								</li>
								<li>
									<h4>'.esc_attr($pro_category_text).'</h4>
									<p>'.esc_attr($pro_category).'</p>
								</li>
							</ul>
						</div>                    
					</div>';
	}
	elseif($layout == 'project_agri_four')
	{
		$output .='<div class="wdt-100 '.esc_attr($el_class).'">                    
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="blog-graylist portfoli-scope" style="background-color:'.esc_attr($left_bg).'">
								<h4>'.esc_attr($title).'</h4>
									<p>'.wp_kses_post($content).'</p>
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
					</div>';
	}
	elseif($layout == 'project_factory_four')
	{
		$output .='<div class="wdt-100 '.esc_attr($el_class).'">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
							<span class="scope-img image_hover">
							<img src="'.wp_get_attachment_url($image).'" class="img-responsive zoom_img_effect" alt="agriculture-image">
							</span>
						</div>                    
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
							<div class="blog-graylist portfoli-scope" style="background-color:'.esc_attr($right_bg).'">
								<h4>'.esc_attr($title).'</h4>
								<p>'.wp_kses_post($content).'</p>
								<ul>
									<li>'.esc_attr($line_one).'</li>
									<li>'.esc_attr($line_two).'</li>
									<li>'.esc_attr($line_three).'</li>
									<li>'.esc_attr($line_four).'</li>
								</ul>
							</div>
						</div>
                    </div>';
	}
	wp_reset_postdata();
	echo translate($output);
?>