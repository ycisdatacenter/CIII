<?php

namespace WPC\Widgets;

use Elementor\Widget_Base as ElementorWidget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<?php
class Products extends ElementorWidget_Base
{

    public function get_name()
    {
        return 'products';
    }
    public function get_title()
    {
        return 'Products';
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
            'product_style',
            [
                'label'   => esc_html__( 'Style', 'indofact' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'indofact' ),
                    '2' => esc_html__( 'Style 2', 'indofact' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'product_sub_title',
            [
                'label'    => 'Sub Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'OUR PRODUCTS', 'indofact' ),
                'condition' => [ 'product_style' => '1' ],
            ]
        );
        $this->add_control(
            'product_title',
            [
                'label'    => 'Title Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'We Offer Reliable Industrial Products', 'indofact' ),
                'condition' => [ 'product_style' => '1' ],
            ]
        );
        $this->add_control(
            'product_title_paragraph',
            [
                'label'    => 'Title Paragraph Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consec tetur adipiscing elit. Etiam fermentum nulla.Lorem ipsum dolor sit amet, consec tetur adipiscing elit. Etiam fermentum nulla.', 'indofact' ),
                'condition' => [ 'product_style' => '1' ],
            ]
        );
         $this->add_control(
            'cart_button_text',
            [
                'label'    => 'Cart Button Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'BUY NOW', 'indofact' ),
                'condition' => [ 'product_style' => '1' ],
            ]
        );
        $this->add_control(
            'sale_text',
            [
                'label'    => 'Sale Text',
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Sale!', 'indofact' ),
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
                'post_type' => 'product',
                'post_status' => 'publish',
                'order'          => $settings['order'],
                'orderby'        => $settings['orderby'],
                'posts_per_page' => $settings['number']
            );
        $the_query = new \WP_Query($args);
        if($settings['product_style'] == '1')
        {
        ?>
        <section class="hm8paddingSection hm8ProductSection">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                        <div class="home8Title text-center">
                            <h3><?php echo esc_html__($settings['product_sub_title'],'indofact'); ?></h3>
                            <h1><?php echo esc_html__($settings['product_title'],'indofact'); ?></h1>
                            <p><?php echo esc_html__($settings['product_title_paragraph'],'indofact'); ?></p>
                        </div>
                    </div>
                    <div class="woocommerce columns-4 ">
                        <ul class="products columns-4">
                            <?php
							$count = 0;
                            while ( $the_query->have_posts() ): 
                                $the_query->the_post(); 
                                $count++; 
                                $product = wc_get_product( get_the_ID() );
                                $rating  = $product->get_average_rating();
                                $ratecount   = $product->get_rating_count();
                                
                                if($rating == 2)
                                {
                                $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                }
                                elseif($rating == 3)
                                {
                                $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                }
                                elseif($rating == 4)
                                {
                                $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                }
                                elseif($rating == 5)
                                {
                                $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                                else
                                {
                                $starValue ='<i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                }
                            ?>
                                <li class="product type-product status-publish has-post-thumbnail product_cat-big-tools first instock sale shipping-taxable purchasable product-type-simple">
                                    <a href="<?php echo get_the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <?php
                                        if ( $product->is_on_sale() ){ ?>
                                            <span class="onsale"><?php echo esc_html($settings['sale_text'], 'indofact'); ?></span>
                                        <?php } 
                                        ?>
                                        <?php the_post_thumbnail(); ?>
                                        <h2 class="woocommerce-loop-product__title"><?php echo esc_html(the_title()); ?></h2>
                                        <span class="price">
                                            <?php echo $product->get_price_html(); ?>
                                        </span>
                                    </a>
                                    <a href="?add-to-cart=<?php echo get_the_ID(); ?>" data-quantity="1" class="card-link btn-primary button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="" aria-label="Add “Book” to your cart" rel="nofollow"> BUY NOW</a>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_query();
                             ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
       <!--=========Product Start============-->
       <?php
       }
       else
       { ?>
            <section class="product_style2">
                <div class="container"> 
                    <div class="row">
                        <div class="woocommerce columns-4 ">
                            <ul class="products columns-4">
                                <?php
                                $count = 0;
                                while ( $the_query->have_posts() ): 
                                    $the_query->the_post(); 
                                    $count++; 
                                    $product = wc_get_product( get_the_ID() );
                                    $rating  = $product->get_average_rating();
                                    $ratecount   = $product->get_rating_count();
                                    
                                    if($rating == 2)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($rating == 3)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($rating == 4)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    elseif($rating == 5)
                                    {
                                    $starValue ='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                    }
                                    else
                                    {
                                    $starValue ='<i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                ?>
                                    <li class="product type-product status-publish has-post-thumbnail product_cat-big-tools first instock sale shipping-taxable purchasable product-type-simple">
                                        <a href="<?php echo get_the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <?php
                                            if(!empty($settings['sale_text']))
                                            {
                                                if ( $product->is_on_sale() ){ ?>
                                                    <span class="onsale"><?php echo esc_html($settings['sale_text'], 'indofact'); ?></span>
                                            <?php } 
                                            }
                                            the_post_thumbnail(); ?>
                                            <div class="woocommerce-loop-product__titl">
                                                <h4 class="e"><?php echo esc_html(the_title()); ?></h4>
                                                <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                                <?php if(!empty($rating)){ ?>
                                                <div class="rating_star"><?php echo $starValue; ?></div>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <div class="product2_bottom">
                                            <span class="price">
                                                <?php echo esc_html('Price', 'indofact').':'.' '.$product->get_price_html(); ?>
                                            </span>
                                            <a href="?add-to-cart=<?php echo get_the_ID(); ?>" data-quantity="1" class="card-link btn-primary button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="" aria-label="Add “Book” to your cart" rel="nofollow"><?php echo esc_html('ADD CART', 'indofact');?></a>
                                        </div>
                                    </li>
                                <?php
                                endwhile;
                                wp_reset_query();
                                 ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
       <?php 
       }
    }
}