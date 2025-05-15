<?php
	$atts = vc_map_get_attributes( 'tmc_projects', $atts );
	extract ($atts);
	$output = '';
	$href = vc_build_link( $link );	
	$count  = 0;
	$total  = 0;
	$total1  = 0;
	$total2  = 0;
	
	if($categoriesname == 'All' || $categoriesname == '')
	{		
		$taxonomy = '';
	}
	else
	{
		$taxonomy = 'tax_query';
	}
	$col_class = '';
	
	$args = array(
		'post_type' => 'portfolio',
		'post_status' => 'publish',
		$taxonomy => array(
							array(
								'taxonomy' => 'portfolio-category',
								'field' => 'name',
								'terms' => $categoriesname
								)
						),
		'order'          => $order,
		'orderby'        => $orderby,
		'posts_per_page' => $number
	);	
    $the_projects = new WP_Query( $args );
	
	if ( $the_projects->have_posts() ) :
		if($layout == 'projects')
		{
			if($disable_filter != 'yes')
			{
				$output .= '<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">'.esc_html__( 'All Projects','indofact' ).'</a></li>';
								$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
									$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
									$arrNew = array();
									foreach($parent_cat as $cat_find)
									{
										$catName = $cat_find->name;
										if(isset($args['tax_query']))
										{
											if($catName == $args['tax_query'][0]['terms'])
											{
												$arrNew[] = $cat_find;
											}
										}
										
									}
									foreach ($arrNew as $catVal) 
									{
										$child_arg = array( 'hide_empty' => false, 'parent' => $catVal->term_id );
										$child_cat = get_terms( 'portfolio-category', $child_arg );
										foreach( $child_cat as $child_term ) 
										{
											$cat = str_replace(" ","_",$child_term->name);							
											$output .= '<li role="presentation"><a href="#'.esc_attr($cat).'" aria-controls="'.esc_attr($cat).'" role="tab" data-toggle="tab">'.esc_attr($child_term->name).'</a></li>'; 
										}
									}
				$output .= '</ul>';
			}
			$output .='<div class="tab-content '.esc_attr($el_class).'">';			
				$output .= '<div role="tabpanel" class="tab-pane active" id="all">
								<div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project" data-ride="carousel">
									<div class="controls"> 
										<a class="left fa fa-angle-left next_prve_control" href="#our_project" data-slide="prev"></a>
										<a class="right fa fa-angle-right next_prve_control" href="#our_project" data-slide="next"></a> 
									</div>
									<div class="carousel-inner">';
										while($the_projects->have_posts()): 
											$the_projects->the_post(); 
											$count++;
											$lightimage = get_the_post_thumbnail_url( get_the_ID(), 'full');
											$terms = get_the_terms (get_the_ID(), 'portfolio-category');     
											$arrCat = wp_list_pluck($terms, 'name');
											if (is_array($arrCat)) 
											{			
												foreach ($arrCat as $catname)	
												{
													$catname = str_replace(" ","_",$arrCat);
												}
											}
											$catlist = implode(" ", $catname);
											$active = '';
											if($count == 1)
											{
												$active = 'active';
											}
											$output .= '<div class="item '.$active.'">
                        <div class="'.esc_attr($col_class).' col-xs-12 img pad_zero">
                           <div class="grid">
						    <div class="image-zoom-on-hover">
										<div class="gal-item">
											<a class="black-hover" href="'.get_permalink().'">
											   '.get_the_post_thumbnail(get_the_ID(), '', array('class' => 'img-full img-responsive')).'
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
                        </div>
                     </div>';
										endwhile;
						$output .= '</div>
								</div>
							</div>';
							
							$cat = str_replace(" ","_",$child_term->name);
							$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
							$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
							$arrNew = array();
							foreach($parent_cat as $cat_find)
							{
								$catName = $cat_find->name;
								if(isset($args['tax_query']))
								{
									if($catName == $args['tax_query'][0]['terms'])
									{
										$arrNew[] = $cat_find;
									}
								}
								
							}
							foreach ($arrNew as $catVal) 
							{
								$child_arg = array( 'hide_empty' => false, 'parent' => $catVal->term_id );
								$child_cat = get_terms( 'portfolio-category', $child_arg );
								$prolist = 1;
								foreach( $child_cat as $child_term ) 
								{
									$numone = 1;
									$cat = str_replace(" ","_",$child_term->name);
									$output .= '<div role="tabpanel" class="tab-pane" id="'.esc_attr($cat).'">
													<div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project'.esc_attr($prolist).'" data-ride="carousel">
														<div class="controls"> 
															<a class="left fa fa-angle-left next_prve_control" href="#our_project'.esc_attr($prolist).'" data-slide="prev"></a>
															<a class="right fa fa-angle-right next_prve_control" href="#our_project'.esc_attr($prolist).'" data-slide="next"></a> 
														</div>
														<div class="carousel-inner">';
															while($the_projects->have_posts()): 
																$the_projects->the_post(); 
																$count++;
																$lightimage = get_the_post_thumbnail_url( get_the_ID(), 'full');
																$terms = get_the_terms (get_the_ID(), 'portfolio-category');     
																$arrCat = wp_list_pluck($terms, 'name');
																if (is_array($arrCat)) 
																{			
																	foreach ($arrCat as $catname)	
																	{
																		$catname = str_replace(" ","_",$arrCat);
																	}
																}
																$catlist = implode(" ", $catname);
																$active = '';
																if($count == 1)
																{
																	$active = 'active';
																}
																if( strpos( $catlist, $cat ) !== false ) 
																{																
																	if($numone == 1)
																	{
																		$act = 'active';
																	}
																	else
																	{
																		$act = '';
																	}
																	$output .= '<div class="item '.$act.' '.$active.'">
																					<div class="'.esc_attr($col_class).' col-xs-12 img pad_zero effect-goliath homeprj1-slide">
																						<div class=" shadow_effect black_overlay">
																							'.get_the_post_thumbnail(get_the_ID(), '', array('class' => 'imgShortcode')).'
																							<div class="project_txt_btn">
																							  <a href="'.get_permalink().'" class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn">'.esc_attr($read_more).'</a>
																							  <h6>'.get_the_title().'</h6>
																							</div>
																						</div>
																					</div>
																				</div>';
																	$numone++;
																}
															endwhile;
											$output .= '</div>
													</div>
												</div>';
									$prolist++;
								}
							}						
							$output .= '</div>';
		}
		elseif($layout == 'projects_layout_two')
		{	
			$col_class = "col-xs-12 col-sm-6 col-md-4";
			
			$output .= '<div class="container">';
			if($title_check == 'yes')
			{
				$output .= '<h3 class="white-color">'.esc_attr($project_title).'</h3>';
			}							
			if($disable_filter != 'yes')
			{
				$output .= '<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">'.esc_html__('All','indofact').'</a></li>';
								
								$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
								$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
								
								$arrNew = array();

								foreach( $parent_cat as $arrNew ) 
								{						
									$output .= '<li role="presentation"><a href="#'.esc_attr($arrNew->slug).'" aria-controls="'.esc_attr($arrNew->slug).'" role="tab" data-toggle="tab">'.esc_attr($arrNew->name).'</a></li>';
								}
								
				$output .= '</ul>';
			}
			$output .= '</div>';
			
			$args = array(
								'post_type' => 'portfolio',
								'post_status' => 'publish',
								'order'          => $order,
								'orderby'        => $orderby,
								'posts_per_page' => $number
							);	
			$the_projects = new WP_Query( $args );
				
			$output .= '<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="all">								
								<div class="full_wrapper carousel slide three_shows_one_move home2-project" id="our_project" data-ride="carousel">							
									<div class="controls">
										<a class="left fa fa-angle-left next_prve_control" href="#our_project" data-slide="prev"></a>
										<a class="right fa fa-angle-right next_prve_control" href="#our_project" data-slide="next"></a> 
									</div>
									<div class="carousel-inner">';
									$count=0;
										while($the_projects->have_posts()): 
											$the_projects->the_post(); 
											
											$active = '';
											if($count == 0)
											{
												$active = 'active';
											}
											$output .= '<div class="item '.$active.'">
												   <div class="'.esc_attr($col_class).' col-xs-12 img pad_zero">
													  <div class="grid">
															<div class="image-zoom-on-hover">
																<div class="gal-item">
																	<a class="black-hover" href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(),'tmc-image-370x488-croped').'
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
												   </div>
												</div>';
												$count++;
										endwhile;
						$output .= '</div>
								</div>
							</div>';		
						$prolist = 1;
						foreach ($parent_cat as $arrNew) 
						{	
								$output .= '<div role="tabpanel" class="tab-pane " id="'.$arrNew->slug.'">								
													<div class="full_wrapper carousel slide three_shows_one_move home2-project" id="our_project'.esc_attr($prolist).'" data-ride="carousel">							
														<div class="controls">
															<a class="left fa fa-angle-left next_prve_control" href="#our_project'.esc_attr($prolist).'" data-slide="prev"></a>
															<a class="right fa fa-angle-right next_prve_control" href="#our_project'.esc_attr($prolist).'" data-slide="next"></a> 
														</div>
														<div class="carousel-inner">';
																		
				$argspor = array(
				  
								'post_type' => 'portfolio',
								'post_status' => 'publish',
								'order'          => $order,
								'orderby'        => $orderby,	
								'posts_per_page' => $number,
								'tax_query' => array(
														array(
															'taxonomy' => 'portfolio-category',
															'field' => 'term_id',
															'terms' => $arrNew->term_id,
															)
													)
								);	
				$the_projects = new WP_Query( $argspor );					
				$act = 0;							
				while($the_projects->have_posts()): 
				$the_projects->the_post(); 
				
				if($act==0)
					$active1 = ' active';
				else
					$active1 = '';
				
				$output .= '<div class="item '.$active1.'">
								<div class="'.esc_attr($col_class).' col-xs-12 img pad_zero effect-goliath homeprj1-slide">
										<div class=" shadow_effect black_overlay">'.get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x488-croped').'
												<div class="project_txt_btn"><a href="'.get_permalink().'" class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn">'.esc_attr($read_more).'</a><h6>'.get_the_title().'</h6></div>
										</div>
								</div>
							</div>';
												$act++;
												
				endwhile;
					$output .= '</div></div></div>';
					
				$prolist++;
						}
			$output .= '</div>';
		}
		elseif( $layout == 'projects_layout_three' )
		{
			$col_class = "col-xs-12 col-sm-6 col-md-4";
			$output .= '<div class="col-lg-12 wdt-100">';
				if($title_check == 'yes')
				{
					$output .= '<h3 class="white-color">'.esc_attr($project_title).'</h3>';
				}
							
			$output .= '<a class="view-project-link" href="'.$href['url'].'">'.$href['title'].'</a></div>';
		
			while($the_projects->have_posts()): 
				$the_projects->the_post(); 
				$count++;
				$output .='<div class="'.esc_attr($col_class).' col-xs-12 img homeprj3-slide">
			   <div class="grid">
							  <div class="image-zoom-on-hover">
										<div class="gal-item">
											<a class="black-hover" href="'.get_permalink().'">
											   <img class="img-full img-responsive" src="'.get_the_post_thumbnail_url( get_the_ID(), 'tmc-image-370x488-croped').'" alt="'.get_the_title().'">
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
		}
		elseif($layout == 'projects_layout_four')
		{
			$col_class = "col-xs-12 col-sm-3 col-md-3";

			if($title_check == 'yes')
			{
				$output .= '<div class="container"><h3 class="golden margbt44">'.esc_attr($project_title).'</h3></div>';
			}
			if($disable_filter != 'yes')
			{
				$output .= '<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">'.esc_html__('All','indofact').'</a></li>';
								$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
									$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
									$arrNew = array();
									foreach($parent_cat as $arrNew)
									{
										$cat = str_replace(" ","_",$arrNew->slug);
										$output .= '<li role="presentation"><a href="#'.esc_attr($arrNew->slug).'" aria-controls="'.esc_attr($arrNew->slug).'" role="tab" data-toggle="tab">'.esc_attr($arrNew->name).'</a></li>'; 
									}
				$output .= '</ul>';
			}
			$output .='<div class="tab-content '.esc_attr($el_class).'">';
			  
		  // Code for ALL Projects

		  $output .= '<div role="tabpanel" class="tab-pane active" id="all">
               <div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project" data-ride="carousel">
                  <div class="controls"> <a class="left fa fa-angle-left next_prve_control" href="#our_project" data-slide="prev"></a><a class="right fa fa-angle-right next_prve_control" href="#our_project" data-slide="next"></a> </div>
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">';

				  $args = array(
								'post_type' => 'portfolio',
								'post_status' => 'publish',
								'order'          => $order,
								'orderby'        => $orderby,
								'posts_per_page' => $number
							);	
				$the_pro = new WP_Query( $args );
				$act1 = 0;				
				  while($the_pro->have_posts()): 
					$the_pro->the_post(); 
					
					if($act1==0)
						$active2 = ' active';
					else
						$active2 = '';
            $output .= $arrNew->ID.'<div class="item '.$active2.'">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 img pad_zero ">
						    <div class="image-zoom-on-hover">
								<div class="gal-item">
									<a class="black-hover" href="'.get_permalink().'">
									   '.get_the_post_thumbnail(get_the_ID(),'tmc-image-370x488-croped').'
									   <div class="tour-layer delay-1"></div>
									   <div class="vertical-align">
											 <div class="border">
												<h5>'.get_the_title().'</h5>
											 </div>
											 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span>'.$read_more.'</span></div>
									   </div>
									</a>
							    </div>
						    </div>
                        </div>
                     </div>';
					 $act1++;
                     endwhile;
                  $output .= '</div>	  
               </div>
            </div>';

		  // End Code for All projects

			$a=1;
			foreach($parent_cat as $arrNew)
			{
		$output .= '<div role="tabpanel" class="tab-pane " id="'.$arrNew->slug.'">
               <div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project'.$a.'" data-ride="carousel">
                  <div class="controls"> <a class="left fa fa-angle-left next_prve_control" href="#our_project'.$a.'" data-slide="prev"></a><a class="right fa fa-angle-right next_prve_control" href="#our_project'.$a.'" data-slide="next"></a> </div>
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">';

				  $argspor = array(
				  
								'post_type' => 'portfolio',
								'post_status' => 'publish',
								'order'          => $order,
								'orderby'        => $orderby,	
								'posts_per_page' => $number,
								'tax_query' => array(
														array(
															'taxonomy' => 'portfolio-category',
															'field' => 'term_id',
															'terms' => $arrNew->term_id,
															)
													)
								);	
				$the_pro = new WP_Query( $argspor );	
				  $act = 0;
				  while($the_pro->have_posts()): 
					$the_pro->the_post(); 
							if($act==0)
							$active1 = ' active';
							else
							$active1 = '';
            $output .= '<div class="item '.$active1.'">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 img pad_zero ">
						    <div class="image-zoom-on-hover">
								<div class="gal-item">
									<a class="black-hover" href="'.get_permalink().'">
									   '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x488-croped').'
									   <div class="tour-layer delay-1"></div>
									   <div class="vertical-align">
											 <div class="border">
												<h5>'.get_the_title().'</h5>
											 </div>
											 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span>'.$read_more.'</span></div>
									   </div>
									</a>
							    </div>
						    </div>
                        </div>
                     </div>';
					 $act++;
                     endwhile;
					 $the_pro ='';
                  $output .= '</div>	  
               </div>
            </div>';
			$a++;
			}
			$output .= '</div>';
		}
		elseif($layout == 'projects_layout_home6')
		{	
			$output .= 
			'<div class="featuredProject">
			    <div class="row">
			        <div class="col-md-6 col-sm-6 col-xs-12 titleSec">
			            <div class="row">
				            <div class="col-md-4 col-sm-12 col-xs-12">
				            </div>
				            <div class="col-md-8 col-sm-12 col-xs-12 titleSecRight">
				                <div class="title1 titleLine">';
				                if($title_line_check == 'yes')
				                {
				                    $output .= '<div class="lineDiv" style="background: '.$title_line_color.'; "></div>';
				                }
				                    $output .= '<p style="color: '.$title1_color.';">'.esc_attr($project_title1).'</p>
				                </div>';
				                if($project_title != '')
				                {
					                $output .= 
					                '<div class="title2">
					                    <h1 style="color: '.$title_color.';">'.esc_attr($project_title).'</h1>
					                </div>';
				                }
				                if($project_title_content != '')
				                {
					                $output .= 
					                '<div class="titleContent">
					                    <p>'.esc_attr($project_title_content).'</p>
					                </div>';
				                }
				                if($href['title'] != '')
				                {
					                $output .= 
					                '<div class="titleButton">
					                    <a href="'.$href['url'].'">'.$href['title'].'</a>
					                </div>';
				                }
				            $output .= 
				            '</div>
				        </div>
			        </div>';
			        while($the_projects->have_posts()): $the_projects->the_post(); $total++;
			        if($total == 1)
			        {
				        $output .= 
				        '<div class="col-md-3 col-sm-3 col-xs-12">
					        <div class="projectImage1">
					        '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-483x480-croped',  array('class'=>'proImg')).'
					        </div>
				        </div>
				        <div class="col-md-3 col-sm-3 col-xs-12 projectTopRight">
				            <div class="title2 projectName">
			                    <h1>'.get_the_title().'</h1>
			                </div>
			                <div class="titleButton projectButton">
			                    <a href="'.get_permalink().'">'.$read_more.'</a>
			                </div>
				        </div>';
			        }
			        endwhile;
			    $output .= 
			    '</div>
			    <div class="row">';
			        while($the_projects->have_posts()): $the_projects->the_post(); $total1++;
			        if($total1 == 2)
			        {
				        $output .= 
				        '<div class="col-md-3 col-sm-3 col-xs-12 projectNameLeft">
				            <div class="title2 projectName">
			                    <h1>Oil Plant Projects</h1>
			                </div>
			                <div class="titleButton projectButton">
			                    <a href="#">View Detail</a>
			                </div>
				        </div>
				        <div class="col-md-3 col-sm-3 col-xs-12">
				            <div class="projectImage2">
					        '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-483x480-croped',  array('class'=>'proImg')).'
					        </div>
				        </div>';

			        }
			        endwhile;
			        while($the_projects->have_posts()): $the_projects->the_post(); $total2++;
			        if($total2 == 3)
			        {
				        $output .= 
				        '<div class="col-md-3 col-sm-3 col-xs-12 projectNameRight">
				            <div class="title2 projectName">
			                    <h1>Manufacturing Projects</h1>
			                </div>
			                <div class="titleButton projectButton">
			                    <a href="#">View Detail</a>
			                </div>
				        </div>
				        <div class="col-md-3 col-sm-3 col-xs-12">
				            <div class="projectImage3">
					        '.get_the_post_thumbnail(get_the_ID(),  'tmc-image-483x480-croped',  array('class'=>'proImg')).'
					        </div>
				        </div>';
			        }
			        endwhile;
			    $output .= 
			    '</div>
			</div>';
			 //endwhile;
		}
		elseif($layout == 'projects_layout_home7')
		{	
			$output .= 
			'<div class="demo3Project">
			    <div class="row">';
			        while($the_projects->have_posts()): $the_projects->the_post(); $count++;
				        $output .= 
				        '<div class="col-md-3 col-sm-6 col-xs-12">
				            <div class="demo3SingleProject">
						        <div class="demo3ProjectImg">
						        '.get_the_post_thumbnail(get_the_ID(), '', array('class'=>'demo3ProImg')).'
						        </div>
					            <div class="demoProContent">
				                    <h1><a href="'.get_permalink().'">'.get_the_title().'</a></h1>
				                </div>
			                </div>
				        </div>';
			        endwhile;
			    $output .= 
			    '</div>
			</div>';
		}
		elseif($layout == 'projects_layout_home8')
		{	
			$output .= 
			'<div class="container">';
				if($disable_filter != 'yes')
				{
					$output .= 
					'<div class="projectFilterTab">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab"><b>-</b>'.esc_html__('All','indofact').'</a></li>';
							
							$parent_cat_arg = array('hide_empty' => false,'parent' => 0);
							$parent_cat = get_terms('portfolio-category',$parent_cat_arg);
							
							$arrNew = array();

							foreach( $parent_cat as $arrNew ) 
							{						
								$output .= '<li role="presentation"><a href="#'.esc_attr($arrNew->slug).'" aria-controls="'.esc_attr($arrNew->slug).'" role="tab" data-toggle="tab">'.esc_attr($arrNew->name).'</a></li>';
							}
										
						$output .= 
						'</ul>
					</div>';
				}
			$output .= 
			'</div>';
			$args = array(
								'post_type' => 'portfolio',
								'post_status' => 'publish',
								'order'          => $order,
								'orderby'        => $orderby,
								'posts_per_page' => $number
							);	
			$the_projects = new WP_Query( $args );
			$output .= 
			'<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="all">								
					<div class="full_wrapper" id="our_project" data-ride="carousel">							
						';
							$count=0;
							while($the_projects->have_posts()): $the_projects->the_post(); 
								$output .= 
								'<div class="item">
									<div class="col-md-4 col-sm-6 col-xs-12 img homeprj3-slide">
										<div class="grid">
											<div class="image-zoom-on-hover">
												<div class="gal-item">
													<a class="black-hover" href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(),'tmc-image-370x488-croped').'
														<div class="tour-layer delay-1"></div>
														<div class="vertical-align">
															<div class="border">
																<h5>'.get_the_title().'</h5>
															</div>
														</div>
													</a>
												</div>
											</div>
										</div>
								    </div>
								</div>';
								$count++;
							endwhile;
						$output .= 
						'
					</div>
				</div>';		
				$prolist = 1;
				foreach ($parent_cat as $arrNew) 
				{	
					$output .= 
					'<div role="tabpanel" class="tab-pane " id="'.$arrNew->slug.'">								
						<div class="full_wrapper " id="our_project'.esc_attr($prolist).'" data-ride="carousel">						';
					            $argspor = array(
									'post_type' => 'portfolio',
									'post_status' => 'publish',
									'order'          => $order,
									'orderby'        => $orderby,	
									'posts_per_page' => $number,
									'tax_query' => array(
															array(
																'taxonomy' => 'portfolio-category',
																'field' => 'term_id',
																'terms' => $arrNew->term_id,
																)
														)
									);	
								$the_projects = new WP_Query( $argspor );					
								$act = 0;							
								while($the_projects->have_posts()): $the_projects->the_post(); 
									$output .= 
								'<div class="item">
									<div class="col-md-4 col-sm-6 col-xs-12 img homeprj3-slide">
										<div class="grid">
											<div class="image-zoom-on-hover">
												<div class="gal-item">
													<a class="black-hover" href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(),'tmc-image-370x488-croped').'
														<div class="tour-layer delay-1"></div>
														<div class="vertical-align">
															<div class="border">
																<h5>'.get_the_title().'</h5>
															</div>
														</div>
													</a>
												</div>
											</div>
										</div>
								    </div>
								</div>';
									$act++;
					            endwhile;
					$output .= 
					        '</div>
					</div>';
					$prolist++;
				}
			$output .= 
		    '</div>
	    ';
	    }
	else
		$output .= __( 'Sorry, there is no projects under your selected page.', 'indofact' );
	endif;
	wp_reset_postdata();
	echo translate($output);
?>