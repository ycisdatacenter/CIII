<?php tmc_get_header(); 
	while ( have_posts() ) 
	{
		the_post(); ?>
		<div class="entry-content">
			<div class="text_block wpb_text_column clearfix">
				<?php the_content(); ?>
			</div>
			<?php
			wp_link_pages( 
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:','indofact' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page','indofact' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) 
			);
			?>
		</div>
<?php   if (  class_exists( 'Redux' ) ) 
		{   
			if(isset($tmc_option['switch_comments']) && $tmc_option['switch_comments'] == 1 ) 
			{ 
				if ( comments_open() || get_comments_number() ) 
				{
					comments_template();
				} 
			} 
		} 
		else 
		{
			if ( comments_open() || get_comments_number() ) 
			{
				comments_template();
			}
		}								
	}
get_footer(); ?>