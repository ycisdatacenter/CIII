<?php 
tmc_get_header();
global $tmc_option, $sidebar_position;
 ?>
<div class="row">
<?php 
	$tmc_layout = tmc_get_structure();
	echo wp_kses_post($tmc_layout['content_before']); ?>
	<div class="<?php echo esc_attr( $tmc_layout['class'] ); ?>">
		<?php
			$posts_class = '';
			$paginate_links_data = paginate_links( array('type' => 'array') );
			if(empty( $paginate_links_data )) 
			{
				$posts_class .= ' no-paginate';
			}
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
			<?php
			if(have_posts()):
				while(have_posts()): 
					the_post();	?>
					<div class="blog-list-cl ">
						<?php if( has_post_thumbnail( ) ) 
								{ 	?>
									<div class="blog-img">									
										<span class="image_hover ">
											<?php the_post_thumbnail(); ?>
										</span>
										<?php 
										if(isset($tmc_option['blog_metadata']) && $tmc_option['blog_metadata'] == '1')
										{
											if(isset($tmc_option['blog_multi_checkbox']) && $tmc_option['blog_multi_checkbox'][1] == '1')
											{ ?>
												<div class="blog-timing">
													<h5><?php echo get_the_date("d"); ?></h5>
													<span><?php echo get_the_date("M y"); ?></span>
												</div>
								<?php 		}
										}
										else
										{ ?>
											<div class="blog-timing">
													<h5><?php echo get_the_date("d"); ?></h5>
													<span><?php echo get_the_date("M y"); ?></span>
											</div>
								<?php 	}  ?>
									</div>
				<?php			}
						
						if ('post' == get_post_type()):
								if('post' == get_post_type()):
									$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));	?>
										<div class="blog-head">
											<?php 
											if ( is_sticky( ) ) 
											{
												echo '<span class="genericon genericon-pinned"></span> ';
											}
											the_title( sprintf( '<h6 class="main_t"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' ); 
											
												if(isset($tmc_option['blog_metadata']))
												{ ?>
													<ul class="blog-wdt">
													<?php 
															if(isset($tmc_option['blog_multi_checkbox']) && $tmc_option['blog_multi_checkbox'][3] == '1')
															{ ?>
																<li class="date_icon"><?php echo get_the_date(''.get_option('date_format').''); ?></li>
													<?php 	}
															if(isset($tmc_option['blog_multi_checkbox']) && $tmc_option['blog_multi_checkbox'][2] == '1')
															{ ?>
																<li class="author_icon">
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo esc_html( get_the_author() );?></a></li>
													<?php 	} 
															if(isset($tmc_option['blog_multi_checkbox']) && $tmc_option['blog_multi_checkbox'][1] == '1')
															{ 
																if(!empty($tags))
																{ 
															    ?>
																<li class="blog_icon">
																<?php
																echo get_the_tag_list( '', __( ', ', 'indofact' ) );	
																	?>
																</li>
																<?php
																}
															} ?>
													</ul>
										<?php 	
											}
											else 
											{
												?>
												<ul class="blog-wdt">
													<li class="date_icon"><?php echo get_the_date(''.get_option('date_format').''); ?></li>
													<li class="author_icon"><?php the_author(); ?></li>
													<?php
													if(!empty($tags))
													{ ?>
														<li class="blog_icon">
															<?php 	
															foreach($tags as $postTags)
															{ 	?>
																<span class="after_tag">
																	<?php	echo esc_attr($postTags);  ?>
																</span>
																<?php	
															} ?>
														</li>
														<?php 	
													}	?>
												</ul>
												<?php	
											}	?>
										</div>
								<?php	endif;
											endif; 
											the_excerpt(); ?>
											<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link"><?php echo esc_html__('Read more','indofact');?></a>
											<?php
													wp_link_pages( array(
														'before' => '<div class="page-links">' . esc_html__( 'Pages:','indofact' ),
														'after'  => '</div>',
													) );
								?>
					</div>
					<?php
				endwhile;
					if (class_exists( 'Redux' )) 
					{
						if(isset($tmc_option['blog_pagination']) && $tmc_option['blog_pagination'] == '1')
						{ ?>
							<div class="pagination">
								<?php		echo paginate_links( array(
										'type'      => 'list',
										'prev_text' => '<i class="fa fa-angle-left"></i>',
										'next_text' => '<i class="fa fa-angle-right"></i>',
									) );
								?>
							</div>
				<?php	}
					}
					else
					{
						echo paginate_links( array(
							'type'      => 'list',
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						) );
					}
			 elseif ( is_search() ) : ?>
			<p><?php echo esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.','indofact' ); ?></p>
		<?php else : ?>
			<p><?php echo esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.','indofact' ); ?></p> 
		<?php	endif; ?>
		</div>
	</div>
<?php echo wp_kses_post($tmc_layout['content_after']); 
echo wp_kses_post($tmc_layout['sidebar_before']); 
tmc_create_sidebar();
echo wp_kses_post($tmc_layout['sidebar_after']); ?>
</div>
<?php get_footer(); ?>