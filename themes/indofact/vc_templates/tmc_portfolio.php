<?php
	$atts = vc_map_get_attributes( 'tmc_portfolio', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
	$col_class = '';
	/*if ($column == 2) 
	{
		$col_class = "col-lg-6 col-md-6 col-sm-6";
	} 
	else */
	if ($column == 3)
	{
		$col_class = "col-lg-4 col-md-4 col-sm-6";
	} 
	elseif ($column == 4) 
	{
		$col_class = "col-lg-3 col-md-3 col-sm-6";
	} 
	else 
	{
		$col_class = "col-lg-6 col-md-6 col-sm-6 projt-column";
	}

	$args = array(
					'post_type' => 'portfolio',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_portfolio = new WP_Query( $args );
	if ( $the_portfolio->have_posts() ) :
		
		if($layout == 'portfolio_three')
		{
			$output .= '<div class="filter-section">
							<div class="col-sm-12 col-xs-12">
								<div class="filter-container isotopeFilters">
									<ul class="list-inline filter">
										<li class="active"><a href="#" data-filter="*">'.esc_html__('All Projects ','indofact').' </a></li>';
											$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
											$parent_cat = get_terms('portfolio-category',$parent_cat_arg);

												foreach( $parent_cat as $child_term ) 
												{
													$count++;							
													$output .= '<li class="cat-item cat-item-'.esc_attr($count).'"> <a href="#" data-filter=".'.esc_attr($child_term->slug).'">'.esc_attr($child_term->slug).'</a> </li>'; 
												}
						$output .= '</ul>
								</div>
							</div>
						</div>
						<section>
						<div class="container">
							<div class="portfolio-section port-col project_classic portfolio-3">
								<div class="isotopeContainer">';
			while ( $the_portfolio->have_posts() ): 
				$the_portfolio->the_post(); 
				$count++;
				$terms = get_the_terms (get_the_ID(), 'portfolio-category');     
				$arrCat = wp_list_pluck($terms, 'slug');

				if (is_array($arrCat)) 
				{			
					foreach ($arrCat as $catname)	
					{
						$catname = str_replace(" ","_",$arrCat);
					}
				}
				$catlist = implode(" ", $catname);
				$output .='	 <div class="'.esc_attr($col_class).' col-xs-12 img mbot30 isotopeSelector '.esc_attr($catlist).'">
					<div class="grid">
						   <div class="image-zoom-on-hover">
										<div class="gal-item">
											<a class="black-hover" href="'.get_the_permalink().'">
											   '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-360x278-croped', array('class'=>'img-full img-responsive')).'
											   <div class="tour-layer delay-1"></div>
											   <div class="vertical-align">
													 <div class="border">
														<h5>'.get_the_title().'</h5>
													 </div>
													 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span>'.esc_attr($read_more).'</span></div>
											  </div>
										</a>
									</div>
								</div>
                           </div>
                  </div>';
			endwhile;
			$output .='			</div>
							</div>
						</div>
						</section>';		
		}
		elseif($layout == 'portfolio_four')
		{
			$output .= '<div class="filter-section">
							<div class="col-sm-12 col-xs-12">
								<div class="filter-container isotopeFilters">
									<ul class="list-inline filter">
										<li class="active"><a href="#" data-filter="*">'.esc_html__('All Projects ','indofact').' </a></li>';
											$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
											$parent_cat = get_terms('portfolio-category',$parent_cat_arg);

											foreach( $parent_cat as $child_term ) 
											{
												$count++;							
												$output .= '<li class="cat-item cat-item-'.esc_attr($count).'"> <a href="#" data-filter=".'.esc_attr($child_term->slug).'">'.esc_attr($child_term->slug).'</a> </li>'; 
											}
						$output .= '</ul>
								</div>
							</div>
						</div>
						<section>
						<div class="container">
							<div class="portfolio-section port-col project_classic portfolio-4">
								<div class="isotopeContainer">';
			while ( $the_portfolio->have_posts() ): 
				$the_portfolio->the_post(); 
				$count++;
				$terms = get_the_terms (get_the_ID(), 'portfolio-category');     
				$arrCat = wp_list_pluck($terms, 'slug');
				if (is_array($arrCat)) 
				{			
					foreach ($arrCat as $catname)	
					{
						$catname = str_replace(" ","_",$arrCat);
					}
				}
				$catlist = implode(" ", $catname);
				$output .='		<div class="'.esc_attr($col_class).' col-xs-12 img mbot30 isotopeSelector '.esc_attr($catlist).'">
				  <div class="grid">
						   <div class="image-zoom-on-hover">
										<div class="gal-item">
											<a class="black-hover" href="'.get_the_permalink().'">
											   '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-263x203-croped', array('class'=>'img-full img-responsive')).'
											   <div class="tour-layer delay-1"></div>
											   <div class="vertical-align">
													 <div class="border">
														<h5>'.get_the_title().'</h5>
													 </div>
													 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span>'.esc_attr($read_more).'</span></div>
											  </div>
										</a>
									</div>
								</div>
                           </div>
                     <div class="marbtm30"></div>
                     <h4>'.get_the_title().'</h4>
                     <p>'.get_the_excerpt().'</p>
                  </div>';
			endwhile;
			$output .='			</div>
							</div>
						</div>
						</section>';		
		}
		else
		{
			$output .= '<div class="filter-section">
							<div class="col-sm-12 col-xs-12">
								<div class="filter-container isotopeFilters">
									<ul class="list-inline filter">
										<li class="active"><a href="#" data-filter="*">'.esc_html__('All Projects ','indofact').' </a></li>';
											$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
											$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
											foreach( $parent_cat as $child_term ) 
											{
												$count++;							
												$output .= '<li class="cat-item cat-item-'.esc_attr($count).'"> <a href="#" data-filter=".'.esc_attr($child_term->slug).'">'.esc_attr($child_term->slug).'</a> </li>'; 
											}
						$output .= '</ul>
								</div>
							</div>
						</div>
						<section>
							<div class="portfolio-section port-col project_classic portfolio-5">
								<div class="isotopeContainer">';
			while ( $the_portfolio->have_posts() ): 
				$the_portfolio->the_post(); 
				$count++;
				$terms = get_the_terms (get_the_ID(), 'portfolio-category');     
				$arrCat = wp_list_pluck($terms, 'slug');
				if (is_array($arrCat)) 
				{			
					foreach ($arrCat as $catname)	
					{
						$catname = str_replace(" ","_",$arrCat);
					}
				}
				$catlist = implode(" ", $catname);
				$output .='		 <div class="'.esc_attr($col_class).' col-xs-12 img mbot30 isotopeSelector '.esc_attr($catlist).'">
                   <div class="grid">
						   <div class="image-zoom-on-hover">
										<div class="gal-item">
											<a class="black-hover" href="'.get_the_permalink().'">
											   '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-240x185-croped', array('class'=>'img-full img-responsive')).'
											   <div class="tour-layer delay-1"></div>
											   <div class="vertical-align">
													 <div class="border">
														<h5>'.get_the_title().'</h5>
													 </div>
													 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span>'.esc_attr($read_more).'</span></div>
											  </div>
										</a>
									</div>
								</div>
                           </div>
                     <div class="marbtm30"></div>
                     <h4>'.get_the_title().'</h4>
                     <p>'.get_the_excerpt().'</p>
               </div>';
           
			endwhile;
			$output .='			</div>
							</div>
						</section>';
		}
	else:
		$output .= esc_html__('Sorry, there is no portfolio under your selected page.', 'indofact');
	endif;
	wp_reset_postdata();
	echo translate($output);
?>