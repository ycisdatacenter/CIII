<?php 	global $tmc_option; 
		$stickyclass = '';
		if(isset($tmc_option['sticky_menu']) && $tmc_option['sticky_menu'] != 1 ) 
		{
			$stickyclass = 'header_not_sticky';
		}
		?>
<header class="header4 header4_only">
<?php if(isset($tmc_option['top_switch']) && $tmc_option['top_switch'] == 1) 
	{	?>
		<div class="hdr-top-bar">
			<div class="container">
				<ul class="header-info">
					<?php if(isset($tmc_option['top_address_icon']) && $tmc_option['top_address_icon'] != '' || isset($tmc_option['top_address_text']) && $tmc_option['top_address_text'] != '' ):?>
						<li class="<?php echo esc_attr($tmc_option['top_address_icon']); ?>">
							<?php echo esc_attr($tmc_option['top_address_text']); ?>
						</li>
						<?php endif; 
						if(isset($tmc_option['top_contact_class']) && $tmc_option['top_contact_class'] != '' || isset($tmc_option['top_contact_details']) && $tmc_option['top_contact_details'] != '' ):
						?>
						<li class="<?php echo esc_attr($tmc_option['top_contact_class']); ?>">
							<?php echo esc_attr($tmc_option['top_contact_details']); ?>
						</li>
						<?php endif; ?>
				</ul>
				<div class="hdr3-right hdr4-right">
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
			<?php					endif;
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
	<?php 
	}	?>		
    <nav id="main-navigation-wrapper" class="navbar navbar-default <?php echo esc_attr($stickyclass); ?>">
      <div class="container">
        <div class="navbar-header">
			 <div class="logo-menu">
				<?php	
					if (isset($tmc_option['mobile_logo_four']['url'] )):
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $tmc_option['mobile_logo_four']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
				</a>
				<?php
					else: 
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
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
				if (isset($tmc_option['logo_four']['url'] )):	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_none">
						<img src="<?php echo esc_url( $tmc_option['logo_four']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php 
					else: 
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php endif; ?> 	
			<?php 
				if (isset($tmc_option['sticky_four']['url'] )):		?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo sticky_logo">
						<img src="<?php echo esc_url( $tmc_option['sticky_four']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php
					else: 
					$sticky_logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<img src="<?php echo esc_url( $sticky_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php endif; 
				wp_nav_menu( 
								  array(
									'menu_id' => 'Primary',
									'theme_location' => 'tmc-primary',
									'container'      => false,
									'depth'          => 9,
									'after'     	 => '<i class="fa fa-chevron-down"></i>',
									'menu_class'     => 'nav navbar-nav display_none'
									)
								);	?>
        </div>
      </div>
    </nav>
</header>