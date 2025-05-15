<?php
namespace WPC;

class widget_loader{
    private static $_instance = null;
    public static function instance(){
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function include_widgets_files()
    {
        require_once(__DIR__. '/widgets/projects.php');
        require_once(__DIR__. '/widgets/testimonial_style.php');
        require_once(__DIR__. '/widgets/news.php');
        require_once(__DIR__. '/widgets/team_widget.php');
        require_once(__DIR__. '/widgets/products.php');
        require_once(__DIR__. '/widgets/portfolio.php');
        require_once(__DIR__. '/widgets/companyhistory.php');
        require_once(__DIR__. '/widgets/comingsoon.php');
        require_once(__DIR__. '/widgets/services.php');
        require_once(__DIR__. '/widgets/clients.php');
    }
    public function register_widgets()
    {
        $this->include_widgets_files();

       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Projects());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonial_Style());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\News());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Team_Widget());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Products());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Portfolio());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\companyhistory());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Comingsoon());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\services());
       \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Clients());
    }
    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }
}
widget_loader::instance();