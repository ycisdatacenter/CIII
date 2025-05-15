<?php
/**
 * The template for displaying search results pages.
 *
 * @package tmc
 */
	global $post;
	tmc_get_header();
	global $tmc_option; 
	if ( ! empty($tmc_option['search_sidebar_type'])) 
	{
		$sidebar_type = $tmc_option['search_sidebar_type'];
	}
	else 
	{
		$sidebar_type = 'wp';
	}
	if ( $sidebar_type == 'wp' ) 
	{
		$sidebar_id = $tmc_option['search_wp_sidebar'];
	} 
	else 
	{
		$sidebar_id = $tmc_option['shop_vc_sidebar'];
	}
	if ( ! empty( $sidebar_id ) ) 
	{
		 $sidebar_id =  $sidebar_id;
	} 
	else 
	{
		$sidebar_id = 'indofact-right-sidebar';
	}
	if ( ! empty($tmc_option['search_sidebar_position'])) 
	{
		$sidebar_position = $tmc_option['search_sidebar_position'];
	} 
	else 
	{
		$sidebar_position = 'right';
	}
	$structure = tmc_get_structure( $sidebar_id, $sidebar_type, $sidebar_position ); 
	?>
	<div id="main" class="pad100-top-bottom row">
	<?php
	echo translate($structure['content_before']);
 	$search_format = array('post_type' =>  'any', 's' => $s, 'paged' => $paged); 
		query_posts($search_format);
		if ( have_posts() ) : ?>
			<div class="blog-posts">
	<?php
				if( have_posts()):
					while ( have_posts() ) : the_post(); 
						if ( get_post_format( $post->ID )):
							get_template_part( 'content', get_post_format() );
						else:
							get_template_part('search', 'format');
						endif;	
					endwhile;
				endif;
				?>
			</div>
<?php 	else : ?>
		<div class="simple-text">
			<p>
				<?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.','indofact' ); ?>
			</p>
		</div>
<?php 	endif; ?>

<?php if(isset($tmc_option['search_pagination']) && $tmc_option['search_pagination'] == 1 ) 
		{ 	?>
			<div class="paginationWrapper large">
				<div class="pagination">
					<?php echo paginate_links( array(
							'type'      => 'list',
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						) );
					?>
				</div>
			</div>
<?php 	}
	echo translate($structure['content_after']); 

	echo translate($structure['sidebar_before']); 
	if ( $sidebar_id ) 
	{
		if ( $sidebar_type == 'wp' ) 
		{
			$sidebar = true;
		} 
		else 
		{
			$sidebar = get_post( $sidebar_id );
		}
	}
	if(isset($tmc_option['search_sidebar_position']) && $tmc_option['search_sidebar_position'] != 'no_sidebar') 
	{ ?>
		<aside class="blogAside">
			<div class="sidebar-section">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		</aside>
<?php 
	}
echo translate($structure['sidebar_after']); 
?>
</div>
<?php get_footer(); ?>