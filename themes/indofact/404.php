<?php	
tmc_get_header(); 
global $tmc_option;	?>
<section class="page-404">
	<div class="container">
<?php	if (  class_exists( 'Redux' ) )
		{	?>
			<h1>
				<?php echo esc_attr($tmc_option['err_title']); ?>
			</h1>
			<span class="pagenot-found">
				<?php echo esc_attr($tmc_option['err_sub_title']); ?>
			</span>
	<?php	if(isset($tmc_option['404_btn']) && $tmc_option['404_btn'] == '1')
			{
				if(isset($tmc_option['err_btn_lnk']) && $tmc_option['err_btn_lnk'] != '')
				{	?>
					<a class="gotohome" href="<?php echo esc_url(get_permalink($tmc_option['err_btn_lnk']));?>">
						<?php echo esc_attr($tmc_option['err_btn']); ?>
					</a>
		<?php	}
				else
				{	?>
					<a class="gotohome" href="<?php echo esc_url(get_home_url('/')); ?>">
						<?php echo esc_attr($tmc_option['err_btn']); ?>
					</a>
		<?php	}
			}
		}
		else
		{	?>
			<h1>
				<?php echo esc_html__('404','indofact'); ?>
			</h1>
			<span class="pagenot-found">
				<?php echo esc_html__('PAGE NOT FOUND','indofact'); ?>
			</span>
			<a class="gotohome" href="<?php echo esc_url(get_home_url('/')); ?>">
				<?php echo esc_html__('Go Back to home','indofact'); ?>
			</a>
<?php	}	?>
	</div>
</section>
<?php	if( class_exists('Redux') ) 
		{
			if ( isset( $tmc_option['404_footer'] ) && ($tmc_option['404_footer'] == '1' ) ) 
			{ 
				get_footer(); 
			}
		}
		else 
		{
			get_footer(); 
		} ?>