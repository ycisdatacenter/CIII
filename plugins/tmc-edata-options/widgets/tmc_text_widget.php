<?php

add_action( 'widgets_init', 'indofact_tmc_have_enquiry' );

function indofact_tmc_have_enquiry() {

	register_widget( 'tmc_have_enquiry' );
}

class tmc_have_enquiry extends WP_Widget 
{
	public function __construct() 
	{
        parent::__construct(
	 		'tmc_have_enquiry',
			esc_html__('TMC Have Widget','indofact'),
			array( 'description' => esc_html__( 'Eye catching posts widget', 'indofact' ), )
		);
	}
 	public function form( $tmc_instance )
	{
		$number = '';
        $defaults = array(
            'title'      	=> '',
			'content'     => '',
			'link_name'     => '',
			'fot_page'		=>''
        );
        $tmc_instance = wp_parse_args( (array) $tmc_instance, $defaults );
		$ind_pages = get_pages();
		if ( isset( $tmc_instance[ 'post_title' ] ) ) 
		{
            $tmc_post_title = $tmc_instance[ 'post_title' ];
        } 
		else 
		{
            $tmc_post_title = '';
        }
		if ( isset( $tmc_instance[ 'post_content' ] ) ) 
		{
            $tmc_post_content = $tmc_instance[ 'post_content' ];
        } 
		else 
		{
            $tmc_post_content = '';
        }	
		if ( isset( $tmc_instance[ 'link_name' ] ) ) 
		{
            $tmc_post_name = $tmc_instance[ 'link_name' ];
        } 
		else 
		{
            $tmc_post_name = '';
        }
		if ( isset( $tmc_instance[ 'fot_page' ] ) ) 
		{
            $fot_page = $tmc_instance[ 'fot_page' ];
        } 
		else 
		{
            $fot_page = '';
        }
		?>
		<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'post_title' )); ?>">
					<?php echo esc_html__('Title:' ,'indofact') ?>
				</label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'post_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_post_title ); ?>" />
		</p>
			
		<p>
				<label for="<?php echo esc_attr($this->get_field_id('post_content')); ?>">
					<?php echo esc_html( 'Content:', 'indofact' ); ?>
				</label>	
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'post_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_content' )); ?>"><?php echo esc_attr( $tmc_post_content ); ?></textarea>
			</p>
		<p>
				<label for="<?php echo esc_attr($this->get_field_id('link_name')); ?>">
					<?php echo esc_html( 'Link Name:', 'indofact' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link_name' )); ?>" type="text" value="<?php echo esc_attr( $tmc_post_name ); ?>" />
			</p>
		<p>
				<label for="<?php echo esc_attr($this->get_field_id('fot_page')); ?>">
					<?php echo esc_html__( 'link Option:', 'indofact' ); ?>
				</label>
				<select name="<?php echo esc_attr($this->get_field_name('fot_page')); ?>" id="<?php echo esc_attr($this->get_field_id('fot_page')); ?>" class="widefat">

					<?php
					foreach($ind_pages AS $page=>$val)
					{
					?>
						<option value="<?php echo esc_attr($val->ID);?>"<?php selected( $tmc_instance['fot_page'], $val->ID ); ?>>	<?php echo esc_attr($val->post_name); ?>
						</option>
					<?php
					}
					?>	
				</select>
			</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) 
	{
		// processes widget options to be saved
        $tmc_instance = array();
        $tmc_instance[ 'post_title' ]= $new_instance['post_title'];
        $tmc_instance[ 'post_content' ]= $new_instance['post_content'];
        $tmc_instance[ 'link_name' ]= $new_instance['link_name'];
		$tmc_instance['fot_page']= $new_instance['fot_page'];
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $ind_option;
        $title  = apply_filters( 'widget_title', $tmc_instance['post_title'] );
        $content  = apply_filters( 'widget_title', $tmc_instance['post_content'] );
        $content  = apply_filters( 'link_name', $tmc_instance['link_name'] );
		echo ($before_widget);
		$args = array(
		
            
        );
        $the_query = new WP_Query( $args );
        $count     = 0;
		?>
		 <h6><?php echo esc_attr($tmc_instance['post_title']);?></h6>
                     <p class="marbtm20 line-height26"><?php echo esc_attr($tmc_instance[ 'post_content' ]);?></p>
					 <?php if( $tmc_instance[ 'link_name' ]):  ?>			
			 <a class="ftr-read-more" href="<?php echo get_permalink( $tmc_instance['fot_page'] ); ?>">
				<?php echo esc_attr($tmc_instance[ 'link_name' ]);?>
			 </a>
			 <?php endif;
			while($the_query->have_posts()): 
			$the_query->the_post();			
			?>
					 
	<?php endwhile; 
		wp_reset_postdata();
		echo ($after_widget);
	}
}