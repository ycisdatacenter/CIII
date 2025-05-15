<?php

namespace WPC\Widgets;
use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class Services extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'services';
    }
    public function get_title()
    {
        return 'Services';
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
            'services_style',
            [
                'label'   => esc_html__( 'Style', 'indofact' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'indofact' ),
                    '2' => esc_html__( 'Style 2', 'indofact' ),
                    '3' => esc_html__( 'Style 3', 'indofact' ),
                    '4' => esc_html__( 'Style 4', 'indofact' ),
                    '5' => esc_html__( 'Style 5', 'indofact' ),
                    '6' => esc_html__( 'Style 6', 'indofact' ),
                    '7' => esc_html__( 'Style 7', 'indofact' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'services_sub_title',
            [
                'label'    => esc_html__( 'Sub Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'OUR SERVICES', 'indofact' ),
                'condition' => [ 'services_style' => '7' ],
            ]
        );
        $this->add_control(
            'services_title',
            [
                'label'    => esc_html__( 'Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Our Company Services', 'indofact' ),
                'condition' => [ 'services_style' => '7' ],
            ]
        );
        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'indofact' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'       => esc_html__( 'DESC', 'indofact' ),
                    'ASC'      => esc_html__( 'ASC', 'indofact' ),
                ],
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'indofact' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'       => esc_html__( 'None', 'indofact' ),
                    'title'      => esc_html__( 'Title', 'indofact' ),
                    'rand'       => esc_html__( 'Random', 'indofact' ),
                    'date'       => esc_html__( 'Date', 'indofact' ),
                    'menu_order' => esc_html__( 'Page Order', 'indofact' ),
                ],
            ]
        );
        $this->add_control(
            'number',
            [
                'label'    => 'Number of posts',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => '6',
            ]
        );
        $this->add_control(
            'readmore_text',
            [
                'label'    => 'Read More Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => 'Read More',
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('custom_class', 'basic');
        $args = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'order'          => $settings['order'],
                    'orderby'        => $settings['orderby'],
                    'posts_per_page' => $settings['number']
                );
        $the_service = new \WP_Query($args); ?>

<!-- Script for Style 6 -->
<script type="text/javascript">
    jQuery(document).ready(function(){
        "use strict";
        jQuery(".serviceGrid").slick({
            slidesToShow: 4,
            autoplay: true,
            dots: true,
            arrows: false,
            autoplaySpeed: 3000,
            speed: 2000,
            slidesToScroll: 1,
            draggable: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                slidesToShow: 4
                }
            },
            {
                breakpoint: 981,
                settings: {
                slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                slidesToShow: 1
                }
            }]
        });
    });
