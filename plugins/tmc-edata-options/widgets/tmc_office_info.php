<?php

add_action( 'widgets_init', 'indofact_tmc_office_info' );

function indofact_tmc_office_info() {

	register_widget( 'tmc_office_info' );
}

class tmc_office_info extends WP_Widget 
{
	public function __construct() 
	{
        parent::__construct(
	 		'tmc_office_info',
			__('TMC Office Info','indofact'),
			array( 'description' => esc_html__( 'Office Info', 'indofact' ), )
		);
	}
 	public function form( $tmc_instance )
	{
        $defaults = array(
            'title'      			 => '',
			'address_icon'      	 => '',
            'address'      			 => '',
            'phone_icon'      		 => '',
			'back_image_uri'		 => '',
            'phone'      			 => '',
            'email_icon'      		 => '',
            'email'      			 => ''
        );
        $tmc_instance         = wp_parse_args( (array) $tmc_instance, $defaults );
		$backImage = '';
        if(isset($tmc_instance['back_image_uri']))
        {
            $backImage = $tmc_instance['back_image_uri'];
        }
		$tmc_title = '';
		if ( isset( $tmc_instance[ 'title' ] ) ) 
		{
            $tmc_title = $tmc_instance[ 'title' ];
        }
		$tmc_addressIcon = '';
		if ( isset( $tmc_instance[ 'address_icon' ] ) ) 
		{
            $tmc_addressIcon = $tmc_instance[ 'address_icon' ];
        }
		$tmc_address = '';
		if ( isset( $tmc_instance[ 'address' ] ) ) 
		{
            $tmc_address = $tmc_instance[ 'address' ];
        }
		$tmc_phoneIcon = '';
		if ( isset( $tmc_instance[ 'phone_icon' ] ) ) 
		{
            $tmc_phoneIcon = $tmc_instance[ 'phone_icon' ];
        }
		$tmc_phone = '';
		if ( isset( $tmc_instance[ 'phone' ] ) ) 
		{
            $tmc_phone = $tmc_instance[ 'phone' ];
        }
		$tmc_emailIcon = '';
		if ( isset( $tmc_instance[ 'email_icon' ] ) ) 
		{
            $tmc_emailIcon = $tmc_instance[ 'email_icon' ];
        }
		$tmc_email = '';
		if ( isset( $tmc_instance[ 'email' ] ) ) 
		{
            $tmc_email = $tmc_instance[ 'email' ];
        }
        $image = '';
        if(isset($tmc_instance['image']))
        {
            $image = $tmc_instance['image'];
        }
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('back_image_uri')); ?>"><?php echo esc_html( 'Background Image:', 'indofact' ); ?></label><br />
			<?php
				if ( $tmc_instance['back_image_uri'] != '' ) :
				
				$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
				if(isset($tmc_instance['back_image_uri'])){
					$detectedType = exif_imagetype($tmc_instance['back_image_uri']);
				}else{
					$detectedType = '';
				}
				
				$error = !in_array($detectedType, $allowedTypes);			
				endif;
			?>
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('back_image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('back_image_uri')); ?>" value="<?php echo esc_url($backImage); ?>" style="margin-top:5px;">

			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('back_image_uri')); ?>" value="Upload Image" style="margin-top:5px;" />
		</p>
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php echo esc_html__('Title:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $tmc_title ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>">
				<?php echo esc_html__('Address Icon Class:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_icon' )); ?>" type="text" value="<?php echo esc_attr( $tmc_addressIcon ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>">
				<?php echo esc_html__('Address:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" type="text" value="<?php echo esc_attr( $tmc_address ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>">
				<?php echo esc_html__('Phone no. icon:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_icon' )); ?>" type="text" value="<?php echo esc_attr( $tmc_phoneIcon ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>">
				<?php echo esc_html__('Phone no.:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" type="text" value="<?php echo esc_attr( $tmc_phone ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>">
				<?php echo esc_html__('Email Icon:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_icon' )); ?>" type="text" value="<?php echo esc_attr( $tmc_emailIcon ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>">
				<?php echo esc_html__('Email:' ,'indofact') ?>
			</label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="text" value="<?php echo esc_attr( $tmc_email ); ?>" />
		</p>
		
<?php 
	}
	public function update( $new_instance, $old_instance ) 
	{
		// processes widget options to be saved
        $tmc_instance = array();
        $tmc_instance[ 'title' ]		= strip_tags( $new_instance['title'] );
        $tmc_instance[ 'address_icon' ]	= strip_tags( $new_instance['address_icon'] );
        $tmc_instance[ 'address' ]		= strip_tags( $new_instance['address'] );
        $tmc_instance[ 'phone_icon' ]	= strip_tags( $new_instance['phone_icon'] );
        $tmc_instance[ 'phone' ]		= strip_tags( $new_instance['phone'] );
        $tmc_instance[ 'email_icon' ]	= strip_tags( $new_instance['email_icon'] );
        $tmc_instance[ 'email' ]		= strip_tags( $new_instance['email'] );
        $tmc_instance['back_image_uri'] = strip_tags( $new_instance['back_image_uri'] );
		return $tmc_instance;
	}
	public function widget( $args, $tmc_instance )
	{
		// Outputs the content of the widget
        extract( $args );	
		echo ($before_widget);		?>
		<div class="contact-help" style="background-image:url(<?php echo esc_attr($tmc_instance[ 'back_image_uri' ]); ?>);">
			<div class="office-info-col wdt-100">
				<h4><?php echo esc_attr($tmc_instance['title']);?></h4>
				<ul class="office-information">
			<?php 	if($tmc_instance['address']): ?>
						<li class="<?php echo esc_attr($tmc_instance['address_icon']);?>">
							<span class="info-txt"><?php echo esc_attr($tmc_instance['address']);?></span>
						</li>
			<?php 	endif;
					if($tmc_instance['phone']): ?>
						<li class="<?php echo esc_attr($tmc_instance['phone_icon']);?>">
							<span class="info-txt fnt_17"><?php echo esc_attr($tmc_instance['phone']);?></span>
						</li>
			<?php 	endif;
					if($tmc_instance['email']): ?>		
						<li class="<?php echo esc_attr($tmc_instance['email_icon']);?>">
							<span class="info-txt fnt_17"><?php echo esc_attr($tmc_instance['email']);?></span>
						</li>
			<?php 	endif; ?>
				</ul>				
			</div>
		</div>
<?php	wp_reset_postdata();
		echo ($after_widget);
	}
}