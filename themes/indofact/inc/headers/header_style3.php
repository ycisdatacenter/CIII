<?php 	global $tmc_option; 
		$stickyclass = '';
		if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
		{
			$stickyclass = 'header_not_sticky';
		}
		?>
<header class="header3">    
    <div class="container">
		<div class="row">                      
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 display-block ">          
				<?php	
					if (isset($tmc_option['logo_header_three']['url'] )):
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?php echo esc_url( $tmc_option['logo_header_three']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
				</a>
				<?php 
					else: 
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php endif; ?>   
			</div>
			<div class="col-lg-3 col-md-9 col-sm-12 col-xs-12 hdr3-right">        
				<?php 	if( !empty( $tmc_option['header_social'] ) && $tmc_option['header_social'] == '1'):
							if( !empty( $tmc_option['enable_social'] )):
								$socials = tmc_get_socials( 'enable_social' );	
									if ( $socials): ?>
										<div class="header-socials"> 
											<?php foreach( $socials as $key => $val ): ?>
												<a href="<?php echo esc_url( $val ); ?>">
													<i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i>
												</a> 
											<?php endforeach; ?>  
										</div>
						<?php		endif;
								endif;
							endif;
					if(isset($tmc_option['search_header']) && $tmc_option['search_header'] == 1) 
					{ ?>
						<div class="search-column">
							<button name="search" type="button" class="search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg">
							</button>   
						</div>    
			<?php 	} ?>
			</div>            
		</div>        
    </div>
    <nav id="main-navigation-wrapper" class="navbar navbar-default navbar2-wrap navbar3-wrap">
		<div class="container">
			<div class="navbar-header">
				<?php	
					if (isset($tmc_option['mobile_logo_three']['url'] )):
				?>
				<div class="logo-menu">
					<img src="<?php echo esc_url( $tmc_option['mobile_logo_three']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</div>
				<?php 
					else: 
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
					<div class="logo-menu">
						<img src="<?php echo esc_url( $tmc_option['mobile_logo_three']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</div>
				<?php endif; ?>				
				<button type="button" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false" class="navbar-toggle collapsed">
					<span class="sr-only"><?php echo esc_html__('Toggle navigation','indofact'); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="var2-nav var3-nav">
				<div id="main-navigation" class="collapse navbar-collapse ">
				 <?php wp_nav_menu( 
							  array(
								'menu_id' => 'Primary',
								'theme_location' => 'tmc-primary',
								'container'      => false,
								'depth'          => 9,
								'after'     	 => '<i class="fa fa-chevron-down"></i>',
								'menu_class'     => 'nav navbar-nav display_none'
								)
							);
					if(isset($tmc_option['request_btn']) && $tmc_option['request_btn'] == 1) 
					{
						if(isset($tmc_option['request_quote']) && $tmc_option['request_quote'] != '') 
						{ ?>
							<a class="header-requestbtn header2-requestbtn header3-requestbtn hvr-bounce-to-right" href="<?php echo esc_url(get_permalink($tmc_option['request_quote']));?>"><?php echo get_the_title($tmc_option['request_quote']);?></a>	
				 <?php 	}
						else
						{ ?>
							<a class="header-requestbtn header2-requestbtn header3-requestbtn hvr-bounce-to-right" href="<?php echo esc_attr($tmc_option['request_quote_link']);?>"><?php echo esc_attr($tmc_option['request_quote_text']);?></a>
			 <?php 		}
					}
			?>
				</div>
			</div>
		</div>
    </nav>
</header>