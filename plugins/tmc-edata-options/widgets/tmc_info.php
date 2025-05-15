<?php

add_action( 'widgets_init', 'indofact_tmc_info' );

function indofact_tmc_info() {

	register_widget( 'tmc_info' );
}

class tmc_info extends WP_Widget 
{
		public function __construct() 
		{
				$widget = array(
					'classname' => 'tmc_info',
					'description' => 'Widget that uses the built in Media library.'
			);
			parent::__construct( 'pu_media_upload', 'TMC Info', $widget );
		}
		public function form( $tmc_instance )
		{
			 $defaults = array(
				'title'      	=> '',
				'text_content'  => '',
				'text_content1' => '',
				'fot_page'		=>''
			);
			/* Set up default widget settings. */
			$tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
			
			$ind_pages = get_pages();
			$tmc_title = '';
			if ( isset( $tmc_instance[ 'title' ] ) ) 
			{
				$tmc_title = $tmc_instance[ 'title' ];
			}
			$text_content = '';
			if ( isset( $tmc_instance[ 'text_content' ] ) ) 
			{
				$text_content = $tmc_instance[ 'text_content' ];
			}
			$text_content1 = '';
			if ( isset( $tmc_instance[ 'text_content1' ] ) ) 
			{
				$text_content1 = $tmc_instance[ 'text_content1' ];
			}
			$fot_page = '';
			if ( isset( $tmc_instance[ 'fot_page' ] ) ) 
			{
				$fot_page = $tmc_instance[ 'fot_page' ];
			}
	?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
					<?php echo esc_html__('Title:' ,'indofact') ?>
				</label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('text_content')); ?>">
					<?php echo esc_html( 'Text:', 'indofact' ); ?>
				</label>	
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_content' )); ?>"><?php echo esc_attr( $text_content ); ?></textarea>
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('text_content1')); ?>">
					<?php echo esc_html( 'Read More link:', 'indofact' ); ?>
				</label>	
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text_content1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_content1' )); ?>" value="<?php echo esc_attr( $text_content1 ); ?>">
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
		public function update( $new_tmc_instance, $old_tmc_instance ) 
		{
			// processes widget options to be saved
			$tmc_instance = array();
			$tmc_instance[ 'title' ]  			= $new_tmc_instance['title'];
			$tmc_instance[ 'text_content1' ]  	= $new_tmc_instance['text_content1'];
			$tmc_instance[ 'text_content' ]		= $new_tmc_instance['text_content'];
			$tmc_instance['fot_page']			= $new_tmc_instance['fot_page'];
			return $tmc_instance;
		}
		public function widget( $args, $tmc_instance )
		{
			// Outputs the content of the widget
			extract( $args );
			global $resort_option;
			$title     		  = apply_filters( 'title', $tmc_instance['title'] );
			$textContent1     = apply_filters( 'text_content1', $tmc_instance['text_content1'] );
			$textContent      = apply_filters( 'text_content', $tmc_instance['text_content'] );
			echo ($before_widget); ?>
				<h4><?php echo esc_attr($tmc_instance[ 'title' ]);?></h4>
		<?php	if( $tmc_instance[ 'text_content' ]): ?>
					<p class="line-height26">
						<?php echo esc_attr($tmc_instance[ 'text_content' ]);?>
					</p>
		<?php	 endif;
				if( $tmc_instance[ 'text_content1' ]):  ?>	
					<a class="ftr-read-more" href="<?php echo get_permalink( $tmc_instance['fot_page'] ); ?>">
						<?php echo esc_attr($tmc_instance[ 'text_content1' ]);?>
					</a>
		<?php 	endif; 
			wp_reset_postdata();
			echo ($after_widget);
		}
}