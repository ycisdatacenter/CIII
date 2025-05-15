<?php /* ************* POST FORMAT IMAGE ************** */
global $tmc_option; 
?>
<div <?php post_class("blogWrapper marginBttm blog-list-cl")?> id="post-<?php the_ID(); ?>">	
<?php 	if ( has_post_thumbnail()): 	
			if(isset($tmc_option['search_image_switch']) && $tmc_option['search_image_switch'] == 1 ) 
			{	?>
				<div class="wdt_img news_img">
					<a href="<?php the_permalink()  ?>">
					<?php  
						echo get_the_post_thumbnail($post->ID, 'tmc-blog-large', array('class'=>'img-responsive'));
					 ?>
					</a>
				</div>
<?php 		}
		endif;
		if(isset($tmc_option['search_title_switch']) && $tmc_option['search_title_switch'] == 1 ) 
		{
			?>	
			<div class="blog-head">
				<h6 class="wdt-100"><a href="<?php the_permalink()?>"><?php the_title()?></a></h6>		
			</div>
<?php 	} 
		if(isset($tmc_option['search_content_switch']) && $tmc_option['search_content_switch'] == 1 ) 
		{	?>
			<div class="blogContent">
				<div class="simple-text">
					<p><?php echo the_excerpt(); ?></p>
				</div>
			</div>
<?php	} 	
		if(isset($tmc_option['search_read_more_switch']) && $tmc_option['search_read_more_switch'] == 1 ) 
		{	?>
			<div class="service-item margin-read">
				<a href="<?php the_permalink()?>" class="c-btn event_btn"><?php echo  esc_attr($tmc_option['search_read_more']);?></a>
			</div>
<?php 	} ?>
</div>