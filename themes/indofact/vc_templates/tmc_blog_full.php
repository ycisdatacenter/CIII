<?php
	$atts = vc_map_get_attributes( 'tmc_blog_full', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
	$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );
		
	if ( $the_service->have_posts() ) :

		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
				if($layout == 'full')
				{		
				
	$output .= '<div class="col-md-12 blog-list-cl">
                  <div class="blog-img">
                     <span class="image_hover ">
                     <a href="'.get_the_permalink().'">
					 '. get_the_post_thumbnail( get_the_ID(), 'blog-large', array('class' => 'img-responsive zoom_img_effect') ) .'
                     </a>
                     </span>
                     <div class="blog-timing">
                        <h5>'.get_the_date("d").'</h5>
                        <span>'.get_the_date("M").'</span>
                     </div>
                  </div>
                  <div class="blog-head">
                     <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                     <ul>
                        <li class="date_icon">'.get_the_date("M d,Y").'</li>
                        <li class="author_icon">'.get_the_author().'</li>
                        <li class="blog_icon">'.esc_html__( 'BLOG','indofact' ).'</li>
                     </ul>
                  </div>
                  <p>'.get_the_content().'
				  <a href="'.get_the_permalink().'"></a>
				  </p>
               </div>';	

				} else{

				$output .= '<div class="col-md-9 col-sm-12">
						<div class="normall blogs completeblog">
							<div class="portfolioHover">
								<div class="image-opacity-on-hover image-zoom-on-hover">
									'. get_the_post_thumbnail( get_the_ID(), 'large', array('class' => 'img-responsive') ) .'
								</div>
								<div class="date">
									<h5>'.get_the_date("d").'</h5>
									<span>'.get_the_date("F").'</span>
								</div>
							</div>

							<div class="blog_withoutside">
								<div class="blogInfo">
									<p><i class="fa fa-user"></i> 
										'.esc_html__('By: ','indofact').''.get_the_author().'
									</p>
									<p><i class="fa fa-tag"></i> 
										'.implode( ', ', wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ) ).'    
									</p>
									<p><i class="fa fa-comments-o"></i> 
										.'.esc_html__('Comments: ','indofact').'<span> '.get_comments_number().'</span>
									</p>
								</div>
								<h3 class="h3 blog-title">
									'.get_the_title().'
								</h3>
								<div class="blog-content">
									<p>'.get_the_excerpt().'</p>
								</div>
								<div class="wrapper-inner-tab-backgrounds-first">
									<a href="'.get_the_permalink().'">
									   <div class="sim-button button6 yellowbtn">
										<span>'.esc_html__('Read more','indofact').'</span>
									   </div>
									</a>
								</div>
							</div>
						</div>
					</div>';
				}
		endwhile;

		$output .= '</div>
        		</div>';
		

		else:
			$output .= esc_html__( 'Sorry, there is no child pages under your selected page.', 'indofact' );
	endif;
	
	wp_reset_postdata();
	echo translate($output);
?>