<?php 	global $tmc_option; 
		$stickyclass = '';
		if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
		{
			$stickyclass = 'header_not_sticky';
		}
		?>
<header class="header2 header5">
    <div class="container">
      <div class="row">                      
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 display-block ">
					<?php	
						if (isset($tmc_option['logo_header_two']['url'] )):
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<img src="<?php echo esc_url( $tmc_option['logo_header_two']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
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
            <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12 pull-right">                
                <ul class="header-info">
					<?php if(isset($tmc_option['header_add_line_one']) && $tmc_option['header_add_line_one'] != '' || isset($tmc_option['header_add_line_two']) && $tmc_option['header_add_line_two'] != '' ):?>
						<li class="<?php echo esc_attr($tmc_option['header_add_icon']); ?>">
							<strong><?php echo esc_attr($tmc_option['header_add_line_one']); ?></strong><br/>
							<?php echo esc_attr($tmc_option['header_add_line_two']); ?>
						</li>
					<?php endif; 
					if(isset($tmc_option['header_phn']) && $tmc_option['header_phn'] != '' || isset($tmc_option['header_email']) && $tmc_option['header_email'] != '' ):?>
						<li class="<?php echo esc_attr($tmc_option['header_phn_icon']); ?>">
							<strong><?php echo esc_attr($tmc_option['header_phn']); ?></strong><br/>
							<?php echo esc_attr($tmc_option['header_email']); ?>
						</li>
					<?php endif; ?>
						</ul>
					<?php 	if( !empty( $tmc_option['header_social'] ) && $tmc_option['header_social'] == '1'):
							if( !empty( $tmc_option['enable_social'] )):
								$socials = tmc_get_socials( 'enable_social' );	
								if ( $socials): ?>
									<div class="header-socials">
										<?php foreach( $socials as $key => $val ): ?>
										<a href="<?php echo esc_url( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i></a> 
										<?php endforeach; ?>									
									</div>
						<?php	endif;
							endif;
						endif; ?>
            </div>        
        </div>
    </div>  
    <nav id="main-navigation-wrapper" class="navbar navbar-default navbar2-wrap <?php echo esc_attr($stickyclass); ?>">
      <div class="container">
        <div class="navbar-header">
          <div class="logo-menu">
			<?php	
					if (isset($tmc_option['mobile_logo_five']['url'] )):
				?>
				<img src="<?php echo esc_url( $tmc_option['mobile_logo_five']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php
					else: 
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
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
        
        <div id="main-navigation" class="collapse navbar-collapse nav5">
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
		if(isset($tmc_option['search_header']) && $tmc_option['search_header'] == 1) 
		{	?>
			<div class="search-column search-fl">
				<button name="search" type="button" class="search-btn black-search-btn"  data-toggle="modal" data-target=".bs-example-modal-lg">
				</button>  
			</div>
          <?php 	
		}	
		if(isset($tmc_option['request_btn']) && $tmc_option['request_btn'] == 1) 
		{
			if(isset($tmc_option['request_quote']) && $tmc_option['request_quote'] != '') 
			{ ?>       
				<a class="header-requestbtn header2-requestbtn hvr-bounce-to-right" href="<?php echo esc_url(get_permalink($tmc_option['request_quote']));?>"><?php echo get_the_title($tmc_option['request_quote']);?></a>
	<?php 	}
			else
			{ ?>
				<a class="header-requestbtn header2-requestbtn hvr-bounce-to-right" href="<?php echo esc_attr($tmc_option['request_quote_link']);?>"><?php echo esc_attr($tmc_option['request_quote_text']);?></a>
 <?php 		}
		}	?>          
        </div>     
      </div>
    </nav>    
  </header>