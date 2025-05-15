<?php
	$atts = vc_map_get_attributes( 'tmc_news', $atts );
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
		$col_class = "col-xs-12 col-sm-6 col-md-4";
	}
	$args = array(
					'post_type' 	 => 'post',
					'post_status' 	 => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_news = new WP_Query( $args );
	
	if($layout == 'layout1')
	{
		if ( $the_news->have_posts() ) :
			$output .='<div class="row">';
				while ( $the_news->have_posts() ): 
					$the_news->the_post(); 
					$count++;
					$author= get_the_author();
					$output .=' <div class="'.esc_attr($col_class).' news-column '.esc_attr($el_class).'">
                  <a href="'.get_the_permalink().'" class="enitre_mouse">
                     <div class="shadow_effect effect-apollo"> 
					 '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')).'
					 </div>
                  </a>
                  <div class="yellow-strip">
                     <div class="news-time">
                        <h5>'.get_the_date("d").'</h5>
                        <span>'.get_the_date("M").'</span>
                     </div>
                     <ul>
                        <li>'.esc_attr($by).' '.substr(esc_attr($author), 0, $by_lmt).'</li>
                        <li>'.esc_attr($cmt).' '.get_comments_number( get_the_ID() ).'</li>
                     </ul>
                  </div>
                  <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                  <p class="line-height26"> '.get_the_excerpt().'</p>
               </div>';
				endwhile;
			$output .='</div>';
		else:
			$output .= esc_html__('Sorry, there is no news under your selected page.', 'indofact');
		endif;
	}
	elseif ($layout == 'layout2')
	{
		if ( $the_news->have_posts() ) :
			$output .='<div class="row">';
				while ( $the_news->have_posts() ): 
					$the_news->the_post(); 
					$count++;
					$author= get_the_author();
					$output .=' <div class="'.esc_attr($col_class).' news-column '.esc_attr($el_class).'">
                  <a href="'.get_the_permalink().'" class="enitre_mouse">
                     <div class="shadow_effect effect-apollo"> 
					 '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')).'
					 </div>
                  </a>	  
                  <div class="yellow-strip-lay2">
				  <div class="datedisplay">
                    <h5>'.get_the_date("d").'</h5>
                        <span>'.get_the_date("M").'</span>
                  </div>
				  </div>
				  <div class="news-lower-lay2">
                  <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                  <p class="line-height26">'.get_the_excerpt().'</p>
				    <ul>
                       <li>By: admin</li>
                       <li>Comments: 0</li>
                    </ul>
				  </div>
               </div>';
				endwhile;
			$output .='</div>';
		else:
			$output .= esc_html__('Sorry, there is no news under your selected page.', 'indofact');
		endif;
	}
	elseif ($layout == 'layout3')
	{
		if ( $the_news->have_posts() ) :
			$output .=
			'<div class="newsArea">
			    <div class="row">';
                    while ( $the_news->have_posts() ): $the_news->the_post();$count++;
                    if($count == 1)
                    {
				    $output .= 
				    '<div class="col-md-6 col-sm-6 col-xs-12 detailNews">
				        <div class="newsImg">
				        '.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'nwsImg')).'
				        </div>
				        <div class="row newsData">
							    <div class="col-md-3 col-sm-3 col-xs-3">
	                                <div class="newsDate">
	                                    <h5>'.get_the_date("d").'</h5>
	                                    <span>'.get_the_date("M").'</span>
	                                </div>
							    </div>
							    <div class="col-md-9 col-sm-9 col-xs-9">
							        <div class="newsContent">
									    <div class="newsAuth">
										    <ul>
						                        <li><a href="#"><i class="fa fa-user"></i>By: '.get_the_author().'</a></li>
											    <li><a href="#"><i class="fa fa-comment-o"></i>Comment: '.get_comments_number().'</a></li>
						                    </ul>
									    </div>
								        <p class="newsTitle"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>
								    </div>
					            </div>
				            </div>
				    </div>';
				    }
				    endwhile;
			       $output .= 
			       '<div class="col-md-6 col-sm-6 col-xs-12">
					    ';
						while ( $the_news->have_posts() ): $the_news->the_post();$count++;
						$output .=
						   '<div class="row newsData">
							    <div class="col-md-3 col-sm-3 col-xs-3">
	                                <div class="newsDate">
	                                    <h5>'.get_the_date("d").'</h5>
	                                    <span>'.get_the_date("M").'</span>
	                                </div>
							    </div>
							    <div class="col-md-9 col-sm-9 col-xs-9">
							        <div class="newsContent">
									    <div class="newsAuth">
										    <ul>
						                        <li><a href="#"><i class="fa fa-user"></i>By: '.get_the_author().'</a></li>
											    <li><a href="#"><i class="fa fa-comment-o"></i>Comment: '.get_comments_number().'</a></li>
						                    </ul>
									    </div>
								        <p class="newsTitle"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>
								    </div>
					            </div>
				            </div>';		
						endwhile;
		 $output .='    
		           </div>
				</div>
			</div>';
		else:
			$output .= esc_html__('Sorry, there is no news under your selected page.', 'indofact');
		endif;
	}
	elseif ($layout == 'layout4')
	{
		if ( $the_news->have_posts() ) :
			$output .='
			<div class="home7News">
				<div class="row">';
					while ( $the_news->have_posts() ): $the_news->the_post(); $count++;
					
					$shortdesc = limit_words(get_the_excerpt(), '16');
					$output .=
					'<div class="'.esc_attr($col_class).' '.esc_attr($el_class).'">
					    <div class="home7SingleNews">
		                    <div class="shadow_effect effect-apollo"> 
							 '.get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')).'
							</div>
			                <div class="home7_news_content">
			                    <div class="dateArea">
				                     <p class="date"><i class="fa fa-calendar"></i>'.get_the_date("M").' '.get_the_date("d").', '.get_the_date("Y").'</p>
				                     <p class="auth"><i class="fa fa-user"></i>'.get_the_author().'</p>
			                     </div>
			                     <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
			                     <p>'.$shortdesc.'</p>
			                </div>
			            </div>
				    </div>';
					endwhile;
				$output .=
				'</div>
			</div>';
		else:
			$output .= esc_html__('Sorry, there is no news under your selected page.', 'indofact');
		endif;
	}
	
	wp_reset_postdata();
	echo translate($output);
?>