</script>
<!-- End Script -->
<?php
        if($settings['services_style'] == '1')
        {
?>
        <section class="pad95-50-top-bottom">
            <div class="container clearfix">
                <!-- <h3 class="text-center">Our Services</h3> -->
                <div class="row sercices-box">
                    <?php
					$count = 0;
                    while ( $the_service->have_posts() ): 
                        $the_service->the_post(); 
                        $count++;
                        $mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
                        $serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
                        
                        $mainHoverIcon  = get_post_meta( get_the_ID(), 'service-hover-icon', true );
                        $serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full'); ?>
                        
                        <div class="col-md-4 col-sm-4 col-xs-12 marbtm50 service-list-column" style="--hover-image: url(<?php echo $serviceHoverIcon[0]; ?>);">    
                                        <a href="<?php echo get_permalink(); ?>">
                                        <span class="image_hover"> 
                                            <?php echo get_the_post_thumbnail(get_the_ID(),array( 457, 485),array('class'=>'img-responsive zoom_img_effect')); ?>
                                        </span>
                                            <div class="service-heading service-manufactureicon" style="--main-image:url(<?php echo $serviceIcon[0]; ?>);">
                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                <span class="read-more-link"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span>
                                            </div>
                                        </a>
                                    </div>
                    <?php
                    endwhile;
                    wp_reset_query();    
                    ?>
                </div>
            </div>
        </section>
<?php
        }
        elseif($settings['services_style'] == '2')
        { 
			$count = 0;
            while ( $the_service->have_posts() ): 
                $the_service->the_post(); 
                $count++;  ?>
                <div class="col-md-4 col-sm-6 col-xs-12 home3-service-column marbtm50 ">
                                <a href="<?php echo get_permalink(); ?>">
                                    <span class="image_hover img">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="img-responsive zoom_img_effect" alt="img">
                                    </span>  
                                </a>
                                <h4><?php echo esc_attr(get_the_title()); ?></h4>
                                <p class="line-height26 marbtm20"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                <span class="read-more-link">
                                    <a href="<?php echo get_permalink(); ?>"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></a>
                                </span>                                          
                </div>
            <?php
            endwhile; 
            wp_reset_query();   
        }
        elseif($settings['services_style'] == '3')
        {	
			$count = 0;
            while ( $the_service->have_posts() ): 
                $the_service->the_post(); 
                $count++;
                $mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
                $serviceIcon = wp_get_attachment_image_src($mainImage, 'full'); ?>
                <div class="col-md-6 col-sm-6 col-xs-12 service-column service4-column">                 
                    <span class="service4-icons icons service-manufactureicon" style="background: url(<?php echo $serviceIcon[0]; ?>)"></span>
                    <div class="service4-desc">
                        <h5><?php echo esc_attr(get_the_title()); ?></h5>
                        <p class="line-height26 marbtm20"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                       <a href="<?php echo get_permalink(); ?>"> <span class="read-more-link"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span></a>
                    </div>                              
                </div>
            <?php
            endwhile;   
            wp_reset_query();   
        }
        elseif($settings['services_style'] == '4')
        { ?>
            <div class="row row_mar_zero">
            <?php
			$count = 0;
            while ( $the_service->have_posts() ): 
                $the_service->the_post(); 
                $count++;
                $mainImage = get_post_meta(get_the_ID(), 'home5-other-image', true );
                $serviceIcon = wp_get_attachment_image_src($mainImage, 'full'); ?>
                <div class="col-md-6 col-sm-6 col-xs-12 home5-service1" style="background: url(<?php echo $serviceIcon[0]; ?>); background-size: cover;">
                                <a href="<?php echo get_permalink(); ?>">
                                    <h4><?php echo esc_attr(get_the_title()); ?></h4>
                                    <p class="fnt-17"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                    <span class="service-home5 read-more-link"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span>
                                </a>
                            </div>
            <?php
            endwhile;  
            wp_reset_query();  
            ?>
            </div>
        <?php
        }
        elseif($settings['services_style'] == '5')
        { 
			$count = 0;
            while ( $the_service->have_posts() ): 
                $the_service->the_post(); 
                $count++;
                $mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
                $serviceIcon = wp_get_attachment_image_src($mainImage, 'full'); ?>
                <div class="col-md-4 col-sm-6 col-xs-12 ">
                    <div class="singleService">
                        <div class="serviceImgArea">
                           <img src="<?php echo $serviceIcon[0]; ?>" alt="img">
                        </div>
                        <div class="serviceContent">
                            <h5><?php echo esc_attr(get_the_title()); ?></h5>
                            <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                        </div>
                    </div>
                </div> 
            <?php
            endwhile;
            wp_reset_query();  
        }
        elseif($settings['services_style'] == '6')
        { ?> 
            <div class="home7Services">
                <div class="row">
                    <div class=" serviceGrid grid-wrapper grid-row "> 
                        <?php
						$count = 0;
                        while ( $the_service->have_posts() ): $the_service->the_post(); $count++;
                            $mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
                            $serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
                            $mainHoverIcon  = get_post_meta( get_the_ID(), 'service-hover-icon', true );
                            $serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full');
                            $active = '';
                            if($count == 1)
                            {
                                $active = 'active';
                            } ?>
                            <div class="grid item no-padding">
                                <div class="hm7singleService">
                                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                    <div class="hm7serviceImgArea">
                                       <img src="<?php echo $serviceHoverIcon[0]; ?>" alt="img">
                                    </div>
                                    <div class="hm7serviceContent">
                                        <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                        <a href="<?php echo get_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_query();  ?>
                    </div>
                </div>
            </div>
        <?php 
        }
        elseif($settings['services_style'] == '7')
        { ?> 
            <section class="hm8ServiceSection">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 videoServiceRight">
                        <div class="home8Title">
                            <h3><?php echo esc_html__($settings['services_sub_title'],'indofact'); ?></h3>
                            <h1><?php echo esc_html__($settings['services_title'],'indofact'); ?></h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="home8Services">
                            <div class="row">
                                <?php
								$count = 0;
                                while ( $the_service->have_posts() ): $the_service->the_post(); $count++;
                                    $mainImage = get_post_meta(get_the_ID(), 'service-icon', true );
                                    $serviceIcon = wp_get_attachment_image_src($mainImage, 'full');
                                    $mainHoverIcon  = get_post_meta( get_the_ID(), 'service-hover-icon', true );
                                    $serviceHoverIcon = wp_get_attachment_image_src($mainHoverIcon, 'full');
                                    $active = '';
                                    if($count == 1)
                                    {
                                        $active = 'active';
                                    } ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="hm8singleService">
                                            <div class="hm8serviceImgArea">
                                               <img src="<?php echo $serviceHoverIcon[0]; ?>" alt="img">
                                            </div>
                                            <div class="hm8serviceContent">
                                                <a href="<?php echo get_permalink(); ?>"><h5><?php echo esc_attr(get_the_title()); ?></h5></a>
                                                <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                wp_reset_query();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php 
        }
    }
}
?>