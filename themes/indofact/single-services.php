<?php tmc_get_header(); ?>
		<div class="row">
	<?php
	while ( have_posts() ) 
	{
		the_post();
	?>	
		<div class="col-md-8 right-column pull-right">
				<?php the_content(); ?>
		</div>
		<?php if(is_active_sidebar( 'tmc-services-sidebar'))
		{ ?>
			<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 left-column">
				<?php dynamic_sidebar('tmc-services-sidebar'); ?>
			</div>
<?php 	} ?>
<?php } ?>
		</div>
<?php get_footer(); ?>