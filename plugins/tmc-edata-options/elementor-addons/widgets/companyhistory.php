<?php

namespace WPC\Widgets;

use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class companyhistory extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'Company History';
    }
    public function get_title()
    {
        return 'Company History';
    }
    public function get_icon()
    {
        return 'far fa-history';
    }
    public function get_general()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Settings'
            ]
        );
        $this->add_control(
            'img1',
            [
                'label' => esc_html__( 'Box 1 Image', 'indofact' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );
        $this->add_control(
            'year1',
            [
                'label'    => esc_html__( 'Box 1 Year', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( '1982', 'indofact' ),
            ]
        );
        $this->add_control(
            'title1',
            [
                'label'    => esc_html__( 'Box 1 Title', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Humble Beginnings', 'indofact' ),
            ]
        );
        $this->add_control(
            'description1',
            [
                'label'    => esc_html__( 'Box 1 Description', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut maximus.', 'indofact' ),
            ]
        );
        $this->add_control(
            'img2',
            [
                'label' => esc_html__( 'Box 2 Image', 'indofact' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );
        $this->add_control(
            'year2',
            [
                'label'    => esc_html__( 'Box 2 Year', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( '1982', 'indofact' ),
            ]
        );
        $this->add_control(
            'title2',
            [
                'label'    => esc_html__( 'Box 2 Title', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'New headquarters', 'indofact' ),
            ]
        );
        $this->add_control(
            'description2',
            [
                'label'    => esc_html__( 'Box 2 Description', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut maximus.', 'indofact' ),
            ]
        );
        $this->add_control(
            'img3',
            [
                'label' => esc_html__( 'Box 3 Image', 'indofact' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );
        $this->add_control(
            'year3',
            [
                'label'    => esc_html__( 'Box 3 Year', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( '1982', 'indofact' ),
            ]
        );
        $this->add_control(
            'title3',
            [
                'label'    => esc_html__( 'Box 3 Title', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Opening 5 new locations', 'indofact' ),
            ]
        );
        $this->add_control(
            'description3',
            [
                'label'    => esc_html__( 'Box 3 Description', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut maximus.', 'indofact' ),
            ]
        );
        $this->add_control(
            'img4',
            [
                'label' => esc_html__( 'Box 4 Image', 'indofact' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );
        $this->add_control(
            'year4',
            [
                'label'    => esc_html__( 'Box 4 Year', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( '1982', 'indofact' ),
            ]
        );
        $this->add_control(
            'title4',
            [
                'label'    => esc_html__( 'Box 4 Title', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'World wide coverage', 'indofact' ),
            ]
        );
        $this->add_control(
            'description4',
            [
                'label'    => esc_html__( 'Box 4 Description', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut maximus.', 'indofact' ),
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('get_title', 'basic');
        $box1imgVal = $settings['img1'];
        $box1imgUrl = wp_get_attachment_image_url( $box1imgVal['id'] );
        $box2imgVal = $settings['img2'];
        $box2imgUrl = wp_get_attachment_image_url( $box2imgVal['id'] );
        $box3imgVal = $settings['img3'];
        $box3imgUrl = wp_get_attachment_image_url( $box3imgVal['id'] );
        $box4imgVal = $settings['img4'];
        $box4imgUrl = wp_get_attachment_image_url( $box4imgVal['id'] );
?>
        <div class="companyhistory-box">
            <div class="row main-body">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="content-body">
                        <div class="img-content">
                            <span class="image"><img src="<?php echo translate($box1imgUrl); ?>" alt="img"></span>
                            <div class="ch-circle">
                                <div class="white-circle">
                                    <div class="white-circle-border">
                                        <div class="yellow-circle"><?php echo esc_html__($settings['year1'],'indofact'); ?></div>
                                    </div>
                                </div>
                                <span class="year-circle"></span>
                            </div>
                        </div>

                        <h5 class="margin-bottom20 text-center"><?php echo esc_html__($settings['title1'],'indofact'); ?></h5>
                        <p class="line-height26 text-center"><?php echo esc_html__($settings['description1'],'indofact'); ?></p>

                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="content-body">
                        <div class="img-content">
                            <span class="image"><img src="<?php echo translate($box2imgUrl); ?>" alt="img"></span>
                            <div class="ch-circle">
                                <div class="white-circle">
                                    <div class="white-circle-border">
                                        <div class="yellow-circle"><?php echo esc_html__($settings['year2'],'indofact'); ?></div>
                                    </div>
                                </div>
                                <span class="year-circle"></span>
                            </div>
                        </div>
                        <h5 class="margin-bottom20 text-center"><?php echo esc_html__($settings['title2'],'indofact'); ?></h5>
                        <p class="line-height26 text-center"><?php echo esc_html__($settings['description2'],'indofact'); ?></p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="content-body">
                        <div class="img-content">
                            <span class="image"><img src="<?php echo translate($box3imgUrl); ?>" alt="img"></span>
                            <div class="ch-circle">
                                <div class="white-circle">
                                    <div class="white-circle-border">
                                        <div class="yellow-circle"><?php echo esc_html__($settings['year3'],'indofact'); ?></div>
                                    </div>
                                </div>
                                <span class="year-circle"></span>
                            </div>
                        </div>
                        <h5 class="margin-bottom20 text-center"><?php echo esc_html__($settings['title3'],'indofact'); ?></h5>
                        <p class="line-height26 text-center"><?php echo esc_html__($settings['description3'],'indofact'); ?></p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="content-body">
                        <div class="img-content">
                            <span class="image"><img src="<?php echo translate($box4imgUrl); ?>" alt="img"></span>
                            <div class="ch-circle">
                                <div class="white-circle">
                                    <div class="white-circle-border">
                                        <div class="yellow-circle"><?php echo esc_html__($settings['year4'],'indofact'); ?></div>
                                    </div>
                                </div>
                                <span class="year-circle"></span>
                            </div>
                        </div>
                        <h5 class="margin-bottom20 text-center"><?php echo esc_html__($settings['title4'],'indofact'); ?></h5>
                        <p class="line-height26 text-center"><?php echo esc_html__($settings['description4'],'indofact'); ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>