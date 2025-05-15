<?php

add_action( 'widgets_init', 'indofact_tmc_footer_socials' );

function indofact_tmc_footer_socials() {

	register_widget( 'tmc_footer_socials' );
}

class tmc_footer_socials extends WP_Widget 
{
	public function __construct() 
	{
		// Widget actual processes
		$widgetsocial = array(
			'classname' => 'tmc_footer_socials',
			'description' => 'Widget that uses the built in Media library.'
		);	
		parent::__construct( 'tmc_media_upload', 'TMC Footer Socials', $widgetsocial );
		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}
	public function upload_scripts()
    {
		wp_enqueue_media();
		wp_enqueue_script( 'upload_media_widget', get_template_directory_uri() . '/assets/js/upload-media.js', array( 'jquery' ), TMC_THEME_VERSION, true );
    }
 	public function form( $tmc_instance )
	{
		/* Set up default widget settings. */
        $defaults = array(
            'title'      	=> '',
            'socila_icon'      	=> '',
			'image_uri' => '',
        );
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );		$image = '';		if ($tmc_instance[ 'image_uri' ])		{            $image = $tmc_instance[ 'image_uri' ];        }
		$tmc_title = '';
		if ( isset( $tmc_instance[ 'title' ] ) )
		{
            $tmc_title = $tmc_instance[ 'title' ];
        }
		$socila_icon = '';
		if ( isset( $tmc_instance[ 'socila_icon' ] ) )
		{
            $socila_icon = $tmc_instance[ 'socila_icon' ];
        }
		 ?>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php echo esc_html__('Title:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php echo esc_html( 'Logo:', 'indofact' ); ?></label><br />
			<?php
				if ( $tmc_instance['image_uri'] != '' ) :		
				$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
				if(isset($tmc_instance['image']))
				{
					$detectedType = exif_imagetype($tmc_instance['image']['tmp_name']);
				}
				else
				{
					$detectedType = '';
				}
				$error = !in_array($detectedType, $allowedTypes);			
					echo '<img class="custom_media_image" src="'.esc_url($tmc_instance['image_uri']).'" style="margin:0;padding:0;float:left;display:inline-block" width=100px; height=100px; /><br />';
				endif;
			?>
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php echo esc_url($image); ?>" style="margin-top:5px;">
			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" value="Upload Image" style="margin-top:5px;" />
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'socila_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'socila_icon' )); ?>" <?php if($socila_icon == 'on'){?> checked="checked" <?php } ?> /> <?php echo esc_html__( 'Social Icons', 'indofact' ); ?>
		</p>
<?php
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $tmc_instance = array();
		$tmc_instance[ 'title' ]		= strip_tags( $new_instance['title'] );
		$tmc_instance[ 'socila_icon' ]	= strip_tags( $new_instance['socila_icon'] );
		$tmc_instance[ 'image_uri' ]	= strip_tags( $new_instance['image_uri'] );
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $tmc_option;
		echo ($before_widget);
		?>
		<h6><?php echo esc_attr($tmc_instance['title']);?></h6>
		<?php
		if ($tmc_instance['socila_icon'] == 'on')
		{ 
			$socials = tmc_get_socials( 'footer_socials' );
			if ( $socials): 	?>
				<div class="header-socials footer-socials"> 
		<?php 		foreach( $socials as $key => $val ): ?>
						<a href="<?php echo esc_url( $val ); ?>">
							<i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i>
						</a> 
		<?php 		endforeach; ?> 
				</div>
	<?php 	endif;
		}
		if ($tmc_instance['image_uri']): ?>
			<span class="ftr-logo img">
				<img src="<?php echo esc_url( $tmc_instance['image_uri'] ); ?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>">
			</span>
<?php 	endif;
		wp_reset_postdata();
		echo ($after_widget);
	}
}