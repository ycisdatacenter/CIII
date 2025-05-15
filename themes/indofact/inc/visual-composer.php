<?php
if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page','post','services','team','portfolio','projects'
	) );
}
add_action( 'vc_before_init', 'tmc_vc_set_as_theme' );
if( ! function_exists( 'tmc_vc_set_as_theme' ) ) {
	function tmc_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}
if( ! function_exists( 'tmc_animator_param' ) ){
	function tmc_animator_param( $settings, $value ) {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$animations = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
		if ( $animations ) {
			$output = '<select name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name . ' ' . $type . ' ' . $class ) . '">';
			foreach ( $animations as $key => $val ) {
				if ( is_array( $val ) ) {
					$labels = str_replace( '_', ' ', $key );
					$output .= '<optgroup label="' . ucwords( esc_attr( $labels ) ) . '">';
					foreach ( $val as $label => $style ) {
						$label = str_replace( '_', ' ', $label );
						if ( $label == $value ) {
							$output .= '<option selected value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						} else {
							$output .= '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						}
					}
				} else {
					if ( $key == $value ) {
						$output .= "<option selected value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					} else {
						$output .= "<option value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					}
				}
			}
			$output .= '</select>';
		}
		return $output;
	}
}
add_action( 'admin_init', 'tmc_update_existing_shortcodes' );
if ( ! function_exists( 'tmc_update_existing_shortcodes' ) ) {
	function tmc_update_existing_shortcodes() {
		if ( function_exists( 'vc_add_params' ) ) {
			vc_add_params( 'vc_gallery', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Gallery type','indofact' ),
					'param_name' => 'type',
					'value'      => array(
						__( 'Image grid','indofact' )     => 'image_grid',
						__( 'Slick slider','indofact' )   => 'slick_slider',
						__( 'Slick slider 2','indofact' ) => 'slick_slider_2'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Thumbnail size','indofact' ),
					'param_name' => 'thumbnail_size',
					'dependency' => array(
						'element' => 'type',
						'value'   => array( 'slick_slider_2' )
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css','indofact' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options','indofact' )
				)
			) );
			vc_add_params( 'vc_column_inner', array(
				array(
					'type'        => 'column_offset',
					'heading'     => esc_html__( 'Responsiveness','indofact' ),
					'param_name'  => 'offset',
					'group'       => esc_html__( 'Width & Responsiveness','indofact' ),
					'description' => esc_html__( 'Adjust column for different screen sizes. Control width, offset and visibility settings.','indofact' )
				)
			) );
			vc_add_params( 'vc_separator', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Type','indofact' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Type 1','indofact' ) => 'type_1',
						esc_html__( 'Type 2','indofact' ) => 'type_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css','indofact' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options','indofact' )
				),
			) );
			vc_add_params( 'vc_video', array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Video Width','indofact' ),
					'param_name' => 'size'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Preview Image','indofact' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size','indofact' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.','indofact' )
				),
			) );
			vc_add_params( 'vc_wp_pages', array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css','indofact' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options','indofact' )
				)
			) );
			vc_add_params( 'vc_custom_heading', array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon','indofact' ),
					'param_name' => 'icon',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon Size (px)','indofact' ),
					'param_name' => 'icon_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position','indofact' ),
					'param_name' => 'icon_pos',
					'value'      => array(
						esc_html__( 'Left','indofact' ) => '',
						esc_html__( 'Right','indofact' ) => 'right',
						esc_html__( 'Top','indofact' ) => 'top',
						esc_html__( 'Bottom','indofact' ) => 'bottom'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle','indofact' ),
					'param_name' => 'subtitle',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Subtitle - Color','indofact' ),
					'param_name' => 'subtitle_color',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Stripe - Position','indofact' ),
					'param_name' => 'stripe_pos',
					'value'      => array(
						esc_html__( 'Bottom','indofact' ) => 'bottom',
						esc_html__( 'Between Title and Subtitle','indofact' ) => 'between',
						esc_html__( 'Hide','indofact' ) => 'hide'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font weight','indofact' ),
					'param_name' => 'tmc_title_font_weight',
					'value'      => array(
						esc_html__( 'Select','indofact' )    => '',
						esc_html__( 'Thin','indofact' )      => 100,
						esc_html__( 'Light','indofact' )     => 300,
						esc_html__( 'Regular','indofact' )   => 400,
						esc_html__( 'Medium','indofact' )    => 500,
						esc_html__( 'Semi-bold','indofact' ) => 600,
						esc_html__( 'Bold','indofact' )      => 700,
						esc_html__( 'Black','indofact' )     => 900
					),
					'weight'     => 1
				)
			) );
			vc_add_params( 'vc_basic_grid', array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Gap','indofact' ),
					'param_name'       => 'gap',
					'value'            => array(
						esc_html__( '0px','indofact' )  => '0',
						esc_html__( '1px','indofact' )  => '1',
						esc_html__( '2px','indofact' )  => '2',
						esc_html__( '3px','indofact' )  => '3',
						esc_html__( '4px','indofact' )  => '4',
						esc_html__( '5px','indofact' )  => '5',
						esc_html__( '10px','indofact' ) => '10',
						esc_html__( '15px','indofact' ) => '15',
						esc_html__( '20px','indofact' ) => '20',
						esc_html__( '25px','indofact' ) => '25',
						esc_html__( '30px','indofact' ) => '30',
						esc_html__( '35px','indofact' ) => '35',
						esc_html__( '40px','indofact' ) => '40',
						esc_html__( '45px','indofact' ) => '45',
						esc_html__( '50px','indofact' ) => '50',
						esc_html__( '55px','indofact' ) => '55',
						esc_html__( '60px','indofact' ) => '60',
					),
					'std'              => '30',
					'description'      => esc_html__( 'Select gap between grid elements.','indofact' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				)
			) );
			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color','indofact' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.','indofact' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1','indofact' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2','indofact' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3','indofact' )     => 'theme_style_3',
						                        esc_html__( 'Theme Style 4','indofact' )     => 'theme_style_4',
						                        esc_html__( 'Classic Grey','indofact' )      => 'default',
						                        esc_html__( 'Classic Blue','indofact' )      => 'primary',
						                        esc_html__( 'Classic Turquoise','indofact' ) => 'info',
						                        esc_html__( 'Classic Green','indofact' )     => 'success',
						                        esc_html__( 'Classic Orange','indofact' )    => 'warning',
						                        esc_html__( 'Classic Red','indofact' )       => 'danger',
						                        esc_html__( 'Classic Black','indofact' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)
			) );
		}
	}
}
if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'tmc_vc_elements' );
}
if ( ! function_exists( 'tmc_vc_elements' ) ) {
	function tmc_vc_elements() {
		$project_categories_array = get_terms( 'project_category' );
		$project_categories       = array(
			esc_html__( 'All','indofact' ) => 'all'
		);
		if ( $project_categories_array && ! is_wp_error( $project_categories_array ) ) {
			foreach ( $project_categories_array as $cat ) {
				$project_categories[ $cat->name ] = $cat->slug;
			}
		}
		/*------------------------------------------------------*/
		/* Single Section
		/*------------------------------------------------------*/	
		vc_map( 
			array(
				"name"          => esc_html__("Single Section", "indofact"),
				"base"          => 'tmc_single_section',
				"category"      => esc_html__('TMC Elements', 'indofact'),
				"description"   => esc_html__('Display single section', 'indofact'),
				"save_always"	=> true,
				"params"        => array(
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Layout', 'indofact' ),
									   'param_name'  => 'layout',
									   'description' => esc_html__( 'The layout your section being display', 'indofact' ),
									   'value'       => array(
															esc_html__('Heading and Text', 'indofact') => 'heading_text',
															esc_html__('Heading and Image', 'indofact') => 'heading_image',
															esc_html__('Bold Heading and Image', 'indofact') => 'bold_headng_image',
															esc_html__('Heading and Text two', 'indofact') => 'heading_text_two',
															esc_html__('Company History', 'indofact') => 'company_history',
															esc_html__('Static', 'indofact') => 'static',
															esc_html__('Need Support', 'indofact') => 'need_support',
															esc_html__('Contact Help', 'indofact') => 'contact_help',
															esc_html__('Contact Help Two', 'indofact') => 'contact_help_two',
															esc_html__('Any Question', 'indofact') => 'any_question',
															esc_html__('Who We Are', 'indofact') => 'who_we_are',
															esc_html__('Best Thing In Wordpress', 'indofact') => 'bestthing_in_wordpress',
															esc_html__('Who We Are Two', 'indofact') => 'who_we_are_two',
															
															esc_html__('Who We Are Three', 'indofact') => 'who_we_are_three',
															esc_html__('Static Two', 'indofact') => 'static_two',
															esc_html__('Static Three', 'indofact') => 'static_three',
															esc_html__('Certification', 'indofact') => 'certifield_section',
															esc_html__('Best Thing In Wordpress Two', 'indofact') => 'bestthing_in_wordpress_two',
															esc_html__('Agriculture One', 'indofact') => 'project_agri_one',
															esc_html__('Agriculture Three', 'indofact') => 'project_agri_three',
															esc_html__('Electronic One Image', 'indofact') => 'project_elect_one',
															esc_html__('Electronic Three', 'indofact') => 'project_elect_three',
															esc_html__('Factory Three', 'indofact') => 'project_factory_three',
															esc_html__('Gas One', 'indofact') => 'project_gas_one',
															esc_html__('About Left', 'indofact') => 'about_left',
													   )
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Year','indofact'),
										'param_name'	=> 'year',
										'value'			=> '',
										'description' 	=> 'Enter year here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'company_history'
																		)
														)
									),
									
									array(
										'type'			=> 'colorpicker',
										'class'			=> '',
										'heading'		=> esc_html__('Background Color','indofact'),
										'param_name'	=> 'whoweare_back_color',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'who_we_are_three',
																		)
														)
									),
									
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title','indofact'),
										'param_name'	=> 'title',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'heading_text',
																			'heading_image',
																			'bold_headng_image',
																			'heading_text_two',
																			'company_history',
																			'static',
																			'need_support',
																			'contact_help',
																			'contact_help_two',
																			'who_we_are',
																			'bestthing_in_wordpress',
																			'who_we_are_two',
																			
																			'who_we_are_three',
																			'bestthing_in_wordpress_two',
																			'project_agri_one',
																			'project_agri_three',
																			'project_elect_three',
																			'project_factory_three',
																			'project_gas_one',
																			'about_left'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title Two','indofact'),
										'param_name'	=> 'title_two',
										'value'			=> '',
										'description' 	=> 'Enter title two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'heading_image',
																			'bold_headng_image',
																			'bestthing_in_wordpress',
																			'bestthing_in_wordpress_two'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title Three','indofact'),
										'param_name'	=> 'title_three',
										'value'			=> '',
										'description' 	=> 'Enter title three text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'bold_headng_image',
																		)
														)
									),			
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Sub-Title','indofact'),
										'param_name'	=> 'sub_title',
										'value'			=> '',
										'description' 	=> 'Enter sub-title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_one',
																			'project_elect_three',
																			'project_factory_three',
																			'project_gas_one'
																		)
														)
									),			
									array(
										'type'			=> 'textarea_html',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'content',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'heading_text',
																			'heading_image',
																			'bold_headng_image',
																			'heading_text_two',
																			'company_history',
																			'static',
																			'need_support',
																			'contact_help',
																			'project_agri_one',
																			'project_agri_three',
																			'project_elect_three',
																			'project_factory_three',
																			'project_gas_one',
																			'about_left'
																		)
														)
									),			
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line One','indofact'),
										'param_name'	=> 'line_one',
										'value'			=> 'Vision',
										'description' 	=> 'Enter line one text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'bold_headng_image',
																			'static',
																			'static_two',
																			'static_three',
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Two','indofact'),
										'param_name'	=> 'line_two',
										'value'			=> 'Values',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'bold_headng_image',
																			'static',
																			'static_two',
																			'static_three',
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Three','indofact'),
										'param_name'	=> 'line_three',
										'value'			=> 'Mission',
										'description' 	=> 'Enter line three text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'bold_headng_image',
																			'static',
																			'static_two',
																			'static_three',
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'description_one',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'bestthing_in_wordpress',
																			'certifield_section',
																			'bestthing_in_wordpress_two'
																		)
														)
									),									
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image",
										"description" 	=> "Upload Profile Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'heading_image',
																			'company_history',
																			'contact_help',
																			'contact_help_two',
																			'who_we_are',
																			'who_we_are_two',
																			'project_agri_one',
																			'project_elect_one',
																			'project_factory_three',
																			'project_gas_one',
																		)
														)
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'content_two',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'who_we_are',
																			'who_we_are_two',
																			'who_we_are_three',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Number','indofact'),
										'param_name'	=> 'number',
										'value'			=> '',
										'description' 	=> 'Enter number one text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static',
																			'static_two',
																			'static_three',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon One','indofact'),
										'param_name'	=> 'icon_one',
										'value'			=> '',
										'description' 	=> 'Enter Icon one here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Number Two','indofact'),
										'param_name'	=> 'number_two',
										'value'			=> '',
										'description' 	=> 'Enter number two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static',
																			'static_two',
																			'static_three',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Image Two","indofact"),
										"param_name"	=> "image_two",
										"description" 	=> "Upload Profile Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'contact_help',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon Two','indofact'),
										'param_name'	=> 'icon_two',
										'value'			=> '',
										'description' 	=> 'Enter Icon one here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Number Three','indofact'),
										'param_name'	=> 'number_three',
										'value'			=> '',
										'description' 	=> 'Enter number three text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static',
																			'static_two',
																			'static_three',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon Three','indofact'),
										'param_name'	=> 'icon_three',
										'value'			=> '',
										'description' 	=> 'Enter Icon one here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'about_left',
																			'contact_help_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Number Four','indofact'),
										'param_name'	=> 'number_four',
										'value'			=> '',
										'description' 	=> 'Enter number four text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static',
																			'static_two',
																			'static_three',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon Four','indofact'),
										'param_name'	=> 'icon_four',
										'value'			=> '',
										'description' 	=> 'Enter Icon one here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'about_left'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Four','indofact'),
										'param_name'	=> 'line_four',
										'value'			=> '',
										'description' 	=> 'Enter line four text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static',
																			'static_two',
																			'static_three',
																			'about_left'
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Button Link / Text', 'indofact' ),
										'param_name' => 'whowrlink',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'who_we_are',
																			'certifield_section',
																			'about_left',
																			'who_we_are_two',
																			
																			'who_we_are_three'
																		
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Static class name', 'indofact' ),
										'param_name'  => 'static_class',
										'description' => esc_html__( 'Static class name', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'static_three',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Heading class name', 'indofact' ),
										'param_name'  => 'head_class',
										'description' => esc_html__( 'Heading class name', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'who_we_are',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Extra class name', 'indofact' ),
										'param_name'  => 'el_class',
										'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
									)
								)
				) 
			);	
		/*------------------------------------------------------*/
		/* Multi Section
		/*------------------------------------------------------*/	
		
		vc_map( 
			array(
				"name"          => esc_html__("Multi Section", "indofact"),
				"base"          => 'tmc_multi_section',
				"category"      => esc_html__('TMC Elements', 'indofact'),
				"description"   => esc_html__('Display multi section', 'indofact'),
				"save_always"	=> true,
				"params"        => array(
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Layout', 'indofact' ),
									   'param_name'  => 'layout',
									   'description' => esc_html__( 'The layout your section being display', 'indofact' ),
									   'value'       => array(
															esc_html__('why choose us', 'indofact') => 'why_choose_us',
															esc_html__('why choose us Two', 'indofact') => 'why_choose_us_two',
															esc_html__('Box Column', 'indofact') => 'box_column',
															esc_html__('Banner Bottom Box', 'indofact') => 'banner_bottom',
															esc_html__('Agriculture Section Two', 'indofact') => 'project_agri_two',
															esc_html__('Agriculture Section Four', 'indofact') => 'project_agri_four',
															esc_html__('Factory Section Four', 'indofact') => 'project_factory_four',
													   )
									),
									
									array(
										'type'			=> 'colorpicker',
										'class'			=> '',
										'heading'		=> esc_html__('Left Background','indofact'),
										'param_name'	=> 'left_bg',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																			'project_agri_four'
																		)
														)
									),
									array(
										'type'			=> 'colorpicker',
										'class'			=> '',
										'heading'		=> esc_html__('Right Background','indofact'),
										'param_name'	=> 'right_bg',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																			'project_factory_four'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title','indofact'),
										'param_name'	=> 'title',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																			'why_choose_us_two',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),			
									array(
										'type'			=> 'textarea_html',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'content',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image",
										"description" 	=> "Upload Profile Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Background Image","indofact"),
										"param_name"	=> "bg_image_one",
										"description" 	=> "Upload Background Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'banner_bottom',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line One','indofact'),
										'param_name'	=> 'line_one',
										'value'			=> '',
										'description' 	=> 'Enter line one text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description One','indofact'),
										'param_name'	=> 'desc_one',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image_two",
										"description" 	=> "Upload Profile Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																		)
														)
									),									
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Background Image Two","indofact"),
										"param_name"	=> "bg_image_two",
										"description" 	=> "Upload Background Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'banner_bottom',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Two','indofact'),
										'param_name'	=> 'line_two',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description Two','indofact'),
										'param_name'	=> 'desc_two',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image_three",
										"description" 	=> "Upload Profile Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																		)
														)
									),									
									array(
										'type'     => 'attach_image',
										"class"			=> "",
										"heading"		=> esc_html__("Background Image Three","indofact"),
										"param_name"	=> "bg_image_three",
										"description" 	=> "Upload Background Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'banner_bottom',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Three','indofact'),
										'param_name'	=> 'line_three',
										'value'			=> '',
										'description' 	=> 'Enter line three text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description Three','indofact'),
										'param_name'	=> 'desc_three',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us_two',
																			'box_column',
																			'banner_bottom',
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Four','indofact'),
										'param_name'	=> 'line_four',
										'value'			=> '',
										'description' 	=> 'Enter line four text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_four',
																			'project_factory_four',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 1 Title','indofact'),
										'param_name'	=> 'whychooseus_box1_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 1 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 1 icon','indofact'),
										'param_name'	=> 'whychooseus_box1_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 1 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 1 Text','indofact'),
										'param_name'	=> 'whychooseus_box1_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 1 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 2 Title','indofact'),
										'param_name'	=> 'whychooseus_box2_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 2 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 2 icon','indofact'),
										'param_name'	=> 'whychooseus_box2_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 2 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 2 Text','indofact'),
										'param_name'	=> 'whychooseus_box2_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 2 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 3 Title','indofact'),
										'param_name'	=> 'whychooseus_box3_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 3 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 3 icon','indofact'),
										'param_name'	=> 'whychooseus_box3_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 3 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 3 Text','indofact'),
										'param_name'	=> 'whychooseus_box3_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 3 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 4 Title','indofact'),
										'param_name'	=> 'whychooseus_box4_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 4 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 4 icon','indofact'),
										'param_name'	=> 'whychooseus_box4_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 4 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 4 Text','indofact'),
										'param_name'	=> 'whychooseus_box4_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 4 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 5 Title','indofact'),
										'param_name'	=> 'whychooseus_box5_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 5 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 5 icon','indofact'),
										'param_name'	=> 'whychooseus_box5_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 5 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 5 Text','indofact'),
										'param_name'	=> 'whychooseus_box5_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 5 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 6 Title','indofact'),
										'param_name'	=> 'whychooseus_box6_title',
										'value'			=> '',
										'description' 	=> 'Enter Box 6 Title here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 6 icon','indofact'),
										'param_name'	=> 'whychooseus_box6_icon',
										'value'			=> '',
										'description' 	=> 'Enter Box 6 icon here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Box 6 Text','indofact'),
										'param_name'	=> 'whychooseus_box6_text',
										'value'			=> '',
										'description' 	=> 'Enter Box 6 Text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'why_choose_us',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Project Starting Date Text','indofact'),
										'param_name'	=> 'pro_start_date_text',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Project Starting Date','indofact'),
										'param_name'	=> 'pro_start_date',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Project End Date Text','indofact'),
										'param_name'	=> 'pro_end_date_text',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Project End Date','indofact'),
										'param_name'	=> 'pro_end_date',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Category Text','indofact'),
										'param_name'	=> 'pro_category_text',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Facebook Icon','indofact'),
										'param_name'	=> 'icon_fb',
										'value'			=> 'fa-facebook',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Facebook URL','indofact'),
										'param_name'	=> 'url_fb',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Twitter Icon','indofact'),
										'param_name'	=> 'icon_tw',
										'value'			=> 'fa-twitter',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Twitter URL','indofact'),
										'param_name'	=> 'url_tw',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Google Icon','indofact'),
										'param_name'	=> 'icon_go',
										'value'			=> 'fa-google-plus',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Google URL','indofact'),
										'param_name'	=> 'url_go',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Linkedin Icon','indofact'),
										'param_name'	=> 'icon_li',
										'value'			=> 'fa-linkedin',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Linkedin URL','indofact'),
										'param_name'	=> 'url_li',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Category','indofact'),
										'param_name'	=> 'pro_category',
										'value'			=> '',
										'description' 	=> 'Enter line eight text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_agri_two',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Extra class name', 'indofact' ),
										'param_name'  => 'el_class',
										'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
									)
								)
				) 
			);	
			
		/*------------------------------------------------------*/
		/* TMC Services
		/*------------------------------------------------------*/
	
		$args_c = array(
					'type'                     => 'services',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'services-category',
					'pad_counts'               => false );	
	
		$categories = get_categories( $args_c );
		$cat = array();
		$cat[0] = 'All';
		foreach ($categories as $category)	
		{
			$cat[] = $category->name;
		}	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Services", "indofact"),
				"base"                      => 'tmc_services',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Services', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Services layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your services being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Layout 1', 'indofact') 	=> 'layout1',
															esc_html__('Layout 2', 'indofact') 	=> 'layout2',
															esc_html__('Layout 3', 'indofact') 	=> 'layout3',
															esc_html__('Layout 4', 'indofact') 	=> 'layout4',
															esc_html__('Layout 5', 'indofact') 	=> 'layout5',
															esc_html__('Layout 6', 'indofact') 	=> 'layout6',
															esc_html__('Layout 7', 'indofact') 	=> 'layout7',
															esc_html__('Layout 8', 'indofact') 	=> 'layout8',
														)
													),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														// esc_html__('None', 'indofact')       => 'none',
														// esc_html__('ID', 'indofact')         => 'ID',
														esc_html__('Title', 'indofact')      => 'title',
														// esc_html__('Name', 'indofact')       => 'name',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
														// esc_html__('Page Order', 'indofact') => 'menu_order'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Categories List', 'indofact' ),
													'param_name'  => 'categoriesname',
													'description' => esc_html__( 'Select a categorie.', 'indofact' ),
													'value'       => $cat
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '16',
													'description' 	=> 'How many post to show?',
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Column', 'indofact' ),
													'param_name'  => 'column',
													'description' => esc_html__( 'How many column will be display on a row?', 'indofact' ),
													'value'       => array(
														esc_html__('2 Columns', 'indofact') => '2',
														esc_html__('3 Columns', 'indofact') => '3',
														esc_html__('4 Columns', 'indofact') => '4'
													),
													'default'	  => '4',
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2',
																			'layout3',
																			'layout4',
																			'layout5',
																			'layout6',
																		)
																	),
												    ),
												array(
													'type'        => 'checkbox',
													'heading'     => esc_html__('Enable Arrow','indofact'),
													'value'       => array(esc_html__('Yes.','indofact') => 'yes'),
													'param_name'  => 'check_arrow',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'layout7',
																					)
																	)
												),	
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Read more text','indofact'),
													'param_name'	=> 'read_more',
													'value'			=> 'Read more',
													'description' 	=> 'Update read more text here',
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2',
																			'layout3',
																			'layout4',
																			'layout5',
																		)
																	),
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);
			
		/*------------------------------------------------------*/
		/* TMC Heading
		/*------------------------------------------------------*/	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Heading", "indofact"),
				"base"                      => 'tmc_heading',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Heading', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Heading layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your heading being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Style One', 'indofact') => 'style_one',
														)
													),
												array(
												   'type'        => 'dropdown',
												   'heading'     => esc_html__( 'Heading Tag', 'indofact' ),
												   'param_name'  => 'tag',
												   'description' => esc_html__( 'Select heading tag', 'indofact' ),
												   'value'       => array(
														esc_html__('H1', 'indofact')    	=> 'h1',
														esc_html__('H2', 'indofact')    	=> 'h2',
														esc_html__('H3', 'indofact')    	=> 'h3',
														esc_html__('H4', 'indofact')    	=> 'h4',
														esc_html__('H5', 'indofact')    	=> 'h5',
														esc_html__('H6', 'indofact')    	=> 'h6',
												   )
												),
												array(
													'type'			=> 'textfield',
													'heading'		=> esc_html__('Title','indofact'),
													'param_name'	=> 'title',
													'value'			=> '',
													'description' 	=> 'Enter title text here.',
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Container class', 'indofact' ),
													'param_name'  => 'container_class',
													'description' => esc_html__( 'Enter class here.', 'indofact' )
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);	
			
	/*------------------------------------------------------*/
		/* TMC Services Section
		/*------------------------------------------------------*/	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Services Section", "indofact"),
				"base"                      => 'tmc_services_section',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Heading', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												
												array(
													'type'     => 'attach_image',
													"heading"		=> esc_html__("Image","indofact"),
													"param_name"	=> "image",
													"description" 	=> "Upload Image",
												),
												array(
													'type'			=> 'textfield',
													'heading'		=> esc_html__('Title','indofact'),
													'param_name'	=> 'title',
													'value'			=> 'Steven Brown',
													'description' 	=> 'Enter title text here.',
												),
												array(
													'type'			=> 'textarea',
													'heading'		=> esc_html__('Content','indofact'),
													'param_name'	=> 'content',
													'value'			=> 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  voluptatum deleniti atque corrupti quos dolores et quas molestias',
													'description' => esc_html__( 'Enter description here.', 'indofact' ),
												),
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Container class', 'indofact' ),
													'param_name'  => 'container_class',
													'description' => esc_html__( 'Enter class here.', 'indofact' )
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);	
			
		/*------------------------------------------------------*/
		/* TMC Projects
		/*------------------------------------------------------*/
	
		$args_c = array(
					'type'                     => 'portfolio',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'portfolio-category',
					'pad_counts'               => false );	
	
		$categories = get_categories( $args_c );
		$cat = array();
		$cat[0] = 'All';
		foreach ($categories as $category)	
		{
			$cat[] = $category->name;
		}	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Projects", "indofact"),
				"base"                      => 'tmc_projects',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Projects', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Projects layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your projects being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Projects Layout One', 'indofact') => 'projects_layout_four',
															esc_html__('Projects Layout Two', 'indofact') => 'projects_layout_two',
															esc_html__('Projects Layout Three', 'indofact') => 'projects_layout_three',
															esc_html__('Projects Layout Home6', 'indofact') => 'projects_layout_home6',
															esc_html__('Projects Layout Home7', 'indofact') => 'projects_layout_home7',
															esc_html__('Projects Layout Home8', 'indofact') => 'projects_layout_home8',
														)
													),
												array(
													'type'        => 'checkbox',
													'heading'     => esc_html__('Enable Title','indofact'),
													'value'       => array(esc_html__('Yes.','indofact') => 'yes'),
													'param_name'  => 'title_check',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_two',
																						'projects_layout_three',
																						'projects_layout_four',
																					)
																	)
												),
												array(
													'type'        => 'checkbox',
													'heading'     => esc_html__('Enable Title Line','indofact'),
													'value'       => array(esc_html__('Yes.','indofact') => 'yes'),
													'param_name'  => 'title_line_check',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_home6',
																					)
																	)
												),
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Project Title 1', 'indofact' ),
													'param_name'  => 'project_title1',
													'description' => esc_html__( 'Enter Line title text here.', 'indofact' ),
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_home6',
																					)
																	)
												),
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Project Title', 'indofact' ),
													'param_name'  => 'project_title',
													'description' => esc_html__( 'Enter Project Title here.', 'indofact' ),
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_two',
																						'projects_layout_three',
																						'projects_layout_four',
																						'projects_layout_home6',
																					)
																	)
												),
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Project Title Content Text', 'indofact' ),
													'param_name'  => 'project_title_content',
													'description' => esc_html__( 'Enter Content text here.', 'indofact' ),
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_home6',
																					)
																	)
												),
												array(
													'type'			=> 'colorpicker',
													'class'			=> '',
													'heading'		=> esc_html__('Title Color','indofact'),
													'param_name'	=> 'title_color',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_two',
																						'projects_layout_home6',
																						'projects_layout_home8',
																					)
																	)
												),
												array(
													'type'			=> 'colorpicker',
													'class'			=> '',
													'heading'		=> esc_html__('Title Line Color','indofact'),
													'param_name'	=> 'title_line_color',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_home6',
																					)
																	)
												),	
												array(
													'type'			=> 'colorpicker',
													'class'			=> '',
													'heading'		=> esc_html__('Title1 Text Color','indofact'),
													'param_name'	=> 'title1_color',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_home6',
																					)
																	)
												),	
												array(
													'type'       => 'vc_link',
													'heading'    => esc_html__( 'Button Link / Text', 'indofact' ),
													'param_name' => 'link',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_three',
																						'projects_layout_home6',
																					)
																	)
												),
												
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Categories List', 'indofact' ),
													'param_name'  => 'categoriesname',
													'description' => esc_html__( 'Select a categorie.', 'indofact' ),
													'value'       => $cat
												),
												array(
													'type'        => 'checkbox',
													'heading'     => esc_html__('Disable filter','indofact'),
													'value'       => array(esc_html__('Yes.','indofact') => 'yes'),
													'param_name'  => 'disable_filter',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects',
																						'projects_layout_four',
																						'projects_layout_two',
																						'projects_layout_home8',
																					)
																	)
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '6',
													'description' 	=> 'How many post to show?',
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Read more text','indofact'),
													'param_name'	=> 'read_more',
													'value'			=> 'View Project',
													'description' 	=> 'Update read more text here',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'projects_layout_two',
																						'projects_layout_three',
																						'projects_layout_four',
																						'projects_layout_home6',
																					)
																	)
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);
		/*------------------------------------------------------*/
		/* TMC Testimonials
		/*------------------------------------------------------*/
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Testimonials", "indofact"),
				"base"                      => 'tmc_testimonials',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Testimonials', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Testimonials layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your testimonials being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Carousel', 'indofact') => 'carousel',
															esc_html__('Grid', 'indofact') => 'grid',
															esc_html__('Carousel Two', 'indofact') => 'carousel_two',
															esc_html__('Carousel Three', 'indofact') => 'carousel_three',
															esc_html__('Carousel Four', 'indofact') => 'carousel_four',
															esc_html__('Carousel Five', 'indofact') => 'carousel_five',
															esc_html__('Carousel Six', 'indofact') => 'carousel_six',
														)
													),
												
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Column', 'indofact' ),
													'param_name'  => 'column',
													'description' => esc_html__( 'How many column will be display on a row?', 'indofact' ),
													'value'       => array(
														esc_html__('2 Columns', 'indofact') => '2',
														esc_html__('3 Columns', 'indofact') => '3'
													),
													'default'	  => '4',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'grid',
																					)
																	)
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '3',
													'description' 	=> 'How many post to show?',
												),
												array(
													'type'			=> 'textfield',
													'heading'		=> esc_html__('Title','indofact'),
													'param_name'	=> 'title',
													'value'			=> '',
													'description' 	=> 'Enter title text here.',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																					'carousel',
																					'carousel_two',
																					'carousel_three',
																					'carousel_four',
																					)
																	)
												),
												array(
													'type'			=> 'colorpicker',
													'class'			=> '',
													'heading'		=> esc_html__('background Color','indofact'),
													'param_name'	=> 'bg_color',
													'dependency' => Array(
																		'element' => 'layout', 
																		'value' => array(
																						'carousel',
																						'carousel_four'
																					)
																	)
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);
		/*------------------------------------------------------*/
		/* TMC News
		/*------------------------------------------------------*/	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC News", "indofact"),
				"base"                      => 'tmc_news',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display News', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Layour', 'indofact' ),
													'param_name'  => 'layout',
													'description' => esc_html__( 'Select the layout of news', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Layout 1', 'indofact')      => 'layout1',
														esc_html__('Layout 2', 'indofact')     => 'layout2',
														esc_html__('Layout 3', 'indofact')     => 'layout3',
														esc_html__('Layout 4', 'indofact')     => 'layout4',
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Column', 'indofact' ),
													'param_name'  => 'column',
													'description' => esc_html__( 'How many column will be display on a row?', 'indofact' ),
													'value'       => array(
														esc_html__('2 Columns', 'indofact') => '2',
														esc_html__('3 Columns', 'indofact') => '3',
														esc_html__('4 Columns', 'indofact') => '4'
													),
													'default'	  => '4',
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2',
																			'layout4'
																		)
														)
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '3',
													'description' 	=> 'How many post to show?',
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'By Text', 'indofact' ),
													'param_name'  => 'by',
													'description' => esc_html__( 'Enter text here.', 'indofact' ),
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2'
																		)
														)
												),					
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'By Text limit', 'indofact' ),
													'param_name'  => 'by_lmt',
													'description' => esc_html__( 'Enter text limit here.', 'indofact' ),
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2'
																		)
														)
												),			
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Comment Text', 'indofact' ),
													'param_name'  => 'cmt',
													'description' => esc_html__( 'Enter text here.', 'indofact' ),
													'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'layout1',
																			'layout2'
																		)
														)
												),			
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);	
		/*------------------------------------------------------*/
		/* TMC Client
		/*------------------------------------------------------*/
	
		$args_c = array(
					'type'                     => 'client',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'client-category',
					'pad_counts'               => false );	
	
		$categories = get_categories( $args_c );
		$cat = array();
		$cat[0] = 'All';
		foreach ($categories as $category)	
		{
			$cat[] = $category->name;
		}	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Client", "indofact"),
				"base"                      => 'tmc_client',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Client', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Client layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your client being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Style One', 'indofact') => 'style_one',
														)
													),
												
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Categories List', 'indofact' ),
													'param_name'  => 'categoriesname',
													'description' => esc_html__( 'Select a categorie.', 'indofact' ),
													'value'       => $cat
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '6',
													'description' 	=> 'How many post to show?',
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);	
		/*------------------------------------------------------*/
		/* TMC Team
		/*------------------------------------------------------*/
	
		$args_c = array(
					'type'                     => 'team',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'team-category',
					'pad_counts'               => false );	
	
		$categories = get_categories( $args_c );
		$cat = array();
		$cat[0] = 'All';
		foreach ($categories as $category)	
		{
			$cat[] = $category->name;
		}	
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Team", "indofact"),
				"base"                      => 'tmc_team',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display Team', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Services layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your team being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Experienced', 'indofact') => 'experienced',
															esc_html__('Company', 'indofact') => 'company',
															esc_html__('Demo 2', 'indofact') => 'demo2',
															esc_html__('Demo 3', 'indofact') => 'demo3',
														)
													),
												
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Categories List', 'indofact' ),
													'param_name'  => 'categoriesname',
													'description' => esc_html__( 'Select a categorie.', 'indofact' ),
													'value'       => $cat
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '3',
													'description' 	=> 'How many post to show?',
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Column', 'indofact' ),
													'param_name'  => 'column',
													'description' => esc_html__( 'How many column will be display on a row?', 'indofact' ),
													'value'       => array(
														esc_html__('2 Columns', 'indofact') => '2',
														esc_html__('3 Columns', 'indofact') => '3',
														esc_html__('4 Columns', 'indofact') => '4'
													),
													'default'	  => '4'
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);
	
	/*------------------------------------------------------*/
	/* BROCHURE DOWNLOAD BUTTON
	/*------------------------------------------------------*/
	vc_map( array(
		"name"                      => esc_html__("Tmc Brocher Download Button", 'indofact'),
		"base"                      => 'tmc_brochure_button',
		"category"                  => esc_html__('TMC Elements', 'indofact'),
		"description"               => esc_html__('Display Download Button', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
											array(
												'type'     => 'attach_image',
												"class"			=> "",
												"heading"		=> esc_html__("Image","indofact"),
												"param_name"	=> "image",
												"description" 	=> "Upload Image",
											),
										array(
											'type'        => 'textfield',
											'heading'     => esc_html__( 'Text on the button', 'indofact' ),
											'holder'      => 'button',
											'class'       => 'wpb_button',
											'param_name'  => 'btntitle',
											'value'       => esc_html__( 'Text on the button', 'indofact' ),
											'description' => esc_html__( 'Text on the button.', 'indofact' )
										),
										array(
											'type'        => 'attach_image',
											'heading'     => esc_html__( 'File URL (Link)', 'indofact' ),
											'param_name'  => 'btnlink',
											'description' => esc_html__( 'Select the file to be downloaded.', 'indofact' )
										)
									),
			) 
		);
	
	/*------------------------------------------------------*/
	/* Maintenance
	/*------------------------------------------------------*/
	vc_map( array(
		"name"                      => esc_html__("Tmc Maintenance", 'indofact'),
		"base"                      => 'tmc_maintenance',
		"category"                  => esc_html__('TMC Elements', 'indofact'),
		"description"               => esc_html__('Display maintenance', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
											
									),
			) 
		);
	
	
	/*------------------------------------------------------*/
	/* Coming Soon
	/*------------------------------------------------------*/
	vc_map( array(
		"name"                      => esc_html__("Tmc Coming Soon", 'indofact'),
		"base"                      => 'tmc_coming_soon',
		"category"                  => esc_html__('TMC Elements', 'indofact'),
		"description"               => esc_html__('Display coming soon', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
											array(
												'type'     => 'attach_image',
												'class'			=> '',
												'heading'		=> esc_html__('Logo','indofact'),
												'param_name'	=> 'logo',
												'description' 	=> 'Upload Image',
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Title','indofact'),
												'param_name'	=> 'title',
												'value'			=> '',
												'description' 	=> 'Enter title text here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Day Text','indofact'),
												'param_name'	=> 'day_text',
												'value'			=> '',
												'description' 	=> 'Enter day text here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Day Number','indofact'),
												'param_name'	=> 'day_no',
												'value'			=> '',
												'description' 	=> 'Enter day number here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Hour Text','indofact'),
												'param_name'	=> 'hour_text',
												'value'			=> '',
												'description' 	=> 'Enter day text here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Hour Number','indofact'),
												'param_name'	=> 'hour_no',
												'value'			=> '',
												'description' 	=> 'Enter hour number here.'
											),
											
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Minute Text','indofact'),
												'param_name'	=> 'minute_text',
												'value'			=> '',
												'description' 	=> 'Enter minute text here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Minute Number','indofact'),
												'param_name'	=> 'minute_no',
												'value'			=> '',
												'description' 	=> 'Enter minute number here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Second Text','indofact'),
												'param_name'	=> 'sec_text',
												'value'			=> '',
												'description' 	=> 'Enter second text here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Second Number','indofact'),
												'param_name'	=> 'sec_no',
												'value'			=> '',
												'description' 	=> 'Enter second number here.'
											),
											array(
												'type'			=> 'textfield',
												'heading'		=> esc_html__('Button Text','indofact'),
												'param_name'	=> 'btt_text',
												'value'			=> '',
												'description' 	=> 'Enter button text here.'
											),
											
									),
			) 
		);
		
		/*------------------------------------------------------*/
		/* Single Service
		/*------------------------------------------------------*/	
		
		vc_map( 
			array(
				"name"          => esc_html__("Single Service", "indofact"),
				"base"          => 'tmc_single_service',
				"category"      => esc_html__('TMC Elements', 'indofact'),
				"description"   => esc_html__('Display single service', 'indofact'),
				"save_always"	=> true,
				"params"        => array(
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Layout', 'indofact' ),
									   'param_name'  => 'layout',
									   'description' => esc_html__( 'The layout your section being display', 'indofact' ),
									   'value'       => array(
															esc_html__('Image and Text', 'indofact') 		=> 'img_text',
															esc_html__('Image and Text Two', 'indofact')	=> 'img_text_two',
															esc_html__('Two Image and Text', 'indofact')	=> 'two_img_text',
															esc_html__('Heading and Text', 'indofact')	    => 'heading_text',
															esc_html__('Any Question', 'indofact') 			=> 'any_question',
													   )
									),
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Image Align', 'indofact' ),
									   'param_name'  => 'image_align',
									   'description' => esc_html__( 'Align your image being display', 'indofact' ),
									   'value'       => array(
															esc_html__('Left', 'indofact') 		=> 'left',
															esc_html__('Right', 'indofact')		=> 'right'
													   ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text_two'
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image",
										"description" 	=> "Upload Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'img_text_two',
																			'two_img_text',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Image Two","indofact"),
										"param_name"	=> "image_two",
										"description" 	=> "Upload Image two",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'two_img_text'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title','indofact'),
										'param_name'	=> 'title',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'img_text_two',
																			'two_img_text',
																			'heading_text',
																			'any_question',
																		)
														)
									),			
									array(
										'type'			=> 'textarea_html',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'content',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'img_text_two',
																			'two_img_text',
																			'heading_text',
																			'any_question',
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Button Link / Text', 'indofact' ),
										'param_name' => 'link',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'any_question',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Extra class name', 'indofact' ),
										'param_name'  => 'el_class',
										'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
									)
								)
				) 
			);
			
		/*------------------------------------------------------*/
		/* TMC Portfolio
		/*------------------------------------------------------*/
		vc_map( 
			array(
				"name"                      => esc_html__("TMC Portfolio", "indofact"),
				"base"                      => 'tmc_portfolio',
				"category"                  => esc_html__('TMC Elements', 'indofact'),
				"description"               => esc_html__('Display portfolio', 'indofact'),
				"save_always" 				=> true,
				"params"                    => array(
												array(
													   'type'        => 'dropdown',
													   'heading'     => esc_html__( 'Portfolio layout', 'indofact' ),
													   'param_name'  => 'layout',
													   'description' => esc_html__( 'The layout your portfolio being display', 'indofact' ),
													   'value'       => array(
															esc_html__('Portfolio Three', 'indofact') 		=> 'portfolio_three',
															esc_html__('Portfolio Four', 'indofact') 		=> 'portfolio_four',
															esc_html__('Portfolio Five', 'indofact') 		=> 'portfolio_five',
														)
													),
	
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Orderby', 'indofact' ),
													'param_name'  => 'orderby',
													'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
													'default'	  => 'none',
													'value'       => array(
														esc_html__('Title', 'indofact')      => 'title',
														esc_html__('Random', 'indofact')     => 'rand',
														esc_html__('Date', 'indofact')       => 'date'
													)
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Order', 'indofact' ),
													'param_name'  => 'order',
													'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
													'default'	  => 'DESC',
													'value'       => array(
														esc_html__('DESC', 'indofact') => 'DESC',
														esc_html__('ASC', 'indofact') => 'ASC'
													)
												),
												array(
													'type'			=> 'textfield',
													'class'			=> '',
													'heading'		=> esc_html__('Number of posts','indofact'),
													'param_name'	=> 'number',
													'value'			=> '6',
													'description' 	=> 'How many post to show?',
												),
												array(
													'type'        => 'dropdown',
													'heading'     => esc_html__( 'Column', 'indofact' ),
													'param_name'  => 'column',
													'description' => esc_html__( 'How many column will be display on a row?', 'indofact' ),
													'value'       => array(
														esc_html__('2 Columns', 'indofact') => '2',
														esc_html__('3 Columns', 'indofact') => '3',
														esc_html__('4 Columns', 'indofact') => '4',
														esc_html__('5 Columns', 'indofact') => '5'
													),
													'default'	  => '2'
												),
												array(
													'type'			=> 'textfield',
													'heading'		=> esc_html__('View Project text','indofact'),
													'param_name'	=> 'read_more',
													'value'			=> 'View Project',
													'description' 	=> 'Update view project text here',
												),				
												array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
												)
											)
				) 
			);
			
		/*------------------------------------------------------*/
		/* Single Portfolio
		/*------------------------------------------------------*/	
		
		vc_map( 
			array(
				"name"          => esc_html__("Single Portfolio", "indofact"),
				"base"          => 'tmc_single_portfolio',
				"category"      => esc_html__('TMC Elements', 'indofact'),
				"description"   => esc_html__('Display single portfolio', 'indofact'),
				"save_always"	=> true,
				"params"        => array(
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Layout', 'indofact' ),
									   'param_name'  => 'layout',
									   'description' => esc_html__( 'The layout your section being display', 'indofact' ),
									   'value'       => array(
															esc_html__('Image and Text', 'indofact') 		=> 'img_text',
															esc_html__('Project Details', 'indofact') 		=> 'project_details',
															esc_html__('Title Text', 'indofact') 			=> 'title_text',
															esc_html__('Info And Image', 'indofact') 		=> 'info_image',
															esc_html__('Single Image', 'indofact') 			=> 'single_img',
															esc_html__('Title Text Bold', 'indofact') 		=> 'title_text_bold',
															esc_html__('Right Image and Text', 'indofact') 	=> 'rgt_img_text',
															esc_html__('Info And Left Image', 'indofact') 	=> 'info_left_image',
															esc_html__('Right image and Text', 'indofact') 	=> 'rgt_image_text',
													   )
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Image","indofact"),
										"param_name"	=> "image",
										"description" 	=> "Upload Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'info_image',
																			'single_img',
																			'rgt_img_text',
																			'info_left_image',
																			'rgt_image_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title','indofact'),
										'param_name'	=> 'title',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'title_text',
																			'info_image',
																			'title_text_bold',
																			'rgt_img_text',
																			'info_left_image',
																			'rgt_image_text',
																		)
														)
									),			
									array(
										'type'			=> 'textarea_html',
										'heading'		=> esc_html__('Description','indofact'),
										'param_name'	=> 'content',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																			'title_text',
																			'info_image',
																			'title_text_bold',
																			'rgt_img_text',
																			'info_left_image',
																			'rgt_image_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line One','indofact'),
										'param_name'	=> 'line_one',
										'value'			=> '',
										'description' 	=> 'Enter line one text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'info_image',
																			'info_left_image',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Two','indofact'),
										'param_name'	=> 'line_two',
										'value'			=> '',
										'description' 	=> 'Enter line two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'info_image',
																			'info_left_image',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Three','indofact'),
										'param_name'	=> 'line_three',
										'value'			=> '',
										'description' 	=> 'Enter line three text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'info_image',
																			'info_left_image',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Line Four','indofact'),
										'param_name'	=> 'line_four',
										'value'			=> '',
										'description' 	=> 'Enter line four text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'info_image',
																			'info_left_image',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Client Text','indofact'),
										'param_name'	=> 'client_txt',
										'value'			=> '',
										'description' 	=> 'Enter client text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Client Name','indofact'),
										'param_name'	=> 'client_nme',
										'value'			=> '',
										'description' 	=> 'Enter client name here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Skill Text','indofact'),
										'param_name'	=> 'skill_txt',
										'value'			=> '',
										'description' 	=> 'Enter skill text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Skill Name','indofact'),
										'param_name'	=> 'skill_nme',
										'value'			=> '',
										'description' 	=> 'Enter skill name here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Web Text','indofact'),
										'param_name'	=> 'web_txt',
										'value'			=> '',
										'description' 	=> 'Enter web text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Web Name','indofact'),
										'param_name'	=> 'web_nme',
										'value'			=> '',
										'description' 	=> 'Enter web name here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Start Date Text','indofact'),
										'param_name'	=> 'srt_date_txt',
										'value'			=> '',
										'description' 	=> 'Enter start date text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Start Date','indofact'),
										'param_name'	=> 'srt_date',
										'value'			=> '',
										'description' 	=> 'Enter start date here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('End Date Text','indofact'),
										'param_name'	=> 'end_date_txt',
										'value'			=> '',
										'description' 	=> 'Enter end date text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('End Date','indofact'),
										'param_name'	=> 'end_date',
										'value'			=> '',
										'description' 	=> 'Enter end date here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Category Text','indofact'),
										'param_name'	=> 'cat_txt',
										'value'			=> '',
										'description' 	=> 'Enter category text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Category Name','indofact'),
										'param_name'	=> 'cat_nme',
										'value'			=> '',
										'description' 	=> 'Enter category name here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details'
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Facebook Link', 'indofact' ),
										'param_name' => 'fb_link',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details',
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Twitter Link', 'indofact' ),
										'param_name' => 'tw_link',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details',
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Google Plus Link', 'indofact' ),
										'param_name' => 'gp_link',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details',
																		)
														)
									),
									array(
										'type'       => 'vc_link',
										'heading'    => esc_html__( 'Linkedin Link', 'indofact' ),
										'param_name' => 'lk_link',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'project_details',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Extra class name', 'indofact' ),
										'param_name'  => 'el_class',
										'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
									)
								)
				) 
			);
			
		/*------------------------------------------------------*/
	/* TMC Business Consultant
	/*------------------------------------------------------*/
	vc_map( array(
		"name"                      => esc_html__("TMC Business Consultant", 'indofact'),
		"base"                      => 'tmc_business_consultant',
		"category"                  => esc_html__('TMC Elements', 'indofact'),
		"description"               => esc_html__('Display Download Button', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title 1','indofact'),
										'param_name'	=> 'title1',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										),	
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title 2','indofact'),
										'param_name'	=> 'title2',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										),	
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title 3','indofact'),
										'param_name'	=> 'title3',
										'value'			=> '',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description 1','indofact'),
										'param_name'	=> 'content1',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										),
										array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description 2','indofact'),
										'param_name'	=> 'content2',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										),
										array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description 3','indofact'),
										'param_name'	=> 'content3',
										'value'			=> '',
										'description' => esc_html__( 'Enter description here.', 'indofact' ),
										),
										array(
											'type'       => 'colorpicker',
											'heading'    => esc_html__( 'Title - Color','indofact' ),
											'param_name' => 'title_color',
											'weight'     => 1
										),
										array(
											'type'       => 'colorpicker',
											'heading'    => esc_html__( 'Description - Color','indofact' ),
											'param_name' => 'content_color',
											'weight'     => 1
										),
										array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Container class', 'indofact' ),
													'param_name'  => 'container_class',
													'description' => esc_html__( 'Enter class here.', 'indofact' )
												),	
										array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
										)
									),
			) 
		);
		
	/*------------------------------------------------------*/
	/* TMC Contact Icon
	/*------------------------------------------------------*/
	vc_map( array(
		"name"                      => esc_html__("TMC Contact Icon", 'indofact'),
		"base"                      => 'tmc_contact_icon',
		"category"                  => esc_html__('TMC Elements', 'indofact'),
		"description"               => esc_html__('Display Download Button', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon 1','indofact'),
										'param_name'	=> 'icon1',
										'value'			=> 'fa-facebook',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('URL 1','indofact'),
										'param_name'	=> 'url1',
										'value'			=> '#',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon 2','indofact'),
										'param_name'	=> 'icon2',
										'value'			=> 'fa-twitter',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('URL 2','indofact'),
										'param_name'	=> 'url2',
										'value'			=> '#',
										'description' 	=> 'Enter title text here.',
										),	
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon 3','indofact'),
										'param_name'	=> 'icon3',
										'value'			=> 'fa-google-plus',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('URL 3','indofact'),
										'param_name'	=> 'url3',
										'value'			=> '#',
										'description' 	=> 'Enter title text here.',
										),	
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Icon 4','indofact'),
										'param_name'	=> 'icon4',
										'value'			=> 'fa-linkedin',
										'description' 	=> 'Enter title text here.',
										),
										array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('URL 4','indofact'),
										'param_name'	=> 'url4',
										'value'			=> '#',
										'description' 	=> 'Enter title text here.',
										),	
										array(
											'type'       => 'colorpicker',
											'heading'    => esc_html__( 'Icon - Color','indofact' ),
											'param_name' => 'icon_color',
											'weight'     => 1
										),
										array(
											'type'       => 'colorpicker',
											'heading'    => esc_html__( 'Background - Color','indofact' ),
											'param_name' => 'background_color',
											'weight'     => 1
										),
										array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Container class', 'indofact' ),
													'param_name'  => 'container_class',
													'description' => esc_html__( 'Enter class here.', 'indofact' )
												),	
										array(
													'type'        => 'textfield',
													'heading'     => esc_html__( 'Extra class name', 'indofact' ),
													'param_name'  => 'el_class',
													'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
										)
									),
			) 
		);
		
		/*------------------------------------------------------*/
	/* TMC Blog Full
	/*------------------------------------------------------*/
		
		vc_map( array(
		"name"                      => esc_html__("TMC Blog Full", "indofact"),
		"base"                      => 'tmc_blog_full',
		"category"                  => esc_html__('indofact Blog Full', 'indofact'),
		"description"               => esc_html__('Display Blog Full', 'indofact'),
		"save_always" 				=> true,
		"params"                    => array(
			
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Layout', 'indofact' ),
				'param_name'  => 'layout',
				'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
				'default'	  => 'full',
				'value'       => array(
					esc_html__("Full", "indofact") => "full",
					esc_html__("Grid", "indofact") => "grid"
				)
			),
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Orderby', 'indofact' ),
				'param_name'  => 'orderby',
				'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'indofact' ),
				'default'	  => 'none',
				'value'       => array(
					esc_html__("None", "indofact")       => "none",
					esc_html__("ID", "indofact")         => "ID",
					esc_html__("Title", "indofact")      => "title",
					esc_html__("Name", "indofact")       => "name",
					esc_html__("Random", "indofact")     => "rand",
					esc_html__("Date", "indofact")       => "date",
					esc_html__("Page Order", "indofact") => "menu_order"
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order', 'indofact' ),
				'param_name'  => 'order',
				'description' => esc_html__( 'Ascending or descending order', 'indofact' ),
				'default'	  => 'DESC',
				'value'       => array(
					esc_html__("DESC", "indofact") => "DESC",
					esc_html__("ASC", "indofact") => "ASC"
				)
			),
		
			array(
				"type"			=> "textfield",
				"class"			=> "",
				"heading"		=> esc_html__("Number of posts","indofact"),
				"param_name"	=> "number",
				"value"			=> "9",
				"description" 	=> "How many post to show?",
			),
		
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'indofact' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
			)
		),
		) );
		/*------------------------------------------------------*/
		/* Contact Info
		/*------------------------------------------------------*/	
		
		vc_map( 
			array(
				"name"          => esc_html__("Contact Info", "indofact"),
				"base"          => 'tmc_contact_info',
				"category"      => esc_html__('TMC Elements', 'indofact'),
				"description"   => esc_html__('Display contact info', 'indofact'),
				"save_always"	=> true,
				"params"        => array(
									array(
									   'type'        => 'dropdown',
									   'heading'     => esc_html__( 'Layout', 'indofact' ),
									   'param_name'  => 'layout',
									   'description' => esc_html__( 'The layout your section being display', 'indofact' ),
									   'value'       => array(
															esc_html__('Image and Text', 'indofact') 		=> 'img_text',
													   )
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Address Image","indofact"),
										"param_name"	=> "add_image",
										"description" 	=> "Upload Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Address Title','indofact'),
										'param_name'	=> 'add_title',
										'value'			=> '',
										'description' 	=> 'Enter address title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Address Text','indofact'),
										'param_name'	=> 'add_text',
										'value'			=> '',
										'description' 	=> 'Enter address text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Phone Image","indofact"),
										"param_name"	=> "phn_image",
										"description" 	=> "Upload Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Phone Title','indofact'),
										'param_name'	=> 'phn_title',
										'value'			=> '',
										'description' 	=> 'Enter phone title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Phone Text','indofact'),
										'param_name'	=> 'phn_text',
										'value'			=> '',
										'description' 	=> 'Enter phone text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Phone Text Two','indofact'),
										'param_name'	=> 'phn_text_two',
										'value'			=> '',
										'description' 	=> 'Enter phone two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'     => 'attach_image',
										"heading"		=> esc_html__("Email Image","indofact"),
										"param_name"	=> "eml_image",
										"description" 	=> "Upload Image",
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Email Title','indofact'),
										'param_name'	=> 'eml_title',
										'value'			=> '',
										'description' 	=> 'Enter email title text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Email Text','indofact'),
										'param_name'	=> 'eml_text',
										'value'			=> '',
										'description' 	=> 'Enter email text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Email Text Two','indofact'),
										'param_name'	=> 'eml_text_two',
										'value'			=> '',
										'description' 	=> 'Enter email two text here.',
										'dependency' => Array(
															'element' => 'layout', 
															'value' => array(
																			'img_text',
																		)
														)
									),
									array(
										'type'        => 'textfield',
										'heading'     => esc_html__( 'Extra class name', 'indofact' ),
										'param_name'  => 'el_class',
										'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'indofact' )
									)
								)
				) 
			);
	
	
}	
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) 
{
	class WPBakeryShortCode_tmc_Animation_Block extends WPBakeryShortCodesContainer{
	}
	class WPBakeryShortCode_tmc_Gmap extends WPBakeryShortCodesContainer{
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) 
{
	class WPBakeryShortCode_tmc_Contacts_Widget extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Single_Section extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Services extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Heading extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Projects extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_News extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Client extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Multi_Section extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Team extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Brochure_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Maintenance extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Coming_Soon extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Single_Service extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Portfolio extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Single_Portfolio extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Contact_Info extends WPBakeryShortCode {
	}
	
	class WPBakeryShortCode_TMC_Services_Section extends WPBakeryShortCode {
	}
	
	class WPBakeryShortCode_TMC_Business_Consultant extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Contact_Icon extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Blog_Full extends WPBakeryShortCode {
	}
}