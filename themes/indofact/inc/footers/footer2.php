<?php global $tmc_option; 
		$metaData = '';
		$metaData = postType();

		$backStyle = '';
		$backGround = array();
		if ( !empty($metaData) && $metaData['footer-background-image'] != '' )
		{
			$backGround[] = 'background-image: url('.wp_get_attachment_url($metaData['footer-background-image']).');';
		}
		if ( !empty($metaData) && $metaData['footer-background-color'] != '' )
		{
			$backGround[] = 'background-color: '.$metaData['footer-background-color'].';';
		}
		if ( !empty($metaData) && $metaData['footer-image-repeat'] != '' )
		{
			$backGround[] = 'background-repeat: '.$metaData['footer-image-repeat'].';';
		}
		if ( !empty($metaData) && $metaData['footer-image-size'] != '' )
		{
			$backGround[] = 'background-size: '.$metaData['footer-image-size'].';';
		}
		if ( !empty($metaData) && $metaData['footer-image-position'] != '' )
		{
			$backGround[] = 'background-position: '.$metaData['footer-image-position'].';';
		}
		if ( !empty($metaData) && $metaData['footer-image-attachment'] != '' )
		{
			$backGround[] = 'background-attachment: '.$metaData['footer-image-attachment'].';';
		}
		$backStyle = implode('', $backGround);
		if(empty($backStyle))
		{
			$backStyle = '';
			if(isset($tmc_option['footer2_widget']) && $tmc_option['footer2_widget'] == '1') 
			{ 
				$backStyle = backgroundStyle('footer2_bg');
				$backStyle = implode('', $backStyle);
			}
		}
		$footer_title_color = '#b6b6b7';
		if ( !empty($metaData) && $metaData['footer-title-color'] != '' )
		{
			$footer_title_color = ''.$metaData['footer-title-color'].';';
		}
		$footer_text_color = '#757575';
		if ( !empty($metaData) && $metaData['footer-text-color'] != '' )
		{
			$footer_text_color = ''.$metaData['footer-text-color'].';';
		}
	if($metaData['hide-footer'] != 'yes')
	{
		if (  class_exists( 'Redux' ) )
		{	$footerBg = ''; 
			if(!is_page('maintenance') && !is_page('coming-soon')): 
			if($tmc_option['footer2_widget'])
			{
			?>
				<footer class="footer2" style="<?php echo esc_attr($backStyle); ?>">
					<div class="ftr-section" style="<?php echo esc_attr($backStyle); ?>">
						<div class="container">
					<?php 	if($tmc_option['footer2_info_switch'])
							{ ?>
								<ul class="footer-info">
							<?php	if(isset($tmc_option['footer2_add_line_one']) && $tmc_option['footer2_add_line_one'] != '' || isset($tmc_option['footer2_add_line_two']) && $tmc_option['footer2_add_line_two'] != '' ):?>
										<li class="<?php echo esc_attr($tmc_option['footer2_add_icon']); ?>">
											<?php echo esc_attr($tmc_option['footer2_add_line_one']); ?> <br/> <?php echo esc_attr($tmc_option['footer2_add_line_two']); ?>
										</li>
							<?php 	endif; 
									if(isset($tmc_option['footer2_phn']) && $tmc_option['footer2_phn'] != ''): ?>
										<li class="<?php echo esc_attr($tmc_option['footer2_phn_icon']); ?>">
											<?php echo esc_attr($tmc_option['footer2_phn']); ?>
										</li>
							<?php 	endif; 
									if(isset($tmc_option['footer2_email']) && $tmc_option['footer2_email'] != ''):?>
										<li class="<?php echo esc_attr($tmc_option['footer2_email_icon']); ?>">
											<?php echo esc_attr($tmc_option['footer2_email']); ?>
										</li>
							<?php 	endif; 
									if(isset($tmc_option['footer2_time']) && $tmc_option['footer2_time'] != ''):?>
										<li class="<?php echo esc_attr($tmc_option['footer2_time_icon']); ?>">
											<?php echo esc_attr($tmc_option['footer2_time']); ?>
										</li>
							<?php 	endif; ?>		
								</ul>
					<?php	} 
							$footer2_sidebar_count = intval( $tmc_option['footer2_sidebar_count'] );
							$col = 12 / $footer2_sidebar_count;	?>
							<div class="row">
							<?php	for ( $count = 1; $count <= $footer2_sidebar_count; $count ++ ):
										if($count == 1)
										{
											$col_class = '4';
											$section_class = 'about-text';
										}											
										elseif($count == 2)
										{
											$col_class = '3';
											$section_class = 'sol-column';
										}
										elseif($count == 3)
										{	
											$col_class = '2';
											$section_class = 'link-column';
										}
										else
										{	
											$col_class = '3';
											$section_class = 'follow-column pull-right';
										}						?>
										<div class="col-md-<?php echo esc_attr($col_class); ?> col-sm-6 col-xs-12 ftr-<?php echo esc_attr($section_class); ?> col_width-<?php echo esc_attr($col); ?>">
											<?php
											if( is_active_sidebar( 'tmc-footer-'. $count) )
											{
												dynamic_sidebar( 'tmc-footer-'. $count );
											} 	
											?>
										</div> 
							<?php	endfor;
								?>
							</div>
					<?php 
					if($metaData['hide-copyright'] != 'yes')
					{
						if( isset($tmc_option['footer2_copyright_switch']) && $tmc_option['footer2_copyright_switch'] == '1' ): ?>
									<div class="footer-btm">
								<?php 	if( isset($tmc_option['footer2_copyright']) && $tmc_option['footer2_copyright'] != '' )
										{ ?>
											<div class="col-md-6 col-sm-6 col-xs-12 pad-left_zero pad-right_zero">
												<p><?php echo esc_attr($tmc_option['footer2_copyright']); ?></p>
											</div>
								<?php 	}
										if( isset($tmc_option['footer2_develop_text']) && $tmc_option['footer2_develop_text'] != '' )
										{ ?>		
											<div class="col-md-4 col-sm-6 col-xs-12 pad-left_zero pad-right_zero pull-right">
												<p class="text-right">
													<a href="<?php echo esc_url($tmc_option['footer2_develop_link']); ?>">
														<?php echo esc_attr($tmc_option['footer2_develop_text']); ?>
													</a>
												</p>
											</div>
								<?php 	} ?>
									</div> 
						<?php 	endif; 
					}	?>
						</div>
					</div>
				</footer>
	<?php	}
			endif;
		}
		else
		{ ?>
			<footer class="footer2">				
				<div class="ftr-section">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-sm-6 col-xs-12  ftr-about-text">
								<?php	
								if( is_active_sidebar( 'tmc-footer-1') )
								{
									dynamic_sidebar( 'tmc-footer-1' );
								} 
								?>
							</div>
							
							<div class="col-md-3 col-sm-6 col-xs-12 ftr-sol-column">
								<?php	
								if( is_active_sidebar( 'tmc-footer-2') )
								{
									dynamic_sidebar( 'tmc-footer-2' );
								} 
								?>
							</div>
							
							<div class="col-md-2 col-sm-6 col-xs-12 ftr-link-column">
								<?php	
								if( is_active_sidebar( 'tmc-footer-3') )
								{
									dynamic_sidebar( 'tmc-footer-3' );
								} 
								?>
							</div>							
							<div class="col-md-3 col-sm-6 col-xs-12 ftr-follow-column pull-right">
								<?php	
								if( is_active_sidebar( 'tmc-footer-4') )
								{
									dynamic_sidebar( 'tmc-footer-4' );
								} 
								?>
							</div>						
						</div>						
						   <div class="footer-btm">
                  <div class="col-md-6 col-sm-6 col-xs-12 pad-left_zero pad-right_zero">
                     <p><?php echo esc_html__( 'Copyright 2019 Indofact. All Rights Reserved.','indofact'); ?></p>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 pad-left_zero pad-right_zero pull-right">
                     <p class="text-right"><?php echo esc_html__( 'Developed by:','indofact'); ?> <a href="#"><?php echo esc_html__( 'ThemeChampion','indofact'); ?></a></p>
                  </div>
               </div>
					</div>
				</div>
			</footer>
	<?php
		}	
	}
	?>