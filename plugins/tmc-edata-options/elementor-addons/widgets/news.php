<?php

namespace WPC\Widgets;

use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class News extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'news';
    }
    public function get_title()
    {
        return 'News';
    }
    public function get_icon()
    {
        return 'far fa-newspaper';
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
            'news_style',
            [
                'label'   => esc_html__( 'Style', 'indofact' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'indofact' ),
                    '2' => esc_html__( 'Style 2', 'indofact' ),
                    '3' => esc_html__( 'Style 3', 'indofact' ),
                    '4' => esc_html__( 'Style 4', 'indofact' ),
                ],
                'separator' => 'before',
            ]
        );
        // $this->add_control(
        //     'project_title',
        //     [
        //         'label'    => 'Title Text',
        //         'type'     => \Elementor\Controls_Manager::TEXT,
        //         'default'  => 'Our Projects',
        //     ]
        // );
        $this->add_control(
            'news_sub_title',
            [
                'label'    => esc_html__( 'Sub Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'LATEST NEWS', 'indofact' ),
                'condition' => [ 'news_style' => '4' ],
            ]
        );
        $this->add_control(
            'news_title',
            [
                'label'    => esc_html__( 'Title Text', 'indofact' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Check Our Inside Story', 'indofact' ),
                'condition' => [ 'news_style' => '4' ],
            ]
        );
        $this->add_control(
            'news_paragraph_text',
            [
                'label'    => 'Sub Title Paragraph Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Etiam porta sem malesuada magna mollis euismod. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas faucibus mollis interdum.', 'indofact' ),
                'condition' => [ 'news_style' => '4' ],
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

    // PHP RENDER
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('get_title', 'basic');

        $args = array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'order'          => $settings['order'],
                    'orderby'        => $settings['orderby'],
                    'posts_per_page' => $settings['number']
                );
        $the_news = new \WP_Query($args);
        if($settings['news_style'] == '1')
        {

            if ( $the_news->have_posts() )
            { ?>
                 <div class="row">
                    <?php
					$count = 0;
                    while ( $the_news->have_posts() ): 
                       $the_news->the_post(); 
                       $count++;
                        ?>
                       <div class="col-xs-12 col-sm-6 col-md-4 news-column ">
                          <a href="<?php echo get_the_permalink(); ?>" class="enitre_mouse">
                             <div class="shadow_effect effect-apollo"> 
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')); ?>
                             </div>
                          </a>
                          <div class="yellow-strip">
                             <div class="news-time">
                                <h5><?php echo esc_attr(get_the_date("d")); ?></h5>
                                <span><?php echo esc_attr(get_the_date("M")); ?></span>
                             </div>
                             <ul>
                                <li><?php echo esc_html__( 'By:', 'indofact' ).' '.esc_html( get_the_author() ); ?></li>
                                <li><?php echo esc_html__( 'Comment:', 'indofact' ).' '.get_comments_number( get_the_ID() ); ?></li>
                             </ul>
                          </div>
                          <h6><a href="<?php echo get_the_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h6>
                          <p class="line-height26"> <?php echo esc_attr(get_the_excerpt()); ?></p>
                       </div>
                       <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                 </div>
           <?php
           }else{
              echo esc_html__('Sorry, there is no news under your selected page.', 'indofact');
           } 
        }
        elseif($settings['news_style'] == '2')
        { 
            if ( $the_news->have_posts() ) 
            { ?>
                <div class="row">
                    <?php
					$count = 0;
                    while ( $the_news->have_posts() ): 
                        $the_news->the_post(); 
                        $count++;
                        $author= get_the_author(); ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 news-column ">
                            <a href="<?php echo get_the_permalink(); ?>" class="enitre_mouse">
                                <div class="shadow_effect effect-apollo"> 
                                 <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')); ?>
                                </div>
                            </a>    
                            <div class="yellow-strip-lay2">
                                <div class="datedisplay">
                                    <h5><?php echo esc_attr(get_the_date("d")); ?></h5>
                                    <span><?php echo esc_attr(get_the_date("M")); ?></span>
                                </div>
                            </div>
                            <div class="news-lower-lay2">
                                <h6><a href="<?php echo get_the_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h6>
                                <p class="line-height26"><?php echo esc_attr(get_the_excerpt()); ?></p>
                                <ul>
                                   <li><?php echo esc_html__( 'By:', 'indofact' ).' '.esc_html( get_the_author() ); ?></li>
                                   <li><?php echo esc_html__( 'Comment:', 'indofact' ).' '.get_comments_number( get_the_ID() ); ?></li>
                                </ul>
                            </div>
                       </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
                <?php
            }else{
                echo esc_html__('Sorry, there is no news under your selected page.', 'indofact');
            }
        }
        elseif($settings['news_style'] == '3')
        { 
            if ( $the_news->have_posts() )
            { ?>
                <div class="newsArea">
                    <div class="row">
                        <?php
						$count = 0;
                        while ( $the_news->have_posts() ): $the_news->the_post();$count++;
                        if($count == 1)
                        { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 detailNews">
                                <div class="newsImg">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'nwsImg')); ?>
                                </div>
                                <div class="row newsData">
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <div class="newsDate">
                                            <h5><?php echo esc_attr(get_the_date("d")); ?></h5>
                                            <span><?php echo esc_attr(get_the_date("M")); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="newsContent">
                                            <div class="newsAuth">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-user"></i><?php echo esc_html__( 'By:', 'indofact' ).' '.esc_html( get_the_author() ); ?></a></li>
                                                    <li><a href="#"><i class="fa fa-comment"></i><?php echo esc_html__( 'Comment:', 'indofact' ).' '.get_comments_number( get_the_ID() ); ?></a></li>
                                                </ul>
                                            </div>
                                            <p class="newsTitle"><a href="<?php echo get_the_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        endwhile;
                        wp_reset_query(); ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
							$count = 0;
                            while ( $the_news->have_posts() ): $the_news->the_post();$count++;
                            ?>
                                <div class="row newsData">
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <div class="newsDate">
                                            <h5><?php echo esc_attr(get_the_date("d")); ?></h5>
                                            <span><?php echo esc_attr(get_the_date("M")); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="newsContent">
                                            <div class="newsAuth">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-user"></i><?php echo esc_html__( 'By:', 'indofact' ).' '.esc_html( get_the_author() ); ?></a></li>
                                                    <li><a href="#"><i class="fa fa-comment"></i><?php echo esc_html__( 'Comment:', 'indofact' ).' '.get_comments_number( get_the_ID() ); ?></a></li>
                                                </ul>
                                            </div>
                                            <p class="newsTitle"><a href="<?php echo get_the_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_query(); ?>
                        </div>
                    </div>
                </div>
            <?php
            }else{
                $output .= esc_html__('Sorry, there is no news under your selected page.', 'indofact');
            }
                    
        }
        elseif($settings['news_style'] == '4')
        {
            if ( $the_news->have_posts() ) 
            { ?>
                <section class=" paddingSection home7News">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                                <div class="home7Title text-center">
                                    <h3><?php echo esc_html__($settings['news_sub_title'],'indofact'); ?></h3>
                                    <h1><?php echo esc_html__($settings['news_title'],'indofact'); ?></h1>
                                    <p><?php echo esc_html__($settings['news_paragraph_text'],'indofact'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="home7News">
                            <div class="row">
                                <?php
								$count = 0;
                                while ( $the_news->have_posts() ): $the_news->the_post(); $count++;
                                    $shortdesc = limit_words(get_the_excerpt(), '16'); ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="home7SingleNews">
                                            <div class="shadow_effect effect-apollo"> 
                                                <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-370x253-croped', array('class'=>'img-responsive')); ?>
                                            </div>
                                            <div class="home7_news_content">
                                                <div class="dateArea">
                                                     <p class="date"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date("d")); ?> <?php echo esc_attr(get_the_date("M")); ?>, <?php echo esc_attr(get_the_date("Y")); ?></p>
                                                     <p class="auth"><i class="fa fa-user"></i><?php echo esc_html__( 'By:', 'indofact' ).' '.esc_html( get_the_author() ); ?></p>
                                                 </div>
                                                 <h6><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a></h6>
                                                 <p><?php echo esc_attr($shortdesc); ?></p>
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
            }else{
                echo esc_html__('Sorry, there is no news under your selected page.', 'indofact');
            }
        }
    }
}
?>