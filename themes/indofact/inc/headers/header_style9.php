<?php
global $tmc_option;
$stickyclass = '';
if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
{
	$stickyclass = 'header_not_sticky';
} 
?>
<header class="header9 ">
  		<div class="header9_left">
        <?php 
				if (isset($tmc_option['header9_logo']['url'] ) && !empty($tmc_option['header9_logo']['url'])){	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_none">
						<img src="<?php echo esc_url( $tmc_option['header9_logo']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php 
				}else{ 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_none"><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php 
			  } ?> 
  		</div>
  		<div class="header9_right">
  			<?php 
			  if(isset($tmc_option['header9_top_switch']) && $tmc_option['header9_top_switch'] == 1) 
			  {	?>
			  	<div class="hdr-top-bar">
			  		<ul class="header-info">
							<?php 
							if(isset($tmc_option['header9_phn_icon']) && $tmc_option['header9_phn_icon'] != '' || isset($tmc_option['header9_phn']) && $tmc_option['header9_phn'] != '' ){ ?>
								<li class="<?php echo esc_attr($tmc_option['header9_phn_icon']); ?>"><a href="tel:<?php echo str_replace(' ', '', esc_attr($tmc_option['header9_phn']));?>"><?php echo '+'.esc_attr($tmc_option['header9_phn']); ?></a></li>
								<?php 
							} 
							if(isset($tmc_option['header9_email_icon']) && $tmc_option['header9_email_icon'] != '' || isset($tmc_option['header9_email']) && $tmc_option['header9_email'] != '' ){ ?>
								<li class="<?php echo esc_attr($tmc_option['header9_email_icon']); ?>"><a href="mailto:<?php echo esc_attr($tmc_option['header9_email']);?>"><?php echo esc_attr($tmc_option['header9_email']); ?></a></li>
							<?php 
							} ?>
						</ul>
						<div class="header_social">
							<?php 	
							if( !empty( $tmc_option['header9_social'] ) && $tmc_option['header9_social'] == '1')
							{
								if( !empty( $tmc_option['enable_social'] )){
									$socials = tmc_get_socials( 'enable_social' );	
									if ( $socials){ ?>
										<div class="header-socials"> 
											<?php foreach( $socials as $key => $val ): ?>
												<a href="<?php echo esc_url( $val ); ?>">
													<i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i>
												</a>
											<?php endforeach; ?> 
										</div>
				        <?php		
				          }			
								}
						  } ?>
						</div>
			  	</div>
			  <?php 
			  } ?>
			  <nav id="main-navigation-wrapper" class="navbar navbar-default <?php echo esc_attr($stickyclass); ?>">
			  	<div class="sticky_logo_box sticky_logo">	
						<?php 
							if (isset($tmc_option['header9_sticky']['url'] ) && !empty($tmc_option['header9_sticky']['url'])):		?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo ">
									<img src="<?php echo esc_url( $tmc_option['header9_sticky']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
								</a>
							<?php
								else: 
							?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><h4><?php bloginfo( 'name' ); ?></h4></a>
							<?php endif; ?>
			  	</div>
		      <div class="navbar-header">
		      	<div class="mobile-logo-menu">
							<?php	
								if (isset($tmc_option['header9_mobile_logo']['url'] ) && !empty($tmc_option['header9_mobile_logo']['url'])):
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( $tmc_option['header9_mobile_logo']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
							</a>
							<?php
								else: 
							?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><h4><?php bloginfo( 'name' ); ?></h4></a>
							<?php endif; ?>
						</div>
		        <button type="button" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false" class="navbar-toggle collapsed">
						  <span class="sr-only">
							<?php echo esc_html__('Toggle navigation','indofact'); ?>
						  </span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
					  </button>
		      </div>
		      <div id="main-navigation" class="collapse navbar-collapse nav4">
						<div class="menuSecheader2">
							<?php
							wp_nav_menu( 
											  array(
												'menu_id' => 'Primary',
												'theme_location' => 'tmc-primary',
												'container'      => false,
												'depth'          => 9,
												'after'     	 => '<i class="fa fa-chevron-down"></i>',
												'menu_class'     => 'nav navbar-nav display_none'
												)
											);	

							if(isset($tmc_option['header9_search_header']) && $tmc_option['header9_search_header'] == 1) 
							{ ?>
								<div class="search-column">
									<button name="search" type="button" class="search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg">
									</button>
								</div>    
					    <?php 	
					    } ?>
			      </div>
			    </div>
		    </nav>
  		</div>
</header>