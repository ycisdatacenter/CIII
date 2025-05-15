<?php
	$atts = vc_map_get_attributes( 'tmc_services', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
	$total = 0;
	$col_class = '';

	if ($column == 2) 
	{
		$col_class = "col-xs-12 col-sm-6 col-md-6";
	} 
	elseif ($column == 3)
	{
		$col_class = "col-xs-12 col-sm-6 col-md-4";
	} 
	elseif ($column == 4) 
	{
		$col_class = "col-xs-12 col-sm-6 col-md-3";
	} 
	else 
	{
		$col_class = "col-xs-12 col-sm-6 col-md-6";
	}


	// carousal script for style 5
			$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					jQuery(".serviceGrid").slick({
						slidesToShow: 4,
                        autoplay: true,
                        dots: true,
                        arrows: false,
                        autoplaySpeed: 3000,
                        speed: 2000,
						slidesToScroll: 1,
						draggable: false,';
						$output .= 'responsive: [{
						    breakpoint: 1024,
						    settings: {
						    slidesToShow: 4
						    }
						},
						{
						    breakpoint: 981,
						    settings: {
						    slidesToShow: 2
						    }
						},
						{
						    breakpoint: 600,
						    settings: {
						    slidesToShow: 2
						    }
						},
						{
						    breakpoint: 480,
						    settings: {
						    slidesToShow: 1
						    }
						}]
					});
				});
			</script>';
	if($categoriesname == 'All' || $categoriesname == '')
	{		
		$taxonomy = '';
	}
	else
	{
		$taxonomy = 'tax_query';
	}
	$args = array(
					'post_type' => 'services',
					'post_status' => 'publish',
					$taxonomy => array(array(
										'taxonomy' => 'services-category',
										'field' => 'name',
										'terms' => $categoriesname
									)),
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );
	if ( $the_service->have_posts() ) :
		if($layout == 'layout1')
		{
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;
				$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
				$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');          
				$output .= '<div class="'.esc_attr($col_class).' col-sm-6 outer-column '.esc_attr($el_class).'">
								<div class="service-box sc-upper text-center">
								<a href="'.get_permalink().'">';
							if(isset($serviceIcon[0]))
							{
								$output .= '<span class="icons service-manufactureicon" style="background:url('.$serviceIcon[0].')"></span>';
							}
							else
							{
								$output .= '<span class="icons service-manufactureicon"></span>';
							}
				$output .= '<h5>'.get_the_title().'</h5>
								<p class="line-height26 marbtm20">'.wp_kses_post(get_the_excerpt()).'</p>
								<span class="read-more-link">'.esc_attr($read_more).'</span>
								</a>
								</div>
							</div>';
			endwhile;		
		}
		elseif($layout == 'layout2')
		{
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;
				$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
				$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
				
				$mainHoverIcon 	= get_post_meta( get_the_ID(), 'service-hover-icon', true );
				$serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full');
				if(isset($serviceHoverIcon[0]))
					$serhovericon = $serviceHoverIcon[0];
				else
					$serhovericon = '';
				
				if(isset($serviceIcon[0]))
					$sericon = $serviceIcon[0];
				else
					$sericon = '';
				
				$output .='	<div class="'.esc_attr($col_class).' col-sm-4 col-xs-12 marbtm50 service-list-column" style="--hover-image: url('.$serhovericon.');">	
								<a href="'.get_permalink().'">
								<span class="image_hover"> 
									'.get_the_post_thumbnail(get_the_ID(),array( 457, 485),array('class'=>'img-responsive zoom_img_effect')).'
								</span>
									<div class="service-heading service-manufactureicon" style="--main-image:url('.$sericon.');">
										<h5>'.get_the_title().'</h5>
										<span class="read-more-link">'.esc_attr($read_more).'</span>
									</div>
								</a>
							</div>';
			endwhile;	
		}
		elseif($layout == 'layout3')
		{
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;  
				$output .='<div class="'.esc_attr($col_class).' col-sm-6 col-xs-12 home3-service-column marbtm50 '.esc_attr($el_class).'">
								<a href="'.get_permalink().'">
									<span class="image_hover img">
										<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" class="img-responsive zoom_img_effect" alt="manufacture-image">
									</span>  
								</a>
								<h4>'.get_the_title().'</h4>
								<p class="line-height26 marbtm20">'.wp_kses_post(get_the_excerpt()).'</p>
								<span class="read-more-link">
									<a href="'.get_permalink().'">'.esc_attr($read_more).'</a>
								</span>											 
							</div>';
			endwhile;	
			
		}
		elseif($layout == 'layout4')
		{
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;
				$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
				$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
				if(isset($serviceIcon[0]))
					$sericon = $serviceIcon[0];
				else
					$sericon = '';
				
				$output .='<div class="'.esc_attr($col_class).' col-sm-4 col-xs-12 service-column service4-column">                	
								<span class="service4-icons icons service-manufactureicon" style="background: url('.$sericon.')"></span>
								<div class="service4-desc">
									<h5>'.get_the_title().'</h5>
									<p class="line-height26 marbtm20">'.wp_kses_post(get_the_excerpt()).'</p>
								   <a href="'.get_permalink().'"> <span class="read-more-link">'.esc_attr($read_more).'</span></a>
								</div>								
							</div>';
			endwhile;	
		}
		elseif($layout == 'layout5')
		{
			if(isset($col_class))
				$col_cl = $col_class;
			else
				$col_cl = '';
			
			$output .='<div class="row row_mar_zero">';
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;
				$mainImage = get_post_meta(get_the_ID(), 'home5-other-image', true );
				$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
				
				if(isset($serviceIcon[0]))
					$sericon = $serviceIcon[0];
				else
					$sericon = '';
				
				$output .=' <div class="'.esc_attr($col_cl).'col-xs-12 home5-service1" style="background: url('.$sericon.'); background-size: cover;">
								<a href="'.get_permalink().'">
								<h4>'.get_the_title().'</h4>
								<p class="fnt-17">'.wp_kses_post(get_the_excerpt()).'</p>
								<span class="service-home5 read-more-link">'.esc_attr($read_more).'</span>
								</a>
							</div>';
			endwhile;	
			$output .='</div>';
		}
		elseif($layout == 'layout6')
		{
			while ( $the_service->have_posts() ): 
				$the_service->the_post(); 
				$count++;
				$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
				$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
				
				if(isset($serviceIcon[0]))
					$sericon = $serviceIcon[0];
				else
					$sericon = '';
				
				$output .= '<div class="'.esc_attr($col_class).' col-sm-6 col-xs-12 '.esc_attr($el_class).'">
				                <div class="singleService">
									<div class="serviceImgArea">
									   <img src="'.$sericon.'" alt="'.esc_html('services', 'indofact').'">
									</div>
									<div class="serviceContent">
										<h5>'.get_the_title().'</h5>
										<p>'.wp_kses_post(get_the_excerpt()).'</p>
									</div>
								</div>
							</div>';
			endwhile;
		}
		elseif($layout == 'layout7')
		{
			$output .=
			'<div class="home7Services">
				<div class="row">
					<div class=" serviceGrid grid-wrapper grid-row ">';
					
							while ( $the_service->have_posts() ): $the_service->the_post(); $count++;
								$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
								$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
								$mainHoverIcon 	= get_post_meta( get_the_ID(), 'service-hover-icon', true );
				                $serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full');
								$active = '';
									
								if(isset($serviceHoverIcon[0]))
									$serhvicon = $serviceHoverIcon[0];
								else
									$serhvicon = '';
								
								if($count == 1)
								{
									$active = 'active';
								}
								$output .= 
								'
								        <div class="grid item no-padding">
							                <div class="hm7singleService">
							                    <h5>'.get_the_title().'</h5>
												<div class="hm7serviceImgArea">
												   <img src="'.$serhvicon.'" alt="'.esc_html('services', 'indofact').'">
												</div>
												<div class="hm7serviceContent">
													<p>'.wp_kses_post(get_the_excerpt()).'</p>';
													if($check_arrow == 'yes')
													{
													  $output .= 
													  '<a href="'.get_permalink().'"><i class="fas fa-arrow-right"></i></a>';
											        }
												$output .= 
												'</div>
											</div>
										</div>
								';
							endwhile;
						$output .=
						'
					</div>
				</div>
			</div>';
		}
		else
		{
			$output .=
			'<div class="home8Services">
				<div class="row">
						';
							while ( $the_service->have_posts() ): $the_service->the_post(); $count++;
								$mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
								$serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
								$mainHoverIcon 	= get_post_meta( get_the_ID(), 'service-hover-icon', true );
				                $serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full');
								$active = '';
								
								if(isset($serviceHoverIcon[0]))
									$serhvicon = $serviceHoverIcon[0];
								else
									$serhvicon = '';
								
								
								if($count == 1)
								{
									$active = 'active';
								}
								$output .= 
								'
								        <div class="col-md-6 col-sm-6 col-xs-12">
							                <div class="hm8singleService">
												<div class="hm8serviceImgArea">
												   <img src="'.$serhvicon.'" alt="'.esc_html('services', 'indofact').'">
												</div>
												<div class="hm8serviceContent">
												    <a href="'.get_permalink().'"><h5>'.get_the_title().'</h5></a>
													<p>'.wp_kses_post(get_the_excerpt()).'</p>';
												$output .= 
												'</div>
											</div>
										</div>
								';
							endwhile;
						$output .=
						'
				</div>
			</div>';
		}
	else:
		$output .= esc_html__('Sorry, there is no service under your selected page.', 'indofact');
	endif;
	wp_reset_postdata();
	echo translate($output);
?>