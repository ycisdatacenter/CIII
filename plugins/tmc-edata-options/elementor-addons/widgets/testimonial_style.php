<?php

namespace WPC\Widgets;

use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class Testimonial_style extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'testimonial_style';
    }
    public function get_title()
    {
        return 'Testimonial Style';
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
            'testimonial_layout',
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
                    '8' => esc_html__( 'Style 8', 'indofact' ),
                    '9' => esc_html__( 'Style 9', 'indofact' ),
                    '10' => esc_html__( 'Style 10', 'indofact' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testimonial_sub_title',
            [
                'label'    => esc_html__( 'Sub Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Testimonials', 'indofact' )
            ]
        );
        $this->add_control(
            'testimonial_title',
            [
                'label'    => esc_html__( 'Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Testimonials', 'indofact' )
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
        $this->add_inline_editing_attributes('get_title', 'basic');
        $args = array(
                    'post_type' => 'testimonial',
                    'post_status' => 'publish',
                    'order'          => $settings['order'],
                    'orderby'        => $settings['orderby'],
                    'posts_per_page' => $settings['number']
                );
        $the_testimonials = new \WP_Query($args); ?>
        
        <?php
        if ( $the_testimonials->have_posts() )
        {
            if($settings['testimonial_layout'] == '1')
            {
        ?>
                <section class="testimonial-section ">
                    <div class="testimonial-rght-head testi_bcolor">
                        <h2><?php echo esc_html__($settings['testimonial_title'],'indofact'); ?></h2>
                    </div>
                    <div class="container">
                        <div class="col-lg-6 col-md-6 testimonial-left-sidebar">
                            <div id="minimal-bootstrap-carousel1" class="home1 carousel slide carousel-horizontal shop-slider full_width testimonial-slider" data-ride="carousel"> 
                                <div class="carousel-inner" role="listbox">
                                    <?php
									$count = 0;
                                    while ( $the_testimonials->have_posts() ): 
                                        $the_testimonials->the_post(); 
                                        $count++;
                                        $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                                        $active = '';
                                        if($count == 1):
                                            $active = 'active';
                                        endif; ?>
                                        <div class="item <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?>" >
                                            <div class="testimonial-head">
                                                <span class="testi-img">
                                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive img-circle')); ?>
                                                </span>
                                                <div class="testi-text">
                                                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                    <span class="testi-designation"><?php echo esc_attr($designation); ?></span>
                                                </div>
                                            </div>
                                            <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                        </div>
                                    <?php 
                                    endwhile;
                                    wp_reset_query(); 
                                    ?>  
                                </div>
                                <a class="left carousel-control" href="#minimal-bootstrap-carousel1" role="button" data-slide="prev"> 
                                    <i class="fa fa-angle-left"></i> 
                                    <span class="sr-only"><?php echo esc_html__('Previous','indofact'); ?></span> 
                                </a> 
                                <a class="right carousel-control" href="#minimal-bootstrap-carousel1" role="button" data-slide="next"> 
                                    <i class="fa fa-angle-right"></i> 
                                    <span class="sr-only"><?php echo esc_html__('Next','indofact'); ?></span> 
                                </a> 
                            </div>
                        </div>
                    </div>
                </section>
            
    <?php
            }
            elseif($settings['testimonial_layout'] == '2')
            { ?>
                <section class="pad95-100-top-bottom home3_testimonial home4_testimonial carousel slide two_shows_one_move" id="var_testimonial" data-ride="carousel">
                    <div class="container">
                        <h3 class=" text-center"><?php echo esc_html__($settings['testimonial_title'],'indofact'); ?></h3>
                        <div class="text-center">
                            <div class="controls">
                                <a class="left fa fa-angle-left next_prve_control" href="#var_testimonial" data-slide="prev"></a>
                                <a class="right fa fa-angle-right next_prve_control" href="#var_testimonial" data-slide="next"></a> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="carousel-inner">
                                <?php
								$count = 0;
                                while ( $the_testimonials->have_posts() ): 
                                    $the_testimonials->the_post(); 
                                    $count++;
                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );               
                                    $active = '';
                                    if($count == 1):
                                        $active = 'active';
                                    endif;
                                    ?>
                                    <div class="item <?php echo esc_attr($active); ?>">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 client-column">
                                                        <span class="home3-client-img">
                                                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive border_img img-circle')); ?>
                                                        </span>
                                                        <div class="home3-client-desc">
                                                            <h4 class="color-yellow"><?php echo esc_attr(get_the_title()); ?></h4>
                                                            <span class="client-designation"><?php echo esc_attr($designation); ?></span>
                                                            <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                                        </div>
                                                    </div>                          
                                               </div>
                                <?php
                                endwhile;
                                wp_reset_query(); ?>
                            </div>                           
                        </div>
                    </div>
                </section>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '3')
            { ?>
                <section class="pad95-100-top-bottom carusel3_testimonial home4_testimonial carousel slide two_shows_one_move" id="var_testimonial" data-ride="carousel">
                    <div class="container">
                        <h3 class=" text-center"><?php echo esc_html__($settings['testimonial_title'],'indofact'); ?></h3>
                        <div class="row">
                            <div class="carousel-inner">
                                <?php
								$count = 0;
                                while ( $the_testimonials->have_posts() ): 
                                    $the_testimonials->the_post(); 
                                    $count++;
                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );               
                                    $active = '';
                                    if($count == 1):
                                        $active = 'active';
                                    endif; ?>
                                    <div class="item <?php echo esc_attr($active); ?>">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 client-column">
                                            <span class="home3-client-img">
                                                <?php echo get_the_post_thumbnail(get_the_ID(), array( 150, 150), array('class'=>'img-responsive border_img img-circle')); ?>
                                            </span>
                                            <div class="carusel3_testimonial_title">
                                                <h4><?php echo esc_attr(get_the_title()); ?></h4>
                                                <span class="carusel3-designation"><?php echo esc_attr($designation); ?></span>
                                                <p class="testquote"><?php echo esc_attr(get_the_excerpt()); ?></p>
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
                </section>';
            <?php 
            }
            elseif($settings['testimonial_layout'] == '4')
            { ?>
                <div class="container testimonialArea home6">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="titleHead">
                                <div class="tophead">
                                    <div class="line"></div>
                                    <p><?php echo esc_html__($settings['testimonial_sub_title'],'indofact'); ?></p>
                                </div>
                                <h1><?php echo esc_html__($settings['testimonial_title'],'indofact'); ?></h1>
                            </div>
                        </div>
                        <div class="col-md-12 testimonialContent">
                            <div class="carousel slide" data-ride="carousel"> 
                                <div class="carousel-inner" role="listbox">
                                    <?php
									$count = 0;
                                    while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
                                        $stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
                                        if($stars == 2)
                                        {
                                        $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                        elseif($stars == 3)
                                        {
                                        $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                        elseif($stars == 4)
                                        {
                                        $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                        elseif($stars == 5)
                                        {
                                        $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                        }
                                        else
                                        {
                                        $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                        $active = '';
                                        if($count == 1):
                                            $active = 'active';
                                        endif; ?>
                                        <div class="item testimonialImgSec <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?>" >
                                            <div class="col-md-4 hm6-testimg">
                                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'testiImg testiImg1')); ?>
                                            </div>
                                            <div class="col-md-8 testimonialText">
                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                    <span class="testi-star"><?php echo $starValue; ?></span>
                                                <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                            </div>  
                                        </div>
                                    <?php
                                    endwhile;   
                                    wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '5')
            { ?>
                 <section class=" home7Testimonial">
                        <div class=" hm7TestimonialSec">
                                <div class="hm7Testimonial" >
                                    <div class="row">
                                        <div class=" carousel slide" data-ride="carousel" id="var1_testimonial"> 
                                            <div class="carousel-inner" role="listbox">
                                                <?php
                                                $count = 0;
                                                while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
                                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                                                    $stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
                                                    if($stars == 2)
                                                    {
                                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    }
                                                    elseif($stars == 3)
                                                    {
                                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    }
                                                    elseif($stars == 4)
                                                    {
                                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    }
                                                    elseif($stars == 5)
                                                    {
                                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                                    }
                                                    else
                                                    {
                                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    }
                                                    $active = '';
                                                    if($count == 1):
                                                        $active = 'active';
                                                    endif;
                                                    ?>
                                                    <div class="item <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?>" >
                                                        <div class="testimonialText">
                                                        <i class="fas fa-quote-left"></i>
                                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive border_img')); ?>
                                                            <div class="hm7TestimonialContent">
                                                                <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                                <p class="desig"><?php echo esc_attr($designation); ?></p>
                                                                <span class="testi-star"><?php echo $starValue; ?></span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                <?php
                                                endwhile;
                                                wp_reset_query();
                                                ?>
                                            </div>
                                        </div>                          
                                        <div class="hm7TestimonialArrow">
                                            <div class="controls">
                                                <a class="left next_prve_control" href="#var1_testimonial" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                                <a class="right next_prve_control" href="#var1_testimonial" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </section>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '6')
            { ?>
                <div class="hm8Testimonial testimonialArea">
                    <div class="row">
                        <div class=" carousel slide" data-ride="carousel" id="var2_testimonial"> 
                            <div class="carousel-inner" role="listbox">
                                <?php
								$count = 0;
                                while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                                     $stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
                                    if($stars == 2)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 3)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 4)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 5)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                    }
                                    else
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    $active = '';
                                    if($count == 1):
                                        $active = 'active';
                                    endif;
                                    ?>
                                    <div class="item <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?> " >
                                        <div class="testimonialText">
                                            <i class="fas fa-quote-left"></i>
                                            <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                        </div>
                                        <div class="hm8TestimonialContent">
                                            <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                            <p class="desig"><?php echo esc_attr($designation); ?></p>
                                            <span class="testi-star"><?php echo $starValue; ?></span>
                                        </div>
                                        
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_query(); ?>
                            </div>
                        </div>                          
                        <div class="hm8TestimonialArrow">
                            <div class="controls">
                                <a class="left next_prve_control" href="#var2_testimonial" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                <a class="right next_prve_control" href="#var2_testimonial" data-slide="next"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '7')
            {
				$count = 0;
                while ( $the_testimonials->have_posts() ): 
                    $the_testimonials->the_post(); 
                    $count++; ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 client-testimonial">
                        <span class="client-img">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive')); ?>
                        </span>
                        <div class="client-desc2">
                            <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                            <span class="client-name"><?php echo '- '.esc_attr(get_the_title()); ?></span>
                        </div>
                    </div>
                <?php
                endwhile;
                 wp_reset_query();
            }
            elseif($settings['testimonial_layout'] == '8')
            { ?>
                <div class="electric_testimonial testimonialArea">
                    <!-- <div class="row"> -->
                        <div class=" carousel slide" data-ride="carousel" id="var_electric_testimonial"> 
                            <div class="carousel-inner" role="listbox">
                                <?php
                                $count = 0;
                                while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                                    $active = '';
                                    if($count == 1):
                                        $active = 'active';
                                    endif;
                                    ?>
                                    <div class="item <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?> " >
                                        <div class="testimonialText">
                                            <i class="fas fa-quote-left"></i>
                                            <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                                        </div>
                                        <div class="electric_testimonial_content">
                                            <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                            <p class="desig"><?php echo esc_attr($designation); ?></p>
                                        </div>
                                        
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_query(); ?>
                            </div>
                        </div>                          
                        <div class="electric_testimonial_arrow">
                            <div class="controls">
                                <a class="left next_prve_control" href="#var_electric_testimonial" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                <a class="right next_prve_control" href="#var_electric_testimonial" data-slide="next"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '9')
            { ?>
               
                <div class="testimonial9 testimonialArea">
                    <!-- <div class="row"> -->
                        <div class="testimonial9_arrow">
                            <div class="controls">
                                <a class="left next_prve_control" href="#var_testimonial9" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                <a class="right next_prve_control" href="#var_testimonial9" data-slide="next"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class=" carousel slide" data-ride="carousel" id="var_testimonial9"> 
                            <div class="carousel-inner" role="listbox">
                                <?php
                                $count = 0;
                                while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();$count++;
                                    $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                                    $address = get_post_meta(get_the_ID(), 'testi_address', true );
                                    $stars = get_post_meta(get_the_ID(), 'testimonial_stars', true );
                                    if($stars == 2)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 3)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 4)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($stars == 5)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                    }
                                    else
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    $active = '';
                                    if($count == 1):
                                        $active = 'active';
                                    endif;
                                    ?>
                                    <div class="item <?php echo esc_attr($active); ?> slide-<?php echo esc_attr($count); ?> " >
                                        <div class="testimonialText">
                                            <i class="<?php echo esc_attr($settings['quote_icon']);?>"></i>
                                        </div>
                                        <div class="testimonial9_quote_text">
                                            <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                        </div>
                                        <div class="testimonial9_content">
                                            <h5><?php echo get_the_title(); ?></h5>
                                            <?php
                                            if(!empty($designation) || !empty($address)){ 
                                            ?>
                                                <p><?php echo esc_attr($designation).', '.esc_attr($address); ?></p>
                                            <?php } ?>
                                            <span class="testi-star"><?php echo $starValue; ?></span>
                                        </div>
                                        
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_query(); ?>
                            </div>
                        </div>                          
                        
                    <!-- </div> -->
                </div>
            <?php 
            }
            elseif($settings['testimonial_layout'] == '10')
            { ?>
                <div class="plumber_testimonial">
                <div class="row">
                    <div class=" plumberGrid owl-carousel"> 
                        <?php
                        while ( $the_testimonials->have_posts() ): $the_testimonials->the_post();
                            $designation = get_post_meta(get_the_ID(), 'testimonial_designation', true );
                            $address = get_post_meta(get_the_ID(), 'testi_address', true );
                            $active = '';
                            ?>
                            <div class="grid item no-padding">
                                <div class="plumber_single_testimonial">
                                    <div class="testimonialText">
                                        <i class="fas fa-quote-left"></i>
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'img-responsive')); ?>
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                    <div class="plumber_testimonial_content">
                                        <p class="excert_text"><?php echo esc_attr(get_the_excerpt()); ?></p>
                                        <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                        <p class="desig"><?php echo esc_attr($designation).', '.esc_attr($address); ?></p>
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
        }
    }
}
?>