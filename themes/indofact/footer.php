	</div> <!--.content_wrapper-->
		<?php
			global $tmc_option;
			$homescroll = '';
			if(!empty($tmc_option['footer_style']))
			{
				$footer = $tmc_option['footer_style'];
			}
			else
			{
				$footer ='footer1';
			}			
			if(!is_page('coming-soon'))
			{
				tmc_footer_layout($footer);
			}

		if(is_page('electrician') ){
			$homescroll = 'home4scroll';
		}elseif(is_page('plumber') ){
			$homescroll = 'home5scroll';
		}elseif( ($tmc_option['footer_style'] == 'footer2')){
			$homescroll = 'home2scroll';
		}elseif(($tmc_option['footer_style'] == 'footer3')){
			$homescroll = 'home3scroll';
		}elseif(($tmc_option['footer_style'] == 'footer4')){
			$homescroll = 'home4scroll';
		}elseif(($tmc_option['footer_style'] == 'footer5')){
			$homescroll = 'home5scroll';
		}else{
			$homescroll = 'home1scroll';
		}	
    if(isset($tmc_option['top_back_button']) && $tmc_option['top_back_button'] != 4)
		{
			if($tmc_option['top_back_button'] == 3)
			{ 	?>
				<div id="btt" class="<?php echo esc_attr($homescroll); ?> mobileBtt <?php echo esc_attr($tmc_option['btn_poss']); ?>"><i class="fa <?php echo esc_attr($tmc_option['btt_icon']); ?>"></i></div>
				<?php	
			}
			elseif($tmc_option['top_back_button'] == 2)
			{ 	?>
				<div id="btt" class="<?php echo esc_attr($homescroll); ?> desktopBtt <?php echo esc_attr($tmc_option['btn_poss']); ?>"><i class="fa <?php echo esc_attr($tmc_option['btt_icon']); ?>"></i></div>
				<?php 	
			}
			else 
			{ 	?>
				<div id="btt" class="<?php echo esc_attr($homescroll); ?> <?php echo esc_attr($tmc_option['btn_poss']); ?>"><i class="fa <?php echo esc_attr($tmc_option['btt_icon']); ?>"></i></div>
				<?php
			}
		}
wp_footer();
?>
<div class="<?php echo esc_attr($homescroll); ?> modal fade bs-example-modal-lg" tabindex="-1" role="dialog">      
  <div class="modal-dialog modal-lg">    
    <div class="modal-content">   
      <div class="modal-body">
		<h3><?php echo esc_html__( 'Search','indofact'); ?></h3>
		<div class="search-form">
			<?php 
			$serValue = '';
			if ( is_search()) 
			{
				$serValue = get_search_query();
			}
			?>
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <input type="text" value="<?php echo esc_attr($serValue); ?>" class="search_lightbox_input" name="s" placeholder="Search..." required>
                <input type="submit" value="" name="submit" class="search_lghtbox_btn">
			</form>
		</div>     
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>