<?php

namespace WPC\Widgets;

use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class Portfolio extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'portfolio';
    }
    public function get_title()
    {
        return 'Portfolio';
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
            'portfolio_style',
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
        $this->add_control(
            'project_title',
            [
                'label'    => 'Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Want to Share our Important Projects Successfully done', 'indofact' ),
                'condition' => [ 'portfolio_style' => '4' ],
            ]
        );
        $this->add_control(
            'project_main_title6',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Our Projects', 'indofact' ),
                'condition' => [ 'portfolio_style' => '4' ],
            ]
        );
        $this->add_control(
            'button_link3',
            [
                'label'    => 'Button Link URL',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => '',
                'condition' => [ 'portfolio_style' => '4' ],
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
        // $this->add_control(
        //     'column',
        //     [
        //         'label'   => esc_html__( 'Select Column', 'indofact' ),
        //         'type'    => Controls_Manager::SELECT,
        //         'default' => '3',
        //         'options' => [
        //             '2'       => esc_html__( '2 Column', 'indofact' ),
        //             '3'      => esc_html__( '3 Column', 'indofact' ),
        //             '4'       => esc_html__( '4 Column', 'indofact' ),
        //         ],
        //     ]
        // );
        $this->add_control(
            'readmore',
            [
                'label'    => 'Read more text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => 'View Project',
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
                    'post_type' => 'portfolio',
                    'post_status' => 'publish',
                    'order'          => $settings['order'],
                    'orderby'        => $settings['orderby'],
                    'posts_per_page' => $settings['number']
                );
        $the_portfolio = new \WP_Query($args);

        if ( $the_portfolio->have_posts() )
        {
            if($settings['portfolio_style'] == '1')
            { ?>
                 <div class="filter-section">
                    <div class="col-sm-12 col-xs-12">
                        <div class="filter-container isotopeFilters">
                            <ul class="list-inline filter">
                                <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All Projects ','indofact'); ?> </a></li>
                                <?php
								$count = 0;
                                $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                                $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                                foreach( $parent_cat as $child_term ) 
                                {
                                    $count++; ?>                          
                                    <li class="cat-item cat-item-<?php echo esc_attr($count); ?>"> <a href="#" data-filter=".<?php echo esc_attr($child_term->slug); ?>"><?php echo esc_attr($child_term->slug); ?></a> </li>
                                <?php 
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="container">
                        <div class="portfolio-section port-col project_classic portfolio-3">
                            <div class="isotopeContainer">
                                <?php 
								$count = 0;
                                while ( $the_portfolio->have_posts() ): 
                                    $the_portfolio->the_post(); 
                                    $count++;
                                    $terms = get_the_terms (get_the_ID(), 'portfolio-category');     
                                    $arrCat = wp_list_pluck($terms, 'slug');

                                    if (is_array($arrCat)) 
                                    {           
                                        foreach ($arrCat as $catname)   
                                        {
                                            $catname = str_replace(" ","_",$arrCat);
                                        }
                                    }
                                    $catlist = implode(" ", $catname); ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12 img mbot30 isotopeSelector <?php echo esc_attr($catlist); ?>">
                                        <div class="grid">
                                            <div class="image-zoom-on-hover">
                                                <div class="gal-item">
                                                    <a class="black-hover" href="<?php echo get_the_permalink(); ?>">
                                                       <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-360x278-croped', array('class'=>'img-full img-responsive')); ?>
                                                       <div class="tour-layer delay-1"></div>
                                                       <div class="vertical-align">
                                                             <div class="border">
                                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                             </div>
                                                             <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_attr($settings['readmore']); ?></span></div>
                                                      </div>
                                                    </a>
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
            elseif($settings['portfolio_style'] == '2')
            { ?>
                <div class="filter-section">
                    <div class="col-sm-12 col-xs-12">
                        <div class="filter-container isotopeFilters">
                            <ul class="list-inline filter">
                                <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All Projects ','indofact'); ?> </a></li>
                                <?php
									$count = 0;
                                    $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                                    $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                                    foreach( $parent_cat as $child_term ) 
                                    {
                                        $count++;   ?>                      
                                        <li class="cat-item cat-item-<?php echo esc_attr($count); ?>"> <a href="#" data-filter=".<?php echo esc_attr($child_term->slug); ?>"><?php echo esc_attr($child_term->slug); ?></a> </li>
                                    <?php 
                                    } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="container">
                        <div class="portfolio-section port-col project_classic portfolio-4">
                            <div class="isotopeContainer">
							<?php 
							$count = 0;
                            while ( $the_portfolio->have_posts() ): 
                                $the_portfolio->the_post(); 
                                $count++;
                                $terms = get_the_terms (get_the_ID(), 'portfolio-category');     
                                $arrCat = wp_list_pluck($terms, 'slug');
                                if (is_array($arrCat)) 
                                {           
                                    foreach ($arrCat as $catname)   
                                    {
                                        $catname = str_replace(" ","_",$arrCat);
                                    }
                                }
                                $catlist = implode(" ", $catname); ?>
                                <div class="col-md-3 col-sm-6 col-xs-12 img mbot30 isotopeSelector <?php echo esc_attr($catlist); ?>">
                                    <div class="grid">
                                        <div class="image-zoom-on-hover">
                                            <div class="gal-item">
                                                <a class="black-hover" href="<?php echo get_the_permalink(); ?>">
                                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-263x203-croped', array('class'=>'img-full img-responsive')); ?>
                                                    <div class="tour-layer delay-1"></div>
                                                    <div class="vertical-align">
                                                        <div class="border">
                                                            <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                        </div>
                                                        <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_attr($settings['readmore']); ?></span></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <div class="marbtm30"></div>
                                     <h4><?php echo esc_attr(get_the_title()); ?></h4>
                                     <p><?php echo esc_attr(get_the_excerpt()); ?></p>
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
            elseif($settings['portfolio_style'] == '3')
            { ?>
                <div class="filter-section">
                    <div class="col-sm-12 col-xs-12">
                        <div class="filter-container isotopeFilters">
                            <ul class="list-inline filter">
                                <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All Projects ','indofact'); ?> </a></li>
                                <?php
									$count = 0;
                                    $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                                    $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                                    foreach( $parent_cat as $child_term ) 
                                    {
                                        $count++; ?>                            
                                        <li class="cat-item cat-item-<?php echo esc_attr($count); ?>"> <a href="#" data-filter=".<?php echo esc_attr($child_term->slug); ?> "><?php echo esc_attr($child_term->slug); ?></a> </li>
                                    <?php 
                                    } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="portfolio-section port-col project_classic portfolio-5">
                        <div class="isotopeContainer">
                            <?php
							$count = 0;
                            while ( $the_portfolio->have_posts() ): 
                                $the_portfolio->the_post(); 
                                $count++;
                                $terms = get_the_terms (get_the_ID(), 'portfolio-category');     
                                $arrCat = wp_list_pluck($terms, 'slug');
                                if (is_array($arrCat)) 
                                {           
                                    foreach ($arrCat as $catname)   
                                    {
                                        $catname = str_replace(" ","_",$arrCat);
                                    }
                                }
                                $catlist = implode(" ", $catname); ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 projt-column col-xs-12 img mbot30 isotopeSelector <?php echo esc_attr($catlist); ?>">
                                   <div class="grid">
                                           <div class="image-zoom-on-hover">
                                                        <div class="gal-item">
                                                            <a class="black-hover" href="<?php echo get_the_permalink(); ?>">
                                                               <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-240x185-croped', array('class'=>'img-full img-responsive')); ?>
                                                               <div class="tour-layer delay-1"></div>
                                                               <div class="vertical-align">
                                                                     <div class="border">
                                                                        <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                                     </div>
                                                                     <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_attr($settings['readmore']); ?></span></div>
                                                              </div>
                                                        </a>
                                                    </div>
                                                </div>
                                           </div>
                                     <div class="marbtm30"></div>
                                     <h4><?php echo esc_attr(get_the_title()); ?></h4>
                                     <p><?php echo esc_attr(get_the_excerpt()); ?></p>
                               </div>
                           <?php
                            endwhile;
                            wp_reset_query(); ?>
                        </div>
                    </div>
                </section>
            <?php 
            }
            elseif($settings['portfolio_style'] == '4')
            { ?>
                <section class="hm8paddingSection hm8ProjectSection">
                    <div class="container">
                        <div class="row">
                           <div class="col-md-7 col-sm-6 col-xs-12 hm8ProjectHeadLeft">
                              <div class="home8Title">
                                 <h3><?php echo esc_html__($settings['project_main_title6'],'indofact'); ?></h3>
                                 <h1><?php echo esc_html__($settings['project_title'],'indofact'); ?></h1>
                              </div>
                           </div>
                           <div class="col-md-5 col-sm-6 col-xs-12 hm8ProjectHeadRight">
                              <a href="<?php echo esc_attr($settings['button_link3']); ?>" class="home8Button header-requestbtn contactus-btn hvr-bounce-to-right"> <?php echo esc_html__('View All','indofact'); ?></a>
                           </div>
                        </div>
                    </div>
                    <div class="container">
                         <div class="filter-section">
                            <div class="col-sm-12 col-xs-12">
                                <div class="filter-container isotopeFilters">
                                    <ul class="list-inline filter">
                                        <li class="active"><a href="#" data-filter="*"><?php echo esc_html__('All Projects ','indofact'); ?> </a></li>
                                        <?php
                                        $count = 0;
                                        $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                                        $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                                        foreach( $parent_cat as $child_term ) 
                                        {
                                            $count++; ?>                          
                                            <li class="cat-item cat-item-<?php echo esc_attr($count); ?>"> <a href="#" data-filter=".<?php echo esc_attr($child_term->slug); ?>"><?php echo esc_attr($child_term->slug); ?></a> </li>
                                        <?php 
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section>
                        <div class="container">
                            <div class="portfolio-section port-col project_classic portfolio-3">
                                <div class="isotopeContainer">
                                    <?php 
                                    $count = 0;
                                    while ( $the_portfolio->have_posts() ): 
                                        $the_portfolio->the_post(); 
                                        $count++;
                                        $terms = get_the_terms (get_the_ID(), 'portfolio-category');     
                                        $arrCat = wp_list_pluck($terms, 'slug');

                                        if (is_array($arrCat)) 
                                        {           
                                            foreach ($arrCat as $catname)   
                                            {
                                                $catname = str_replace(" ","_",$arrCat);
                                            }
                                        }
                                        $catlist = implode(" ", $catname); ?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 img mbot30 isotopeSelector <?php echo esc_attr($catlist); ?>">
                                            <div class="grid">
                                                <div class="image-zoom-on-hover">
                                                    <div class="gal-item">
                                                        <a class="black-hover" href="<?php echo get_the_permalink(); ?>">
                                                           <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-360x278-croped', array('class'=>'img-full img-responsive')); ?>
                                                           <div class="tour-layer delay-1"></div>
                                                           <div class="vertical-align">
                                                                 <div class="border">
                                                                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                                 </div>
                                                                 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_attr($settings['readmore']); ?></span></div>
                                                          </div>
                                                        </a>
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
                </section> 
            <?php
            }
        }
    }
}
?>
