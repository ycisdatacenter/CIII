<?php

add_action( 'widgets_init', 'indofact_tmc_download_brochure' );

function indofact_tmc_download_brochure() {

	register_widget( 'tmc_download_brochure' );
}

class tmc_download_brochure extends WP_Widget
{
    public function __construct()
    {
        $widgetButton = array(
            'classname' => 'tmc_download_brochure',
            'description' => 'Widget that uses the built in Media library.'
        );
        parent::__construct( 'pu_media_upload_button', 'TMC Download Brochure', $widgetButton );
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
			'image_uri' => '',
			'pdf_url' => '',
        );
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
        
        $tmc_title = '';
		if ( isset( $tmc_instance[ 'title' ] ) ) 
		{
            $tmc_title = $tmc_instance[ 'title' ];
        }		
        $image = '';
        if(isset($tmc_instance['image_uri']))
        {
            $image = $tmc_instance['image_uri'];
        }
        ?>		
        <p>
            <label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php echo esc_html( 'Title:', 'indofact' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_title ); ?>" />
        </p>
		
		
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('pdf_url')); ?>"><?php echo esc_html( 'PDF:', 'indofact' ); ?></label><br />
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
				endif;
			?>
			<input type="text" class="widefat custom_pdf_url" name="<?php echo esc_attr($this->get_field_name('pdf_url')); ?>" id="<?php echo esc_attr($this->get_field_id('pdf_url')); ?>" value="<?php echo esc_url($tmc_instance['pdf_url']); ?>" style="margin-top:5px;">
		
			<input type="button" class="button button-primary custom_pdf_button" id="custom_pdf_button" name="<?php echo esc_attr($this->get_field_name('pdf_url')); ?>" style="margin-top:5px;" value="Upload PDF"/>
			
			<br />
			<label for="<?php echo esc_attr($this->get_field_id('pdf_url')); ?>"><?php echo esc_html( 'Image:', 'indofact' ); ?></label>
			
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php echo esc_url($tmc_instance['image_uri']); ?>" style="margin-top:5px;">
			
			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" style="margin-top:5px;" value="Upload Image"/>&nbsp;
			
		</p>
    <?php
    }
    public function update( $new_tmc_instance, $old_tmc_instance ) 
	{
		$tmc_instance = $old_tmc_instance;
        $tmc_instance['title'] 				= strip_tags( $new_tmc_instance['title'] );
        $tmc_instance['image_uri'] 			= strip_tags( $new_tmc_instance['image_uri'] );
		$tmc_instance['pdf_url'] 			= strip_tags( $new_tmc_instance['pdf_url'] );
		
        return $tmc_instance;		
    }
    public function widget( $args, $tmc_instance )
    {
        extract($args);
        echo ($before_widget);
		$link =  $tmc_instance['pdf_url'];
		$image_uri =  $tmc_instance['image_uri'];
		
		if(!$link)$link = '#';
		$filePath = pathinfo($link);
		?>		
		<a class="pdf-button" style="background:url(<?php echo esc_url($image_uri);?>) no-repeat" href="<?php echo esc_url($link); ?>" download="<?php echo esc_attr($filePath['filename']);?>">
			<?php echo esc_attr($tmc_instance[ 'title' ]);?>
		</a>
		<?php
		echo ($after_widget);
    }    
}