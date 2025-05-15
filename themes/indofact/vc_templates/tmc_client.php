<?php
	$atts = vc_map_get_attributes( 'tmc_client', $atts );
	extract ($atts);
	$output = '';
	$count  = 0;
	if($categoriesname == 'All' || $categoriesname == '')
	{		
		$taxonomy = '';
	}
	else
	{
		$taxonomy = 'tax_query';
	}
	$args = array(
					'post_type' => 'client',
					'post_status' => 'publish',
					$taxonomy => array(array(
										'taxonomy' => 'client-category',
										'field' => 'name',
										'terms' => $categoriesname
									)),
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_client = new WP_Query( $args );
	if ( $the_client->have_posts() ) :
		if($layout == 'style_one')
		{
			$output .='<div class="row">';
			while ( $the_client->have_posts() ): 
				$the_client->the_post(); 
				$count++;
				$output .=' <div class="client_hover"><div class="col-md-2 col-sm-4 col-xs-6 '.esc_attr($el_class).'"><span class="client_img image_hover">'.get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive zoom_img_effect')).'</span></div></div>';
			endwhile;		
			$output .='</div>';
		}
		else
		{
		}
	else:
		$output .= esc_html__('Sorry, there is no client under your selected page.', 'indofact');
	endif;
	wp_reset_postdata();
	echo translate($output);
?>