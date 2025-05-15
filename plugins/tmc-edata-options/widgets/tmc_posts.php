<?php

add_action( 'widgets_init', 'indofact_tmc_posts' );

function indofact_tmc_posts() {

	register_widget('tmc_posts');
}

class tmc_posts extends WP_Widget 
{
	public function __construct() 
	{
        parent::__construct(
	 		'tmc_posts',
			__('TMC Posts','indofact'),
			array( 'description' => esc_html__( 'Eye catching posts widget', 'indofact' ), )
		);
	}
 	public function form( $tmc_instance )
	{
		$number = '';
        $defaults = array(
            'title'      	=> '',
			'number'     	=> $number,
			'post_order'    => '',
			'read_more'     => '',
        );
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
		if ( isset( $tmc_instance[ 'post_title' ] ) ) 
		{
            $tmc_post_title = $tmc_instance[ 'post_title' ];
        } 
		else 
		{
            $tmc_post_title = '';
        }
		$tmc_read_more = '';
		if ( isset( $tmc_instance[ 'read_more' ] ) ) 
		{
            $tmc_read_more = $tmc_instance[ 'read_more' ];
        }
		$number = intval($tmc_instance[ 'number' ]);
		if($number<=0)
		{
            $number = '';
        }		
		$post_order_types = array(
            'date'          => 'Recent Posts',
            'title'          => 'Sort By Title'
        ); ?>
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'post_title' )); ?>">
				<?php echo esc_html__('Posts Title' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'post_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_post_title ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
				<?php echo esc_html__('How many Posts to show ?' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'post_order' )); ?>">
				<?php echo esc_html__('Posts order:', 'indofact') ?>
			</label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'post_order' ));?>" id="<?php echo esc_attr($this->get_field_id( 'post_order' ));?>">
                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) 
				{ ?>
                    <option value="<?php echo esc_attr($post_order_type); ?>" <?php echo ($post_order_type == $tmc_instance['post_order']) ? 'selected="selected" ' : '';?>>
						<?php echo esc_attr($post_order_value); ?>
					</option>
                <?php 
				} ?>
            </select>			
		</p>
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'read_more' )); ?>">
				<?php echo esc_html__('Read more text' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'read_more' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'read_more' )); ?>" type="text" value="<?php echo esc_attr( $tmc_read_more ); ?>" />
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) 
	{
		// processes widget options to be saved
        $tmc_instance = array();
        $tmc_instance[ 'post_title' ]= $new_instance['post_title'];
        $tmc_instance[ 'read_more' ]= $new_instance['read_more'];
		$tmc_instance[ 'number' ]     = intval($new_instance[ 'number' ]);
		$tmc_instance[ 'post_order' ] = $new_instance[ 'post_order' ];
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $ind_option;
        $title      = apply_filters( 'widget_title', $tmc_instance['post_title'] );
		$number     = intval($tmc_instance['number']);
		$post_order = $tmc_instance['post_order'];
		if($number<=0) $number = '';
		if($post_order == 'date')
		{
			$order = 'DESC';			
		} else if ($post_order == 'title')
		{
			$order = 'ASC';
		}	
		echo ($before_widget);
		$args = array(
		
            'post_type' => 'post',
            'post_status' => 'publish',
			'posts_per_page' => $number,
			'orderby' => $post_order,
			'order'   => $order		
        );
        $the_query = new WP_Query( $args );
        $count     = 0;
		?>
		<div class="post-listing">
			<h4><?php echo esc_attr($tmc_instance['post_title']);?></h4>
			<?php
			while($the_query->have_posts()): 
			$the_query->the_post();			
			?>
			<div class="post-list">
				<span class="post-img">
					<?php echo get_the_post_thumbnail(get_the_id(),array(79,79),array('class'=>'img-responsive')); ?>
				</span>
				<div class="post-txt">
					<h5><?php the_title(); ?></h5>
					<a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_attr($tmc_instance['read_more']);?></a>
				</div>
			</div>		
		<?php endwhile; ?>
		</div>	
		<?php wp_reset_postdata();
		echo ($after_widget);
	}
}