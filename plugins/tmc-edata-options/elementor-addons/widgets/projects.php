<?php
namespace WPC\Widgets;
use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class Projects extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'projects';
    }
    public function get_title()
    {
        return 'Projects';
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
            'project_style',
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
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'project_main_title',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Indofact Featured Projects', 'indofact' ),
                'condition' => [ 'project_style' => '4' ],
            ]
        );
        $this->add_control(
            'project_main_title6',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Want to Share our Important Projects Successfully done', 'indofact' ),
                'condition' => [ 'project_style' => '6' ],
            ]
        );
        $this->add_control(
            'project_title',
            [
                'label'    => 'Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Our Projects', 'indofact' ),
            ]
        );
        $this->add_control(
            'project_paragraph_text',
            [
                'label'    => 'Sub Title Paragraph Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consec tetur adipiscing elit. Etiam fermentum nulla. Lorem ipsum dolor sit amet.', 'indofact' ),
                'condition' => [ 'project_style' => '4' ],
            ]
        );
        $this->add_control(
            'button_link3',
            [
                'label'    => 'Button Link URL',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => '',
                'condition' => [ 'project_style' => '6' ],
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
                'default'  => 'View Project',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'    => 'Button Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => 'View All Projects',
                'condition' => [ 'project_style' => '3' ],
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label'    => 'Button Link URL',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => '',
                'condition' => [ 'project_style' => '3' ],
            ]
        );
        $this->add_control(
            'button_text4',
            [
                'label'    => 'Button Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => 'View All Projects',
                'condition' => [ 'project_style' => '4' ],
            ]
        );
        $this->add_control(
            'button_link4',
            [
                'label'    => 'Button Link URL',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => '',
                'condition' => [ 'project_style' => '4' ],
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
        $aargs = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'order'          => $settings['order'],
            'orderby'        => $settings['orderby'],
            'posts_per_page' => $settings['number']
        );  
        $the_projects = new \WP_Query($aargs);
        
        if($settings['project_style'] == '1')
        {
?>
            <section class="recent-project-section projectsec1">
                    <div class="container"><h3 class="golden margbt44"><?php echo esc_html__($settings['project_title'],'indofact'); ?></h3></div>
                    <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab"><?php echo esc_html__('All','indofact') ?></a></li>
                                    <?php 
                                        $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                                        $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                                        $arrNew = array();
                                        foreach($parent_cat as $arrNew)
                                        {
                                            $cat = str_replace(" ","_",$arrNew->slug); ?>
                                            <li role="presentation"><a href="#<?php echo esc_attr($arrNew->slug); ?>" aria-controls="<?php echo esc_attr($arrNew->slug); ?>" role="tab" data-toggle="tab"><?php echo esc_attr($arrNew->name); ?></a></li>
                                        <?php
                                        } ?>
                    </ul>
                <div class="tab-content <?php echo esc_attr($el_class); ?>">

                    <div role="tabpanel" class="tab-pane active" id="all">
                        <div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project" data-ride="carousel">
                            <div class="controls"> <a class="left fa fa-angle-left next_prve_control" href="#our_project" data-slide="prev"></a><a class="right fa fa-angle-right next_prve_control" href="#our_project" data-slide="next"></a> </div>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php
                                $args = array(
                                        'post_type' => 'portfolio',
                                        'post_status' => 'publish',
                                        'order'          => $settings['order'],
                                        'orderby'        => $settings['orderby'],
                                        'posts_per_page' => $settings['number'],
                                    );  
                                $the_pro = new \WP_Query($args);
                                $act1 = 0;              
                                while($the_pro->have_posts()): 
                                    $the_pro->the_post(); 
                                    if($act1==0){
                                        $active2 = ' active';
                                    }
                                    else{
                                        $active2 = '';
                                    } 
                                    $arrNew->ID ?>
                                    <div class="item <?php echo $active2; ?>">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 img pad_zero ">
                                            <div class="image-zoom-on-hover">
                                                <div class="gal-item">
                                                    <a class="black-hover" href="<?php echo get_permalink(); ?>">
                                                       <?php echo get_the_post_thumbnail(get_the_ID(),array( 457, 485)); ?>
                                                       <div class="tour-layer delay-1"></div>
                                                       <div class="vertical-align">
                                                             <div class="border">
                                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                             </div>
                                                             <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span></div>
                                                       </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 <?php $act1++; 
                                endwhile; 
                                wp_reset_query(); ?>
                            </div>    
                        </div>
                    </div>

                <?php
                $a=1;
                foreach($parent_cat as $arrNew)
                { ?>
                    <div role="tabpanel" class="tab-pane " id="<?php echo $arrNew->slug; ?>">
                        <div class="full_wrapper carousel slide four_shows_one_move home1-project" id="our_project<?php echo $a; ?>" data-ride="carousel">
                            <div class="controls"> <a class="left fa fa-angle-left next_prve_control" href="#our_project<?php echo $a; ?>" data-slide="prev"></a><a class="right fa fa-angle-right next_prve_control" href="#our_project<?php echo $a; ?>" data-slide="next"></a> </div>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php
                                $argspor = array(
                      
                                    'post_type' => 'portfolio',
                                    'post_status' => 'publish',
                                    'order'          => $settings['order'],
                                    'orderby'        => $settings['orderby'],   
                                    'posts_per_page' => $settings['number'],
                                    'tax_query' => array(
                                                            array(
                                                                'taxonomy' => 'portfolio-category',
                                                                'field' => 'term_id',
                                                                'terms' => $arrNew->term_id,
                                                                )
                                                        )
                                    );  
                                $the_pro = new \WP_Query($argspor);
                                  $act = 0;
                                while($the_pro->have_posts()): 
                                    $the_pro->the_post(); 
                                if($act==0)
                                $active1 = ' active';
                                else
                                $active1 = ''; ?>
                                    <div class="item <?php echo $active1; ?>">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 img pad_zero ">
                                            <div class="image-zoom-on-hover">
                                                <div class="gal-item">
                                                    <a class="black-hover" href="<?php echo get_permalink(); ?>">
                                                        <?php echo get_the_post_thumbnail(get_the_ID(),array( 457, 485)); ?>
                                                       <div class="tour-layer delay-1"></div>
                                                       <div class="vertical-align">
                                                             <div class="border">
                                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                             </div>
                                                             <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span></div>
                                                       </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $act++;
                                endwhile;
                                wp_reset_query();
                                 $the_pro =''; ?>
                            </div>    
                        </div>
                    </div>
                    <?php 
                    $a++;
                } ?>
            </div>
            </section>
<?php
        }
        elseif ($settings['project_style'] == '2') 
        { ?>
            <div class="project_style_two">
                <div class="container">
                    <h3 class="white-color"><?php echo esc_html__($settings['project_title'],'indofact'); ?></h3>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab"><?php echo esc_html__('All','indofact'); ?></a></li>
                        <?php
                        $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                        $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                        $arrNew = array();
                        foreach( $parent_cat as $arrNew ) 
                        { ?>                    
                            <li role="presentation"><a href="#<?php echo esc_attr($arrNew->slug); ?>" aria-controls="<?php echo esc_attr($arrNew->slug); ?>" role="tab" data-toggle="tab"><?php echo esc_attr($arrNew->name); ?></a></li>
                        <?php
                        } ?>
                    </ul>
                </div>
                <?php
                $args = array(
                            'post_type' => 'portfolio',
                            'post_status' => 'publish',
                            'order'          => $settings['order'],
                            'orderby'        => $settings['orderby'],
                            'posts_per_page' => $settings['number']
                        );  
                            $the_projects = new \WP_Query($args); ?>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="all">                              
                        <div class="full_wrapper carousel slide three_shows_one_move home2-project" id="our_project" data-ride="carousel">                          
                            <div class="controls">
                                <a class="left fa fa-angle-left next_prve_control" href="#our_project" data-slide="prev"></a>
                                <a class="right fa fa-angle-right next_prve_control" href="#our_project" data-slide="next"></a> 
                            </div>
                            <div class="carousel-inner">
                                <?php
                                $count=0;
                                while($the_projects->have_posts()): 
                                    $the_projects->the_post(); 
                                    $active = '';
                                    if($count == 0)
                                    {
                                        $active = 'active';
                                    } ?>
                                    <div class="item <?php echo $active; ?>">
                                        <div class="col-md-4 col-sm-6 col-xs-12 img pad_zero">
                                            <div class="grid">
                                                <div class="image-zoom-on-hover">
                                                    <div class="gal-item">
                                                        <a class="black-hover" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(),array( 457, 485)); ?>
                                                           <div class="tour-layer delay-1"></div>
                                                           <div class="vertical-align">
                                                                 <div class="border">
                                                                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                                 </div>
                                                                 <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span></div>
                                                           </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                endwhile;
                                wp_reset_query();
                                ?>
                            </div>
                        </div>
                    </div>      
                    <?php
                    $prolist = 1;
                    foreach ($parent_cat as $arrNew) 
                    {   ?>
                        <div role="tabpanel" class="tab-pane " id="<?php echo $arrNew->slug; ?>">                              
                            <div class="full_wrapper carousel slide three_shows_one_move home2-project" id="our_project<?php echo esc_attr($prolist); ?>" data-ride="carousel">                         
                                <div class="controls">
                                    <a class="left fa fa-angle-left next_prve_control" href="#our_project<?php echo esc_attr($prolist); ?>" data-slide="prev"></a>
                                    <a class="right fa fa-angle-right next_prve_control" href="#our_project<?php echo esc_attr($prolist); ?>" data-slide="next"></a> 
                                </div>
                                <div class="carousel-inner">
                                    <?php
                                    $argspor = array(
                                        'post_type' => 'portfolio',
                                        'post_status' => 'publish',
                                        'order'          => $settings['order'],
                                        'orderby'        => $settings['orderby'],   
                                        'posts_per_page' => $settings['number'],
                                        'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'portfolio-category',
                                                                    'field' => 'term_id',
                                                                    'terms' => $arrNew->term_id,
                                                                    )
                                                            )
                                        );  
                                        $the_projects = new \WP_Query($argspor);                
                                        $act = 0;                           
                                    while($the_projects->have_posts()): 
                                        $the_projects->the_post(); 
                                        if($act==0)
                                            $active1 = ' active';
                                        else
                                            $active1 = '';
                                        ?>
                                        <div class="item <?php echo $active1; ?>">
                                            <div class="col-md-4 col-sm-6 col-xs-12 img pad_zero effect-goliath homeprj1-slide">
                                                    <div class=" shadow_effect black_overlay"><?php echo get_the_post_thumbnail(get_the_ID(),array( 457, 485)); ?>
                                                            <div class="project_txt_btn"><a href="<?php echo get_permalink(); ?>" class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></a><h6><?php echo esc_attr(get_the_title()); ?></h6></div>
                                                    </div>
                                            </div>
                                        </div>
                                        <?php                       
                                        $act++;
                                    endwhile;
                                    wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $prolist++;
                    } ?>
                </div>
            </div>
        <?php
        }
        elseif ($settings['project_style'] == '3')
        { ?>
            <div class="col-lg-12 wdt-100 project_style3">
                <h3 class="white-color"><?php echo esc_html__($settings['project_title'],'indofact'); ?></h3>
                <a class="view-project-link" href="<?php echo $settings['button_link']; ?>"><?php echo esc_html__($settings['button_text'],'indofact'); ?></a></div>
                <?php
				$count = 0;
                while($the_projects->have_posts()): 
                    $the_projects->the_post(); 
                    $count++; ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 img homeprj3-slide">
                        <div class="grid">
                              <div class="image-zoom-on-hover">
                                <div class="gal-item">
                                    <a class="black-hover" href="<?php echo get_permalink(); ?>">
                                        <img class="img-full img-responsive" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'tmc-image-370x253-croped').'" alt="'.get_the_title(); ?>">
                                        <div class="tour-layer delay-1"></div>
                                        <div class="vertical-align">
                                             <div class="border">
                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                             </div>
                                             <div class="view-all hvr-bounce-to-right slide_learn_btn view_project_btn"><span><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></span></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
            endwhile;
            wp_reset_query(); 
        }
        elseif ($settings['project_style'] == '4')
        { ?>
            <div class="featuredProject">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 titleSec">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12 titleSecRight">
                                <div class="title1 titleLine">
                                    <div class="lineDiv"></div>
                                    <p><?php echo esc_html__($settings['project_main_title'],'indofact'); ?></p>
                                </div>
                                <div class="title2">
                                    <h1><?php echo esc_html__($settings['project_title'],'indofact'); ?></h1>
                                </div>
                                <div class="titleContent">
                                    <p><?php echo esc_html__($settings['project_paragraph_text'],'indofact'); ?></p>
                                </div>
                                <div class="titleButton">
                                    <a href="<?php echo esc_html__($settings['button_link4'],'indofact'); ?>"><?php echo esc_html__($settings['button_text4'],'indofact'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
					$total = 0;
                    while($the_projects->have_posts()): $the_projects->the_post(); $total++;
                    if($total == 1)
                    { ?>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="projectImage1">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-457x485-croped',  array('class'=>'proImg')); ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 projectTopRight">
                            <div class="title2 projectName">
                                <h1><?php echo esc_attr(get_the_title()); ?></h1>
                            </div>
                            <div class="titleButton projectButton">
                                <a href="<?php echo get_permalink(); ?>"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></a>
                            </div>
                        </div>
                    <?php
                    }
                    endwhile;
                    wp_reset_query(); 
                    ?>
                </div>
                <div class="row">
                    <?php
					$total1 = 0;
                    while($the_projects->have_posts()): $the_projects->the_post(); $total1++;
                    if($total1 == 2)
                    { ?>
                        <div class="col-md-3 col-sm-3 col-xs-12 projectNameLeft">
                            <div class="title2 projectName">
                                <h1><?php echo esc_attr(get_the_title()); ?></h1>
                            </div>
                            <div class="titleButton projectButton">
                                <a href="<?php echo get_permalink(); ?>"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="projectImage2">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'tmc-image-457x485-croped',  array('class'=>'proImg')); ?>
                            </div>
                        </div>
                    <?php
                    }
                    endwhile;
                    wp_reset_query();

					$total2	=0;
                    while($the_projects->have_posts()): $the_projects->the_post(); $total2++;
                    if($total2 == 3)
                    { ?>
                        <div class="col-md-3 col-sm-3 col-xs-12 projectNameRight">
                            <div class="title2 projectName">
                                <h1><?php echo esc_attr(get_the_title()); ?></h1>
                            </div>
                            <div class="titleButton projectButton">
                                <a href="<?php echo get_permalink(); ?>"><?php echo esc_html__($settings['readmore_text'],'indofact'); ?></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="projectImage3">
                            <?php echo get_the_post_thumbnail(get_the_ID(),  'tmc-image-457x485-croped',  array('class'=>'proImg')); ?>
                            </div>
                        </div>
                    <?php
                    }
                    endwhile;
                    wp_reset_query(); ?>
                </div>
            </div>
        <?php 
        }
        elseif ($settings['project_style'] == '5')
        { ?>
            <div class="demo3Project">
                <div class="row">
                    <?php
					$count = 0;
                    while($the_projects->have_posts()): $the_projects->the_post(); $count++; ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="demo3SingleProject">
                                <div class="demo3ProjectImg">
                                <?php echo get_the_post_thumbnail(get_the_ID(), array( 480, 430), array('class'=>'demo3ProImg')); ?>
                                </div>
                                <div class="demoProContent">
                                    <h1><a href="<?php echo get_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h1>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query(); ?>
                </div>
            </div>
        <?php 
        }
        elseif ($settings['project_style'] == '6')
        { ?>
            <section class="hm8paddingSection hm8ProjectSection">
                <div class="container">
                    <div class="row">
                       <div class="col-md-10 col-sm-6 col-xs-12 hm8ProjectHeadLeft">
                          <div class="home8Title">
                             <h3><?php echo esc_html__($settings['project_main_title6'],'indofact'); ?></h3>
                             <h1><?php echo esc_html__($settings['project_title'],'indofact'); ?></h1>
                          </div>
                       </div>
                       <div class="col-md-3 col-sm-6 col-xs-12 hm8ProjectHeadRight">
                          <a href="<?php echo esc_attr($settings['button_link3']); ?>" class="home8Button header-requestbtn contactus-btn hvr-bounce-to-right"> <?php echo esc_html__('View All','indofact'); ?></a>
                       </div>
                    </div>
                </div>
                <div class="container">
                    <div class="projectFilterTab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab"><b>-</b><?php echo esc_html__('All','indofact'); ?></a></li>
                            <?php
                            $parent_cat_arg = array('hide_empty' => false,'parent' => 0);
                            $parent_cat = get_terms('portfolio-category',$parent_cat_arg);
                            $arrNew = array();
                            foreach( $parent_cat as $arrNew ) 
                            {   ?>                  
                                <li role="presentation"><a href="#<?php echo esc_attr($arrNew->slug); ?>" aria-controls="<?php echo esc_attr($arrNew->slug); ?>" role="tab" data-toggle="tab"><?php echo esc_attr($arrNew->name); ?></a></li>
                            <?php 
                            } ?>
                        </ul>
                    </div>
                </div>
                <?php
                $args = array(
                            'post_type' => 'portfolio',
                            'post_status' => 'publish',
                            'order'          => $settings['order'],
                            'orderby'        => $settings['orderby'],
                            'posts_per_page' => $settings['number']
                        );  
                $the_projects = new \WP_Query($args);  ?>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="all">                              
                        <div class="full_wrapper" id="our_project" data-ride="carousel">                            
                            <?php
                            $count=0;
                            while($the_projects->have_posts()): $the_projects->the_post(); ?>
                                <div class="item">
                                    <div class="col-md-4 col-sm-6 col-xs-12 img homeprj3-slide">
                                        <div class="grid">
                                            <div class="image-zoom-on-hover">
                                                <div class="gal-item">
                                                    <a class="black-hover" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(),array( 360, 278,)); ?>
                                                        <div class="tour-layer delay-1"></div>
                                                        <div class="vertical-align">
                                                            <div class="border">
                                                                <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            endwhile;
                            wp_reset_query(); ?>
                        </div>
                    </div>  
                    <?php   
                    $prolist = 1;
                    foreach ($parent_cat as $arrNew) 
                    {   ?>
                        <div role="tabpanel" class="tab-pane " id="<?php echo $arrNew->slug; ?>">                               
                            <div class="full_wrapper " id="our_project<?php echo esc_attr($prolist); ?>" data-ride="carousel">
                                <?php 
                                $argspor = array(
                                    'post_type' => 'portfolio',
                                    'post_status' => 'publish',
                                    'order'          => $settings['order'],
                                    'orderby'        => $settings['orderby'],   
                                    'posts_per_page' => $settings['number'],
                                    'tax_query' => array(
                                                            array(
                                                                'taxonomy' => 'portfolio-category',
                                                                'field' => 'term_id',
                                                                'terms' => $arrNew->term_id,
                                                                )
                                                        )
                                    );  
                                $the_projects = new \WP_Query($argspor);                    
                                $act = 0;                           
                                while($the_projects->have_posts()): $the_projects->the_post(); ?>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6 col-xs-12 img homeprj3-slide">
                                            <div class="grid">
                                                <div class="image-zoom-on-hover">
                                                    <div class="gal-item">
                                                        <a class="black-hover" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(),array( 360, 278,)); ?>
                                                            <div class="tour-layer delay-1"></div>
                                                            <div class="vertical-align">
                                                                <div class="border">
                                                                    <h5><?php echo esc_attr(get_the_title()); ?></h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $act++;
                                endwhile;
                                wp_reset_query(); ?>
                                
                            </div>
                        </div>
                        <?php
                        $prolist++;
                    } ?>
                </div>
                     
            </section>
        <?php 
        }
    }
} ?>
