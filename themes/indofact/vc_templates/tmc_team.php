<?php
	$atts = vc_map_get_attributes( 'tmc_team', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
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
	if($categoriesname == 'All' || $categoriesname == '')
	{		
		$taxonomy = '';
	}
	else
	{
		$taxonomy = 'tax_query';
	}
	$args = array(
					'post_type' => 'team',
					'post_status' => 'publish',
					$taxonomy => array(array(
										'taxonomy' => 'team-category',
										'field' => 'name',
										'terms' => $categoriesname
									)),
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_team = new WP_Query( $args );
	if ( $the_team->have_posts() ) :
		if($layout == 'experienced')
		{
			$output .= '<div class="row '.esc_attr($el_class).'">';
				while ( $the_team->have_posts() ): 
					$the_team->the_post(); 
					$count++;
					$designation = get_post_meta(get_the_ID(), 'team_designation', true );
					$output .='<div class="'.esc_attr($col_class).' experience-team ">
// 									<a href="'.get_permalink().'" class="enitre_mouse">
									<a href="''" class="enitre_mouse">
									<div class="shadow_effect effect-apollo"> 
										'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive')).'
									</div>
									</a>
									<h5>'.get_the_title().'</h5>
									<span class="designation">'.esc_attr($designation).'</span>
									<hr>
									<p class="line-height26 fnt-16">'.get_the_excerpt().'</p>
								</div>';
				endwhile;
			$output .= '</div>';			
		}
		elseif($layout == 'company')
		{
				while ( $the_team->have_posts() ): 
					$the_team->the_post(); 
					$count++;
					$designation = get_post_meta(get_the_ID(), 'team_designation', true );
					$facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
					$twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
					$google = get_post_meta(get_the_ID(), 'tmc_google', true );
					$linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true );
					$output .='<div class="'.esc_attr($col_class).' team-list text-center '.esc_attr($el_class).'">
					
                  <div class="dedicated-team-img-holder">
                     <span class="default_hidden">
				'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'zoom_img_effect')).'
					 </span>
                     <div class="overlay">
                        <div class="inner-holder">
                           <ul>';
                           
                           if($facebook)
                              $output .='<li><a href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a></li>';
                              
                            if($twitter)
                              $output .='<li><a href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a></li>';
                              
                            if($google)
                              $output .='<li><a href="'.esc_attr($google).'"><i class="fa fa-linkedin"></i></a></li>';
                              
                             if($linkedin)
                              $output .='<li><a href="'.esc_attr($linkedin).'"><i class="fa fa-google-plus"></i></a></li>';
                        
							$output .='</ul>
							   </div>
							</div>
						</div>
					<h5>'.get_the_title().'</h5>
					<p>'.esc_attr($designation).'</p>
				</div>';
							
				endwhile;
		}
		elseif($layout == 'demo2')
		{
		$output .= '
		    <div class="ourTeam">';
				while ( $the_team->have_posts() ): 
						$the_team->the_post(); 
						$count++;
						$designation = get_post_meta(get_the_ID(), 'team_designation', true );
						$facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
						$twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
						$google = get_post_meta(get_the_ID(), 'tmc_google', true );
						$linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true );
						$output .='
						<div class="'.esc_attr($col_class).' '.esc_attr($el_class).'">
							<div class="singleTeam">
			                    <div class="teamImage image_hover">
							        '.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'imgEffect zoom_img_effect ')).'
			                     ';
					$output .=' </div>
					            <div class="teamContent">
									<h3>'.get_the_title().'</h3>
									<p>'.esc_attr($designation).'</p>
									<div class="teamSocial">';
				                           if($facebook)
				                              $output .='<a class="fb" href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a>';
				                            if($twitter)
				                              $output .='<a class="twt" href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a>';
				                            if($google)
				                              $output .='<a class="lnkin" href="'.esc_attr($google).'"><i class="fa fa-linkedin"></i></a>';
				                             if($linkedin)
				                              $output .='<a class="insta" href="'.esc_attr($linkedin).'"><i class="fa fa-instagram"></i></a>';
						 $output .='</div>
					            </div>
					        </div>
				        </div>
				        ';
					endwhile;
		$output .= '
		    </div>';
		}
		else
		{
			$output .= '
		    <div class="demo3Team">';
				while ( $the_team->have_posts() ): 
						$the_team->the_post(); 
						$count++;
						$designation = get_post_meta(get_the_ID(), 'team_designation', true );
						$facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
						$twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
						$google = get_post_meta(get_the_ID(), 'tmc_google', true );
						$linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true );
						$output .='
						<div class="'.esc_attr($col_class).' '.esc_attr($el_class).'">
							<div class="demo3SingleTeam">
			                    <div class="demo3TeamImage"><a>'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'imgEffect')).'</a>
			                     <div class="demo3TeamTitle">
									<h3>'.get_the_title().'</h3>
									<p>'.esc_attr($designation).'</p>
								</div>';
					    $output .=' 
					            </div>
					            <div class="demo3TeamBottom">
						            <div class="teamLine"></div>
						            <div class="demo3TeamContent">';
			                            if($facebook)
			                              $output .='<a class="fb" href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a>';
			                            if($twitter)
			                              $output .='<a class="twt" href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a>';
			                            if($google)
			                              $output .='<a class="lnkin" href="'.esc_attr($google).'"><i class="fa fa-linkedin"></i></a>';
			                            if($linkedin)
			                              $output .='<a class="insta" href="'.esc_attr($linkedin).'"><i class="fa fa-instagram"></i></a>';
					      $output .='</div>
				                </div>
					        </div>
				        </div>
				        ';
					endwhile;
		$output .= '
		    </div>';
		}
	else:
		$output .= translate('Sorry, there is no team under your selected page.', 'indofact');
	endif;
	wp_reset_postdata();
	echo translate($output);
?>