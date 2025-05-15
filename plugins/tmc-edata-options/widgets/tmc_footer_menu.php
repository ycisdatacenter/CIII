<?phpadd_action( 'widgets_init', 'indofact_tmc_footer_menu' );function indofact_tmc_footer_menu() {	register_widget( 'tmc_footer_menu' );}
class tmc_footer_menu extends WP_Widget 
{
	public function __construct() 
	{
        parent::__construct(
	 		'tmc_footer_menu',
			__('TMC Footer Menu','indofact'),
			array( 'description' => esc_html__( 'Footer menu', 'indofact' ), )
		);
	}
 	public function form( $tmc_instance )
	{
        $defaults = array(
            'title'      			 => ''
        );
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
		$tmc_title = '';
		if ( isset( $tmc_instance[ 'title' ] ) ) 
		{
            $tmc_title = $tmc_instance[ 'title' ];
        }
		$post_order_types = array(
            'footer_two'          => 'Footer Two',
            'footer_three'          => 'Footer Three'
        );
?>
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php echo esc_html__('Title:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_title ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'footer_menu' )); ?>"><?php echo esc_html__('Select Menu:', 'indofact') ?></label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'footer_menu' ));?>" id="<?php echo esc_attr($this->get_field_id( 'footer_menu' ));?>">
                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) { ?>
                    <option value="<?php echo esc_attr($post_order_type); ?>" <?php echo ($post_order_type == $tmc_instance['footer_menu']) ? 'selected="selected" ' : '';?>><?php echo esc_attr($post_order_value); ?></option>
                <?php } ?>
            </select>	
		</p>
<?php 
	}
	public function update( $new_instance, $old_instance ) 
	{
		// processes widget options to be saved
        $tmc_instance = array();
        $tmc_instance[ 'title' ]		= strip_tags( $new_instance['title'] );
        $tmc_instance[ 'footer_menu' ]		= strip_tags( $new_instance['footer_menu'] );
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );
        $title        = apply_filters( 'title', $tmc_instance['title'] );	
        $menu      	  = apply_filters( 'menu', $tmc_instance['footer_menu'] );	
		echo ($before_widget);
		if($tmc_instance['footer_menu'] == 'footer_two')
		{ 	?>	
			<h6><?php echo esc_attr($tmc_instance['title']);?></h6><?php 	
			wp_nav_menu(
					array(
						'menu_id' => 'Footer',
						'theme_location' => 'tmc-footer-one',
						'container'      => false,
						'depth'          => 3,
						'link_before'    => '- ',
						'menu_class'     => 'footer-link'
					)
				);
		}
		else
		{ ?>
			<h6><?php echo esc_attr($tmc_instance['title']);?></h6><?php 	
			wp_nav_menu(
					array(
						'menu_id' => 'Footer1',
						'theme_location' => 'tmc-footer-two',
						'container'      => false,
						'depth'          => 3,
						'link_before'    => '- ',
						'menu_class'     => 'footer-link'
					)
				); 
		}
		wp_reset_postdata();
		echo ($after_widget);
	}
}