<?php
require get_template_directory() . '/inc/tgm/tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'tmc_require_plugins' );
if(function_exists( 'elementor_load_plugin_textdomain' )) // Elementor
{
	update_option('tmc_page_builder', 'ele');
}
else if(class_exists( 'Vc_Manager' ))  // WP Bakery
{
	update_option('tmc_page_builder', 'wpbak');
}

function tmc_require_plugins()
{
	$plugins      = array(
		
		array(
			'name'         => esc_html__('Revolution Slider','indofact'),
			'slug'         => 'revslider',
			'source'             => 'https://indofact.themechampion.com/theme-assets/download.php?file=slider&pur_code='.trim(get_option('tmc_purchase_code')),
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://www.themepunch.com/revolution/','indofact'),
		),
		
		array(
			'name'     => esc_html__('Breadcrumb NavXT','indofact'),
			'slug'     => 'breadcrumb-navxt',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'     => esc_html__('One Click Demo Import','indofact'),
			'slug'     => 'one-click-demo-import',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		
		array(
			'name'      => esc_html__('WooCommerce','indofact'),
			'slug'      => 'woocommerce',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'     => esc_html__('MailChimp for WordPress Lite','indofact'),
			'slug'     => 'mailchimp-for-wp',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),		
		array(
			'name'     => esc_html__('Contact Form 7','indofact'),
			'slug'     => 'contact-form-7',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => 'Envato Market',
            'slug'               => 'envato-market', 
            'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip', 
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
	);
	
	    if(get_option('tmc_page_builder') == 'wpbak')
		{
		     $plugins[] = array(
							'name'         => esc_html__('WPBakery Visual Composer','indofact'),
							'slug'         => 'vc-composer',
							'source'             => 'https://indofact.themechampion.com/theme-assets/download.php?file=composer&pur_code='.trim(get_option('tmc_purchase_code')),
							'required'         => true,
							'force_activation'  => false,
							'force_deactivation' => false,
							'external_url' => esc_url('http://vc.wpbakery.com','indofact'),
						 );	
						 
			 $plugins[] = array(
							'name'               => 'TMC Data options',
							'slug'               => 'tmc-data-options', 
							'source'             => 'https://indofact.themechampion.com/theme-assets/download.php?file=options&pur_code='.trim(get_option('tmc_purchase_code')),
							'required'           => true,
							'force_activation'   => false,
							'force_deactivation' => false,
						);
						 
			 $plugins[] = array(
							'name'         => esc_html__('Ultimate Addons for WPBakery Page Builder','indofact'),
							'slug'         => 'ultimate',
							'source'             => 'https://indofact.themechampion.com/theme-assets/download.php?file=ultimate&pur_code='.trim(get_option('tmc_purchase_code')),
							'required'         => true,
							'force_activation'  => false,
							'force_deactivation' => false,
							'external_url' => esc_url('https://ultimate.brainstormforce.com/','indofact'),
						);
						
			 $plugins[] = array(
							'name'     => esc_html__('WP Video Lightbox','indofact'),
							'slug'     => 'wp-video-lightbox',
							'required'         => true,
							'force_activation'  => false,
							'force_deactivation' => false,
						);		 			 
		}
		else
		{
			$plugins[] = array(
								'name' 		=> esc_html__('Elementor','indofact'),
								'slug' 		=> 'elementor',
								'required'         => true,
								'force_activation'  => false,
								'force_deactivation' => false,
						    );
								
			$plugins[] = array(
								'name'               => 'TMC eData options',
								'slug'               => 'tmc-edata-options', 
								'source'             => 'https://indofact.themechampion.com/theme-assets/download.php?file=ele_options&pur_code='.trim(get_option('tmc_purchase_code')),
								'required'           => true,
								'force_activation'   => false,
								'force_deactivation' => false,
						    );
		}
	
	tgmpa( $plugins, array( 'is_automatic' => true ) );
}
function tmc_theme_activate()
{
	if(isset($_POST['submit']))
	{
		$tmc_data = wp_remote_get(add_query_arg(array('entered_code' => $_POST['tmc_theme_key']), 'https://www.themechampion.com/demo/auth/check.php'), array('timeout' => 20));
		
		$tmc_valid_data = json_decode($tmc_data['body']);

		if($tmc_valid_data->status)
		{
			update_option('tmc_activation', 1);
			update_option('tmc_purchase_code', $_POST['tmc_theme_key']);
			update_option('tmc_page_builder', $_POST['page_builder']);
		}
	}
?>
	<div class="header_section">
	   <div class="container">
		 <div class="row">
			 <div class="content">
				<img src="<?php echo get_template_directory_uri().'/assets/images/activate.png'?>">
				<h3><?php echo esc_html_x('Welcome to '.wp_get_theme().' - Best design to you','indofact'); ?></h3>
				<?php
				if(!get_option('tmc_activation'))
				{ 
				?>
				<p><?php echo esc_attr('Thank you for purchasing '.wp_get_theme().'! To import data and all plugins. Please activate your Theme.','indofact'); ?></p>
				<form method="POST">
					<div class="form-group">
					<div class="activate-theme">
					<label><?php echo esc_html__( 'Enter purchase key:', 'indofact' ); ?></label>
						<input type="text" class="form-control" name="tmc_theme_key" id="tmc_theme_key" placeholder="<?php echo esc_html__( 'e.g. ab0yonv8-ww2po', 'indofact' ); ?>" value="<?php if(isset($_POST['tmc_theme_key'])){ echo esc_attr($_POST['tmc_theme_key']); } ?>" required />
						<input type="hidden" name="ele" id="ele" value="ele" />
						<button type="submit" class="btn btn-primary" name="submit"><?php echo esc_html__( 'Activate','indofact');?></button>
					</div>
					</div>
				 </form>
				<?php
				}
				else if(!isset($_POST['submit']))
				{
					?>
					<h2><?php echo esc_attr('Thank you for purchasing '.wp_get_theme().'! Your WP theme is already activated.','indofact');?></h2>
				<?php	
				}
				if(isset($_POST['submit']))
				{
					if(get_option('tmc_activation'))
					{

					?>
						<p class="theme-p green"> 
						<?php echo esc_html__('Thank you, your purchase code is valid and theme has been activated.', 'indofact'); ?> 
						</p>
			<?php	}
					else
					{ ?>
						<p class="theme-p red"> 
							<?php echo esc_html__('Oops, your purchase code is not valid. Please enter corerct code and try again !!!', 'indofact'); ?> 
						</p>
			<?php	} 
				} ?>
				</div>
		   </div>
	   </div>
   </div>
	<?php
}

function tmc_is_theme_activate($arg) 
{
	if(!get_option('tmc_activation'))
	{
		return new WP_Error('tmc_key_empty', sprintf(wp_kses('Theme is not activated yet. Use theme purchase code to <a href="%s">Activate '.wp_get_theme().'</a>','indofact'),esc_url(admin_url('themes.php?page=tmc-theme-activate'))));
	}
	return $arg;
}
add_filter('upgrader_pre_download', 'tmc_is_theme_activate', 10, 1);