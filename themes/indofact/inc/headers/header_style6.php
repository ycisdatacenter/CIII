<?php 	global $tmc_option; 
		$stickyclass = '';
		if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
		{
			$stickyclass = 'header_not_sticky';
		}
		?>
<header class="header6">
	<div class="headerTopSec">
		<div class="container">
		    <div class="row">                       
		        <div class="col-md-7 col-sm-12 col-xs-12 topSecLeft "> 
        			<?php if(isset($tmc_option['header6_phn']) && $tmc_option['header6_phn'] != '')
        			{ ?>
        			<h3><?php echo esc_attr($tmc_option['header6_top_text']); ?></h3>
        		   <?php 
        		    } ?>
		        </div> 
		        <div class="col-md-5 col-sm-12 col-xs-12 topSecRight "> 
		        		<?php 	
		        		if( !empty( $tmc_option['header6_social'] ) && $tmc_option['header6_social'] == '1')
                        {
							if( !empty( $tmc_option['enable_social'] ))
							{
								$socials = tmc_get_socials( 'enable_social' );	
								if ( $socials)
								{ ?>
									<div class="header6Social"> 
										<?php foreach( $socials as $key => $val ): ?>
											<a href="<?php echo esc_url( $val ); ?>">
												<i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i></a> 
											<?php endforeach; ?>
									</div> 
						<?php	}
							}
						} 
						if(isset($tmc_option['search_header6']) && $tmc_option['search_header6'] == 1) 
						{	?>			  
							  <div class=" search-fl">
								<button name="search" type="button" class="search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg"></button> 
							  </div>
					    <?php 
					    } ?>
						<button class="sideOpenbtn sidebarRespButton" onclick="openSideNav()">
							<span class="sr-only">Toggle navigation</span>
							<span class="ic-bar"></span>
							<span class="ic-bar"></span>
							<span class="ic-bar"></span>
						</button> 
		        </div>           
		    </div>
	    </div> 
	</div>
	<div class="headerMiddleSec">
	    <div class="container">
		    <div class="row">                       
		        <div class="col-md-4 col-sm-4 col-xs-12 logoSec "> 
		        	<?php	
							if (isset($tmc_option['logo_header6']['url'] ) && !empty($tmc_option['logo_header6']['url']))
							{ ?>
			          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
							    <img src="<?php echo esc_url( $tmc_option['logo_header6']['url'] ); ?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>">
						    </a>       
						  <?php 
							}
						  else
						  { ?> 
						  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><h4><?php bloginfo( 'name' ); ?></h4></a>     
					  <?php } ?>
		        </div>
		        <div class="col-md-8 col-sm-8 col-xs-12 addressSec "> 
		        	<ul class="header-info">
					<?php if(isset($tmc_option['header6_phn']) && $tmc_option['header6_phn'] != '' || isset($tmc_option['header6_phone_title']) && $tmc_option['header6_phone_title'] != '' ):?>
							<li class="phnClass <?php echo esc_attr($tmc_option['header6_phn_icon']); ?>">
								<b><?php echo esc_attr($tmc_option['header6_phone_title']); ?></b><br/>
								<a href="tel:<?php echo str_replace(' ', '', esc_attr($tmc_option['header6_phn']));?>"><?php echo '+'.esc_attr($tmc_option['header6_phn']); ?></a>
							</li>
						<?php endif; ?>
						<?php if(isset($tmc_option['header6_add_line_one']) && $tmc_option['header6_add_line_one'] != '' || isset($tmc_option['header6_add_line_two']) && $tmc_option['header6_add_line_two'] != '' ):?>
							<li class="<?php echo esc_attr($tmc_option['header6_add_icon']); ?>"><b><?php echo esc_attr($tmc_option['header6_add_line_one']); ?></b><br/><?php echo esc_attr($tmc_option['header6_add_line_two']); ?></li>
						<?php endif; ?>
						
	                </ul>
		        </div> 
		    </div>      
	    </div> 
    </div>   
    <nav id="main-navigation-wrapper" class="navbar navbar-default navbar2-wrap <?php echo esc_attr($stickyclass); ?>">
      <div class="container">
        <div class="navbar-header">
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
        <div class="var2-nav">
			<div id="main-navigation" class="collapse navbar-collapse ">
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
			    

		if(isset($tmc_option['request_btn']) && $tmc_option['request_btn'] == 1) 
		{
			if(isset($tmc_option['header6_request_quote']) && $tmc_option['header6_request_quote'] != '') 
			{ ?>
			  <a class="header-requestbtn header2-requestbtn" href="<?php echo esc_url(get_permalink($tmc_option['header6_request_quote']));?>"><?php echo get_the_title($tmc_option['header6_request_quote']);?></a>    
	<?php 	}
			else
			{ ?>
			 <a class="header-requestbtn header2-requestbtn" href="<?php echo esc_attr($tmc_option['header6_request_quote_link']);?>"><?php echo esc_attr($tmc_option['header6_request_quote_text']);?></a> 
 <?php 		}
		}
		?>
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
				if (isset($tmc_option['header6_logo_sidebar']['url'] ) && !empty($tmc_option['header6_logo_sidebar']['url'])):	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
						<img src="<?php echo esc_url( $tmc_option['header6_logo_sidebar']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php 
					else: 
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><h4><?php bloginfo( 'name' ); ?></h4></a>
				<?php endif; ?> 
			</div><br>
			<?php if(isset($tmc_option['header6_sidebar_text']) && $tmc_option['header6_sidebar_text'] != '' ){ ?>
			<p class="textQuote"><?php echo esc_attr($tmc_option['header6_sidebar_text']);?></p>
		    <?php } ?>
			<div class="iconArea">
				<div class="row">
					<div class="col-md-2"><i class="fas fa-globe"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header6_sidebar_addrr_1']) && $tmc_option['header6_sidebar_addrr_1'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header6_sidebar_addrr_1']);?></u></h5>
						<?php 
					    }
					    if(isset($tmc_option['header6_sidebar_addrr_2']) && $tmc_option['header6_sidebar_addrr_2'] != '' ){ ?>
						<p><?php echo esc_attr($tmc_option['header6_sidebar_addrr_2']);?></p>
					    <?php } ?>
					</div>
					<div class="col-md-2"><i class="fas fa-phone-volume"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header6_phn']) && $tmc_option['header6_phn'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header3_phone_title']).': '.esc_attr($tmc_option['header6_phn']); ?></u></h5>
						<?php 
						}
						if(isset($tmc_option['header6_sidebar_callus_days']) && $tmc_option['header6_sidebar_callus_days'] != '' ){ ?>
						<p>(<?php echo esc_attr($tmc_option['header6_sidebar_callus_days']);?>)</p>
					    <?php } ?>
					</div>
					<div class="col-md-2"><i class="far fa-clock"></i></div>
					<div class="col-md-10">
						<?php if(isset($tmc_option['header6_sidebar_meeting_days']) && $tmc_option['header6_sidebar_meeting_days'] != '' ){ ?>
						<h5><u><?php echo esc_attr($tmc_option['header6_sidebar_meeting_days']);?></u></h5>
						<?php 
					    }
						if(isset($tmc_option['header6_sidebar_meeting_time']) && $tmc_option['header6_sidebar_meeting_time'] != '' ){ ?>
						<p>(<?php echo esc_attr($tmc_option['header6_sidebar_meeting_time']);?>)</p>
					   <?php } ?>
					</div>
				</div>
			</div>
			<div class="contactButton">
				<?php 	if((isset($tmc_option['header6_sidebar_request_btn']) && $tmc_option['header6_sidebar_request_btn'] == 1) && class_exists( 'Redux' ))
				{
					if(isset($tmc_option['header6_request_contact']) && $tmc_option['header6_request_contact'] != '') 
					{ ?>
					<div class="">
						<a class="header-contctbtn hvr-bounce-to-right" href="<?php echo esc_url(get_permalink($tmc_option['header6_request_contact']));?>"><i class="fas fa-location-arrow"></i><?php echo get_the_title($tmc_option['header6_request_contact']);?></a>
					</div>
		        <?php 
		        }
					else if(isset($tmc_option['header6_request_contact_link']) && isset($tmc_option['header6_request_contact_text']))
					{ ?>
					<div class="">
						<a class="header-contctbtn hvr-bounce-to-right" href="<?php echo esc_attr($tmc_option['header6_request_contact_link']);?>"><i class="fas fa-location-arrow"></i><?php echo esc_attr($tmc_option['header6_request_contact_text']);?></a>
					</div>
		        <?php
		            }
				} ?>
			</div>
				<?php 
				if( !empty( $tmc_option['header6_social'] ) && $tmc_option['header6_social'] == '1'):
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