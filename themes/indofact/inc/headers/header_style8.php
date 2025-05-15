<?php 	global $tmc_option; 
		$stickyclass = '';
		if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
		{
			$stickyclass = 'header_not_sticky';
		}
		?>
<header class="header4 header7 header8">
   <?php 
   if(isset($tmc_option['header8_top_switch']) && $tmc_option['header8_top_switch'] == 1) 
   {	?>
		<div class="hdr-top-bar">
			<div class="container">
				<ul class="header-info">
					<?php if(isset($tmc_option['header8_phn_icon']) && $tmc_option['header8_phn_icon'] != '' || isset($tmc_option['header8_phn']) && $tmc_option['header8_phn'] != '' ):?>
						<li class="<?php echo esc_attr($tmc_option['header8_phn_icon']); ?>">
							<?php echo esc_attr($tmc_option['header8_phone_title']).': ' ?><a href="tel:<?php echo str_replace(' ', '', esc_attr($tmc_option['header8_phn']));?>"><?php echo '+'.esc_attr($tmc_option['header8_phn']); ?></a>
						</li>
						<?php endif; 
						if(isset($tmc_option['header8_email_icon']) && $tmc_option['header8_email_icon'] != '' || isset($tmc_option['header8_email']) && $tmc_option['header8_email'] != '' ):
						?>
						<li class="<?php echo esc_attr($tmc_option['header8_email_icon']); ?>">
							<a href="mailto:<?php echo esc_attr($tmc_option['header8_email']);?>"><?php echo esc_attr($tmc_option['header8_email']); ?></a>
						</li>
						<?php endif; ?>
				</ul>
				<div class="hdr3-right hdr4-right">
				<?php 	if( !empty( $tmc_option['header8_social'] ) && $tmc_option['header8_social'] == '1'):
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
			<?php					endif;
							endif;
						endif;
				if(isset($tmc_option['search_header8']) && $tmc_option['search_header8'] == 1) 
				{ ?>
					<div class="search-column">
						<button name="search" type="button" class="search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg">
						</button>
					</div>    
		       <?php 	
		        } ?>
				<button class="sideOpenbtn sidebarDeskButton" onclick="openSideNav()">
					<span class="sr-only"><?php echo esc_html__('Toggle navigation','indofact'); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			    </button>
				</div>
			</div>
		</div>  
	<?php 
	}	?>		
    <nav id="main-navigation-wrapper" class="navbar navbar-default <?php echo esc_attr($stickyclass); ?>">
      <div class="container">
        <div class="navbar-header">
			 <div class="logo-menu">
				<?php	
					if (isset($tmc_option['mobile_logo_eight']['url'] ) && !empty($tmc_option['mobile_logo_eight']['url'])):
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $tmc_option['mobile_logo_eight']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
				</a>
				<?php
					else: 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php endif; ?>
			</div>
          <button type="button" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false" class="navbar-toggle collapsed">
		  <span class="sr-only">
			<?php 
				echo esc_html__('Toggle navigation','indofact'); 
			?>
		  </span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
		  </button>
        </div>
        <div id="main-navigation" class="collapse navbar-collapse nav4">
        	<?php 
				if (isset($tmc_option['logo_eight']['url'] ) && !empty($tmc_option['logo_eight']['url'])):	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_none">
						<img src="<?php echo esc_url( $tmc_option['logo_eight']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php 
					else: 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_none"><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php endif; 
				if (isset($tmc_option['sticky_eight']['url'] ) && !empty($tmc_option['sticky_eight']['url'])):		?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_logo">
						<img src="<?php echo esc_url( $tmc_option['sticky_eight']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php
					else: 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_logo"><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php endif; ?>
				<div class="menuSecheader7">
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

					if(isset($tmc_option['search_header8']) && $tmc_option['search_header8'] == 1) 
					{ ?>
						<div class="search-column">
							<button name="search" type="button" class="search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg">
							</button>

						</div>    
			       <?php 	
			        } ?>
	
				<button class="sideOpenbtn sidebarRespButton" onclick="openSideNav()">
					<span class="sr-only"><?php echo esc_html__('Toggle navigation','indofact'); ?></span>
					<span class="ic-bar"></span>
					<span class="ic-bar"></span>
					<span class="ic-bar"></span>
				</button>
                </div>
        </div>
      </div>
    </nav>
    <div class="headerSidebar" id="headerSidebar">
		<div class="sidebar">
			<div class="sideCloseButton">
			    <a href="javascript:void(0)" class="sideClosebtn" onclick="closeSideNav()">×</a>
		    </div>
			<div class="sideLogo">
			   <?php 
				if (isset($tmc_option['header8_logo_sidebar']['url'] ) && !empty($tmc_option['header8_logo_sidebar']['url'])):	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
						<img src="<?php echo esc_url( $tmc_option['header8_logo_sidebar']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php 
					else: 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class=""><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php endif; ?> 
			</div><br>
			<?php if(isset($tmc_option['header8_sidebar_text']) && $tmc_option['header8_sidebar_text'] != '' ){ ?>
			<p class="textQuote"><?php echo esc_attr($tmc_option['header8_sidebar_text']);?></p>
		    <?php } ?>
			<div class="iconArea">
				<div class="row">
					<div class="col-md-2"><i class="fas fa-globe"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header8_sidebar_addrr_1']) && $tmc_option['header8_sidebar_addrr_1'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header8_sidebar_addrr_1']);?></u></h5>
						<?php 
					    }
					    if(isset($tmc_option['header8_sidebar_addrr_2']) && $tmc_option['header8_sidebar_addrr_2'] != '' ){ ?>
						<p><?php echo esc_attr($tmc_option['header8_sidebar_addrr_2']);?></p>
					    <?php } ?>
					</div>
					<div class="col-md-2"><i class="fas fa-phone-volume"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header8_phn']) && $tmc_option['header8_phn'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header8_phone_title']).': '.esc_attr($tmc_option['header8_phn']); ?></u></h5>
						<?php 
						}
						if(isset($tmc_option['header8_sidebar_callus_days']) && $tmc_option['header8_sidebar_callus_days'] != '' ){ ?>
						<p>(<?php echo esc_attr($tmc_option['header8_sidebar_callus_days']);?>)</p>
					    <?php } ?>
					</div>
					<div class="col-md-2"><i class="far fa-clock"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header8_sidebar_meeting_days']) && $tmc_option['header8_sidebar_meeting_days'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header8_sidebar_meeting_days']);?></u></h5>
						<?php 
					    }
						if(isset($tmc_option['header8_sidebar_meeting_time']) && $tmc_option['header8_sidebar_meeting_time'] != '' ){ ?>
						<p>(<?php echo esc_attr($tmc_option['header8_sidebar_meeting_time']);?>)</p>
					   <?php } ?>
					</div>
				</div>
			</div>
			<div class="contactButton">
				<?php 	if((isset($tmc_option['header8_sidebar_request_btn']) && $tmc_option['header8_sidebar_request_btn'] == 1) && class_exists( 'Redux' ))
				{
					if(isset($tmc_option['header8_request_contact']) && $tmc_option['header8_request_contact'] != '') 
					{ ?>
					<div class="">
						<a class="header-contctbtn hvr-bounce-to-right " href="<?php echo esc_url(get_permalink($tmc_option['header8_request_contact']));?>"><i class="fas fa-location-arrow"></i><?php echo get_the_title($tmc_option['header8_request_contact']);?></a>
					</div>
		        <?php 
		        }
					else if(isset($tmc_option['header8_request_contact_link']) && isset($tmc_option['header8_request_contact_text']))
					{ ?>
					<div class="">
						<a class="header-contctbtn hvr-bounce-to-right " href="<?php echo esc_attr($tmc_option['header8_request_contact_link']);?>"><i class="fas fa-location-arrow"></i><?php echo esc_attr($tmc_option['header8_request_contact_text']);?></a>
					</div>
		        <?php
		            }
				} ?>
			</div>
				<?php 
				if( !empty( $tmc_option['header8_social'] ) && $tmc_option['header8_social'] == '1'):
					if( !empty( $tmc_option['enable_social'] )):
						$socials = tmc_get_socials( 'enable_social' );	
						if ( $socials): ?>
							<div class="sideBarSocial"> 
								<?php foreach( $socials as $key => $val ): ?>
									<a href="<?php echo esc_url( $val ); ?>">
										<i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i>
									</a>
								<?php endforeach; ?> 
							</div>
			         <?php	
			            endif;
					endif;
				endif;?>
		</div>
	</div>
</header>