<?php

namespace WPC\Widgets;
use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Team_widget extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'team_widget';
    }
    public function get_title()
    {
        return 'Team Widget';
    }
    public function get_icon()
    {
        return 'fas fa-users';
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
            'team_style',
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
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'team_sub_title',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'OUR TEAM', 'indofact' ),
                'condition' => [ 'team_style' => '1' ],
            ]
        );
        $this->add_control(
            'team_sub_title2',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'OUR TEAM', 'indofact' ),
                'condition' => [ 'team_style' => '2' ],
            ]
        );
        $this->add_control(
            'team_title',
            [
                'label'    => 'Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Meet Our Professionals', 'indofact' ),
                'condition' => [ 'team_style' => '1' ],
            ]
        );
        $this->add_control(
            'team_title2',
            [
                'label'    => 'Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Meet Our Professionals', 'indofact' ),
                'condition' => [ 'team_style' => '2' ],
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
        $this->add_inline_editing_attributes('custom_class', 'basic');
        $args = array(
                'post_type' => 'team',
                'post_status' => 'publish',
                'order'          => $settings['order'],
                'orderby'        => $settings['orderby'],
                'posts_per_page' => $settings['number']
            );
        $the_team = new \WP_Query($args);
        if($settings['team_style'] == '1')
        {
        ?>
            <section class="paddingSection teamSection home6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="titleHead">
                                <div class="tophead">
                                    <div class="line"></div>
                                    <p><?php echo esc_html__($settings['team_sub_title'],'indofact'); ?></p>
                                </div>
                                <h1><?php echo esc_html__($settings['team_title'],'indofact'); ?></h1>
                            </div>
                        </div>
                        <div class="ourTeam">
                            <?php
							$count = 0;
                            while ( $the_team->have_posts() ): 
                                $the_team->the_post(); 
                                $count++;
                                $designation = get_post_meta(get_the_ID(), 'team_designation', true );
                                $facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
                                $twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
                                $google = get_post_meta(get_the_ID(), 'tmc_google', true );
                                $linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true ); 
                                ?>
                                <div class="col-md-4 col-sm-6 col-xs-12 ">
                                    <div class="singleTeam">
                                        <div class="teamImage image_hover">
                                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'imgEffect zoom_img_effect ')); ?>
                                        </div>
                                        <div class="teamContent">
                                            <h3><?php echo esc_attr(get_the_title()); ?></h3>
                                            <p><?php echo esc_attr($designation); ?></p>
                                            <div class="teamSocial">
                                                <?php
                                                if($facebook){ ?>
                                                    <a class="fb" href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a>
                                                <?php 
                                                }
                                                if($twitter){ ?>
                                                    <a class="twt" href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a>
                                                <?php 
                                                }
                                                if($google){ ?>
                                                    <a class="lnkin" href="'.esc_attr($google).'"><i class="fa fa-linkedin"></i></a>
                                                <?php
                                                }
                                                if($linkedin){ ?>
                                                    <a class="insta" href="'.esc_attr($linkedin).'"><i class="fa fa-instagram"></i></a>
                                                <?php } ?>
                                            </div>
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
        elseif($settings['team_style'] == '2')
        { ?> 
            <section class=" home7Team paddingSection">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                            <div class="home7Title text-center">
                                <h3><?php echo esc_html__($settings['team_sub_title2'],'indofact'); ?></h3>
                                <h1><?php echo esc_html__($settings['team_title2'],'indofact'); ?></h1>
                            </div>
                        </div>
                        <div class="demo3Team">
                            <?php
							$count = 0;
                            while ( $the_team->have_posts() ): 
                                    $the_team->the_post(); 
                                    $count++;
                                    $designation = get_post_meta(get_the_ID(), 'team_designation', true );
                                    $facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
                                    $twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
                                    $google = get_post_meta(get_the_ID(), 'tmc_google', true );
                                    $linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true );
                                    ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="demo3SingleTeam">
                                            <div class="demo3TeamImage"><a><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'imgEffect')); ?></a>
                                                <div class="demo3TeamTitle">
                                                    <h3><?php echo esc_attr(get_the_title()); ?></h3>
                                                    <p><?php echo esc_attr($designation); ?></p>
                                                </div>
                                            </div>
                                            <div class="demo3TeamBottom">
                                                <div class="teamLine"></div>
                                                <div class="demo3TeamContent">
                                                    <?php
                                                    if($facebook) ?>
                                                        <a class="fb" href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a>
                                                    <?php 
                                                    if($twitter) ?>
                                                        <a class="twt" href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a>
                                                    <?php 
                                                    if($google) ?>
                                                        <a class="lnkin" href="'.esc_attr($google).'"><i class="fa fa-linkedin"></i></a>
                                                    <?php
                                                    if($linkedin) ?>
                                                        <a class="insta" href="'.esc_attr($linkedin).'"><i class="fa fa-instagram"></i></a>
                                                </div>
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
            </section>
        <?php 
        }
        elseif($settings['team_style'] == '3')
        { 
			$count = 0;
            while ( $the_team->have_posts() ): 
                    $the_team->the_post(); 
                    $count++;
                    $designation = get_post_meta(get_the_ID(), 'team_designation', true );
                    $facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
                    $twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
                    $google = get_post_meta(get_the_ID(), 'tmc_google', true );
                    $linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true ); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 team-list text-center ">
                    <div class="dedicated-team-img-holder">
                        <span class="default_hidden">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'zoom_img_effect')); ?>
                        </span>
                        <div class="overlay">
                            <div class="inner-holder">
                                <ul>
                                    <?php
                                    if($facebook) ?>
                                        <li><a href="<?php echo esc_attr($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php
                                    if($twitter) ?>
                                        <li><a href="<?php echo esc_attr($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php
                                    if($google) ?>
                                        <li><a href="<?php echo esc_attr($google); ?>"><i class="fa fa-linkedin"></i></a></li>
                                    <?php
                                    if($linkedin) ?>
                                        <li><a href="<?php echo esc_attr($linkedin); ?>"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                                   </div>
                                </div>
                        </div>
                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                    <p><?php echo esc_attr($designation); ?></p>
                </div>
                <?php
                endwhile;
                wp_reset_query(); 
        }
        elseif($settings['team_style'] == '4')
        { ?> 
            <section class="team_style_4">
                <div class="row">
                    <?php
                    $count = 0;
                    while ( $the_team->have_posts() ): 
                        $the_team->the_post(); 
                        $designation = get_post_meta(get_the_ID(), 'team_designation', true );
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                            <div class="single_team4">
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'team_img')); ?>
                                </a>
                                <div class="team4_content">
                                    <a href="<?php echo get_permalink(); ?>"><h4><?php echo esc_attr(get_the_title()); ?></h4></a>
                                    <p><?php echo esc_attr($designation); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query(); ?>
                </div>
            </section>
        <?php 
        }
        elseif($settings['team_style'] == '5')
        {
        ?>
            <div class="team_style5">
                <?php
                while ( $the_team->have_posts() ): 
                    $the_team->the_post(); 
                    $designation = get_post_meta(get_the_ID(), 'team_designation', true );
                    $facebook = get_post_meta(get_the_ID(), 'tmc_facebook', true );
                    $twitter = get_post_meta(get_the_ID(), 'tmc_twitter', true );
                    $instagram = get_post_meta(get_the_ID(), 'tmc_instagram', true );
                    $linkedin = get_post_meta(get_the_ID(), 'tmc_linkedin', true ); ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 team-list text-center ">
                        <div class="dedicated-team-img-holder">
                            <span class="default_hidden">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'zoom_img_effect')); ?>
                            </span>
                            <div class="overlay">
                                <div class="inner-holder">
                                    <ul>
                                        <?php
                                        if($facebook) ?>
                                            <li><a href="<?php echo esc_attr($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php
                                        if($twitter) ?>
                                            <li><a href="<?php echo esc_attr($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php
                                        if($linkedin) ?>
                                            <li><a href="<?php echo esc_attr($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <?php
                                        if($instagram) ?>
                                            <li><a href="<?php echo esc_attr($instagram); ?>"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team_style5_content">
                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                <p><?php echo esc_attr($designation); ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_query(); ?>
            </div>
        <?php
        }
    }
}
?>