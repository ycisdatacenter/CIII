<?php
namespace WPC\Widgets;
/* */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
if(!defined('ABSPATH')) exit; 
/* */
class Clients extends Widget_Base{

	public function get_name(){
		return 'clients';
	}
	public function get_title(){
		return 'Clients';
	}
	public function get_icon(){
		return 'fa fa-users';
	}
	public function get_category(){
		return ['general'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Settings',
		    ]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'prexa' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [],
			]
		);
		$this->add_control(
			'hover_image',
			[
				'label'   => esc_html__( 'Hover Image', 'prexa' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [],
			]
		);
		$this->add_control(
			'custom_class',
			[
				'label'    => 'Cutom Class',
				'type'     => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	// Php Render
	protected function render()
	{
		$settings = $this->get_settings_for_display(); 
		$this->add_inline_editing_attributes('custom_class', 'basic');
		$img = $settings['image'];
		$imgUrl = wp_get_attachment_image_url( $img['id'] );

		$hoverImg = $settings['hover_image'];
		$hoverImgUrl = wp_get_attachment_image_url( $hoverImg['id'] );
	?>
	
	<div class="<?php echo translate($settings['custom_class']); ?>">
        <div class="client_images">
        	<div class="mainImg">
        		 <img src="<?php echo translate($imgUrl); ?>" alt="img" class="main_img">
        	</div>
        	<div class="hoverImg">
        		 <img src="<?php echo translate($hoverImgUrl); ?>" alt="img" class="hover_img">
        	</div>
        </div>
    </div>
	<?php
	}
}

?>