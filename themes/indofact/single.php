<?php tmc_get_header();
	while(have_posts()) 
	{
			the_post(); 
			global $tmc_option;
			$tmc_layout = tmc_get_structure();	 
			echo wp_kses_post($tmc_layout['content_before']); ?>
				<div class="blog-list-cl mar-btmnone">
					<?php
						if( has_post_thumbnail( ) ) 
						{ ?>
							<div class="blog-img">
								<span class="image_hover ">
									<?php the_post_thumbnail( 'blog-large', array('class' => 'img-responsive zoom_img_effect') ); ?>
								</span>
					<?php 		if(isset($tmc_option['blogdetail_multi_checkbox']) && $tmc_option['blogdetail_multi_checkbox']['1'] == '1')
								{ ?>
									<div class="blog-timing">
										<h5><?php echo get_the_date("d"); ?></h5>
										<span><?php echo get_the_date("M y"); ?></span>
									</div>
						<?php 	}
								else
								{	?>
									<div class="blog-timing">
										<h5><?php echo get_the_date("d"); ?></h5>
										<span><?php echo get_the_date("M y"); ?></span>
									</div>
							
								<?php
								}
								?>
							</div>
				<?php	}
						
							$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
						?>
							<div class="blog-head">
								<?php the_title( sprintf( '<h6 class="wdt-100"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' ); 
								
								if(isset($tmc_option['blogdetail_metadata']))
								{
								?>
								<ul class="blog-wdt">
									<?php if($tmc_option['blogdetail_multi_checkbox']['1'] == '1')
									{ ?>
										<li class="date_icon"><?php echo get_the_date(''.get_option('date_format').''); ?></li>
							<?php 	}
									if($tmc_option['blogdetail_multi_checkbox']['2'] == '1')
									{ ?>
										<li class="author_icon"><?php the_author(); ?></li>
							<?php 	}
									if($tmc_option['blogdetail_multi_checkbox']['3'] == '1')
									{ 
										if(!empty($tags))
										{ ?>
											<li class="blog_icon">
										<?php 	foreach($tags as $postTags)
												{ ?>
													<span class="after_tag">
														<?php	echo esc_attr($postTags);  ?>
													</span>
										<?php	} ?>
											</li>
								<?php 	}
									} 
									?>
								</ul>
								<?php
								}
								else
								{
								?>
								<ul class="blog-wdt">
								<li class="date_icon"><?php echo get_the_date(); ?></li>
								<li class="author_icon"><?php the_author(); ?></li>
								<?php
								if(!empty($tags))
										{ ?>
											<li class="blog_icon">
										<?php 	foreach($tags as $postTags)
												{ ?>
													<span class="after_tag">
														<?php	echo esc_attr($postTags);  ?>
													</span>
										<?php	} ?>
											</li>
								<?php 	}
								?>
								</ul>
								<?php
								}
								?>
								<!-- </ul> -->
							</div>
				<?php 	
						the_content(); 
						wp_link_pages( array(
							'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:','indofact' ) . '</label>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '%',
							'separator'   => '',
						) );
						if (  class_exists( 'Redux' ) && isset($tmc_option) ) 
						{   
							if(isset($tmc_option['switch_comments']) && $tmc_option['switch_comments'] == 1 ) 
							{ 
								if ( comments_open() || get_comments_number() ) 
								{ ?>
									<div class="leave-reply-column">
										<?php comments_template(); ?>
									</div>
						<?php	} 
							} 
						} 
						else 
						{
							if ( comments_open() || get_comments_number() ) 
							{ ?>
								<div class="leave-reply-column">
									<?php comments_template(); ?>
								</div>
					<?php	} 
						} ?>
				</div>
	<?php 	
	echo wp_kses_post($tmc_layout['content_after']);
	echo wp_kses_post($tmc_layout['sidebar_before']); 
	tmc_create_sidebar();
	echo wp_kses_post($tmc_layout['sidebar_after']);
	}
get_footer(); ?>