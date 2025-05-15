<?php

add_action( 'widgets_init', 'indofact_tmc_service_menu' );

function indofact_tmc_service_menu() {

	register_widget( 'tmc_service_menu' );
}

class tmc_service_menu extends WP_Widget
{
	public function __construct()
	{
        parent::__construct(
	 		'tmc_service_menu',
			__('TMC Service Menu','indofact'),
			array( 'description' => esc_html__( 'Service menu', 'indofact' ), )
		);
	}
 	public function form( $tmc_instance )
	{
        $defaults = array();
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
	}
	public function update( $new_instance, $old_instance )
	{
		// processes widget options to be saved
        $tmc_instance = array();
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );	
		echo ($before_widget);
?>
    <div class="widget service-listing">		
	<?php	wp_nav_menu(
				array(
					'menu_id' => 'Service',
					'theme_location' => 'tmc-service',
					'container'      => false,
					'depth'          => 3,
					'menu_class'     => 'category-list marbtm50'
				)
			); 
		wp_reset_postdata(); ?>
		</div>
	<?php echo ($after_widget);
	}
}