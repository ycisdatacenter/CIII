<?php
	$atts = vc_map_get_attributes( 'tmc_testimonials', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
	$total  = 0;
	if($layout == 'grid')
	{
		$col_class = '';
		if ($column == 2) 
		{
			$col_class = "col-lg-6 col-md-6 col-sm-12 col-xs-12";
			$clintdesc = 'client-desc2';
		} 
		elseif ($column == 3)
		{
			$col_class = "col-sm-4 col-md-4 col-sm-12 col-xs-12";
			$clintdesc = 'client-desc3';
		}
		else 
		{
			$col_class = "col-lg-6 col-md-6 col-sm-12 col-xs-12";
			$clintdesc = 'client-desc2';
		}
	}

	$args = array(
					'post_type' => 'testimonial',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_testimonials = new WP_Query( $args );
	if ( $the_testimonials->have_posts() ) :
		if($layout == 'carousel')
		{
			$testi_bcolor = '';
			if($bg_color == '')
			{
				$testi_bcolor = 'testi_bcolor';
			}
			$output .='<section class="testimonial-section '.esc_attr($el_class).'">
							<div class="testimonial-rght-head '.esc_attr($testi_bcolor).'">
								<h2>'.esc_attr($title).'</h2>
							</div>
							<div class="container">
								<div class="col-lg-6 col-md-6 testimonial-left-sidebar">
									<div id="minimal-bootstrap-carousel1" class="home1 carousel slide carousel-horizontal shop-slider full_width testimonial-slider" data-ride="carousel"> 
										<div class="carousel-inner" role="listbox">';
										while ( $the_testimonials->have_posts() ): 
										$the_testimonials->the_post(); 
										$count++;
										$designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
										$active = '';
										if($count == 1):
											$active = 'active';
										endif;
								$output .='<div class="item '.esc_attr($active).' slide-'.esc_attr($count).'" >
												<div class="testimonial-head">
													<span class="testi-img">
														'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive img-circle')).'
													</span>
													<div class="testi-text">
														<h5>'.get_the_title().'</h5>
														<span class="testi-designation">'.esc_attr($designation).'</span>
													</div>
												</div>
												<p>'.get_the_excerpt().'</p>
											</div>';
										endwhile;	
							$output .='</div>
										<a class="left carousel-control" href="#minimal-bootstrap-carousel1" role="button" data-slide="prev"> 
											<i class="fa fa-angle-left"></i> 
											<span class="sr-only">'.esc_html__('Previous','indofact').'</span> 
										</a> 
										<a class="right carousel-control" href="#minimal-bootstrap-carousel1" role="button" data-slide="next"> 
											<i class="fa fa-angle-right"></i> 
											<span class="sr-only">'.esc_html__('Next','indofact').'</span> 
										</a> 
									</div>
								</div>
							</div>
						</section>';		
		}
		elseif($layout == 'carousel_two')
		{
			$output .='<section class="pad95-100-top-bottom home3_testimonial carousel slide two_shows_one_move" id="var_testimonial" data-ride="carousel">
						<div class="container">
							<h3 class=" text-center">'.esc_attr($title).'</h3>
							<div class="text-center">
								<div class="controls">
									<a class="left fa fa-angle-left next_prve_control" href="#var_testimonial" data-slide="prev"></a>
									<a class="right fa fa-angle-right next_prve_control" href="#var_testimonial" data-slide="next"></a> 
								</div>
							</div>
							<div class="row">
								<div class="carousel-inner">';
							while ( $the_testimonials->have_posts() ): 
								$the_testimonials->the_post(); 
								$count++;
								$designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );				
								$active = '';
								if($count == 1):
									$active = 'active';
								endif;
								$output .='<div class="item '.esc_attr($active).'">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 client-column">
													<span class="home3-client-img">
														'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive border_img')).'
													</span>
													<div class="home3-client-desc">
														<h4>'.get_the_title().'</h4>
														<span class="client-designation">'.esc_attr($designation).'</span>
														<p>'.get_the_excerpt().'</p>
													</div>
												</div>							
										   </div>';
							endwhile;
			$output .='</div>							
					   </div>
					   </div>
					   </section>';
		}
		elseif($layout == 'carousel_three')
		{
			$output .='<section class="pad95-100-top-bottom carusel3_testimonial carousel slide two_shows_one_move" id="var_testimonial" data-ride="carousel">
						<div class="container">
							<h3 class=" text-center">'.esc_attr($title).'</h3>
							<div class="row">
								<div class="carousel-inner">';
							while ( $the_testimonials->have_posts() ): 
								$the_testimonials->the_post(); 
								$count++;
								$designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );				
								$active = '';
								if($count == 1):
									$active = 'active';
								endif;
								$output .='<div class="item '.esc_attr($active).'">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 client-column">
													<span class="home3-client-img">
														'.get_the_post_thumbnail(get_the_ID(), array( 150, 150), array('class'=>'img-responsive border_img')).'
													</span>
													<div class="carusel3_testimonial_title">
														<h4>'.get_the_title().'</h4>
														<span class="carusel3-designation">'.esc_attr($designation).'</span>
														<p class="testquote">'.get_the_excerpt().'</p>
													</div>
												</div>							
										   </div>';
							endwhile;
			$output .='</div>							
					   </div>
					   </div>
					   </section>';
		}
		elseif( $layout ==  'grid')
		{
			while ( $the_testimonials->have_posts() ): 
				$the_testimonials->the_post(); 
				$count++;
				$output .='	<div class="'.esc_attr($col_class).' client-testimonial">
								<span class="client-img">
									'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive')).'
								</span>
								<div class="'.$clintdesc.'">
									<p>'.get_the_excerpt().'</p>
									<span class="client-name">- '.get_the_title().'</span>
								</div>
							</div>';
			endwhile;
		}
		elseif($layout == 'carousel_four')
		{
			$testi_bcolor = '';
			if($bg_color == '')
			{
				$testi_bcolor = 'testi_bcolor';
			}
			$output .='<div class="container testimonialArea'.esc_attr($el_class).'">
					    <div class="row">
						<div class="col-md-12 testimonialContent">
								<div class="carousel slide" data-ride="carousel"> 
									<div class="carousel-inner" role="listbox">';

										while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
										$stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
										//$stars = 2;

										if($stars == 2)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 3)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 4)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 5)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
										}
										else
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										$active = '';
										if($count == 1):
											$active = 'active';
										endif; 
											$output .='<div class="item testimonialImgSec '.esc_attr($active).' slide-'.esc_attr($count).'" >';
											
											$output .='<div class="col-md-4 hm6-testimg">
															'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'testiImg testiImg1')).'
														</div>
															<div class="col-md-8 testimonialText">
																<h5>'.get_the_title().'</h5>
																	<span class="testi-star">'.$starValue.'</span>
																<p>'.get_the_excerpt().'</p>
															</div>	
														</div>';
										endwhile;	
						$output .=' </div>
								</div>
							</div>
						</div>
					</div>';
		}
		elseif($layout == 'carousel_five')
		{
			$output .='<div class="hm7Testimonial">
							<div class="row">
								<div class=" carousel slide" data-ride="carousel" id="var1_testimonial"> 
									<div class="carousel-inner" role="listbox">';
										while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
											$designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
										$stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
										//$stars = 2;
										if($stars == 2)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 3)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 4)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 5)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
										}
										else
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										$active = '';
										if($count == 1):
											$active = 'active';
										endif;
											$output .=
											'<div class="item '.esc_attr($active).' slide-'.esc_attr($count).'" >
												<div class="testimonialText">
												<i class="fas fa-quote-left"></i>
												'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive border_img')).'
                                                    <div class="hm7TestimonialContent">
                                                        <p>'.get_the_excerpt().'</p>
														<h5>'.get_the_title().'</h5>
														<p class="desig">'.$designation.'</p>
														<span class="testi-star">'.$starValue.'</span>
													</div>
												</div>
												
											</div>';
										endwhile;
			$output .='</div>
			           </div>							
					   <div class="hm7TestimonialArrow">
								<div class="controls">
									<a class="left fa fa-angle-left next_prve_control" href="#var1_testimonial" data-slide="prev"></a>
									<a class="right fa fa-angle-right next_prve_control" href="#var1_testimonial" data-slide="next"></a> 
								</div>
							</div>
					   </div>
					   </div>';
		}
		else
		{
			$output .='<div class="hm8Testimonial testimonialArea'.esc_attr($el_class).'">
							<div class="row">
								<div class=" carousel slide" data-ride="carousel" id="var2_testimonial"> 
									<div class="carousel-inner" role="listbox">';
										while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
											$designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
										 $stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
										//$stars = 2;
										if($stars == 2)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 3)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 4)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										elseif($stars == 5)
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
										}
										else
										{
										$starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
										}
										$active = '';
										if($count == 1):
											$active = 'active';
										endif;
											$output .=
											'<div class="item '.esc_attr($active).' slide-'.esc_attr($count).'" >
												<div class="testimonialText">
												    <i class="fas fa-quote-left"></i>
												    <p>'.get_the_excerpt().'</p>
												</div>
                                                <div class="hm8TestimonialContent">
													<h5>'.get_the_title().'</h5>
													<p class="desig">'.$designation.'</p>
													<span class="testi-star">'.$starValue.'</span>
												</div>
												
											</div>';
										endwhile;
			$output .='</div>
			           </div>							
					   <div class="hm8TestimonialArrow">
								<div class="controls">
									<a class="left fa fa-angle-left next_prve_control" href="#var2_testimonial" data-slide="prev"></a>
									<a class="right fa fa-angle-right next_prve_control" href="#var2_testimonial" data-slide="next"></a> 
								</div>
							</div>
					   </div>
					   </div>';
		}
	else:
		$output .= esc_html__('Sorry, there is no testimonial under your selected page.', 'indofact');
	endif;
	wp_reset_postdata();
	echo translate($output);
?>