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
class Comingsoon extends Widget_Base{
    public function get_name(){
        return 'comingsoon';
    }
    public function get_title(){
        return 'Coming Soon';
    }
    public function get_icon(){
        return 'fa fa-clock-o';
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
            'date',
            [
                'label'    => esc_html__( 'Launching Date', 'zigma' ),
                'type'     => \Elementor\Controls_Manager::DATE_TIME,
                'default'  => '',
            ]
        );
        $this->add_control(
            'days',
            [
                'label'    => esc_html__( 'Days Text', 'zigma' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Days', 'zigma' ),
            ]
        );
        $this->add_control(
            'hours',
            [
                'label'    => esc_html__( 'Hours Text', 'zigma' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Hours', 'zigma' ),
            ]
        );
        $this->add_control(
            'minutes',
            [
                'label'    => esc_html__( 'Minutes Text', 'zigma' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Minutes', 'zigma' ),
            ]
        );
        $this->add_control(
            'seconds',
            [
                'label'    => esc_html__( 'Seconds Text', 'zigma' ),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => esc_html__( 'Seconds', 'zigma' ),
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
        $currentDate = date("m/d/Y");
        if($settings['date'])
        {
            $commingDate = date('m/d/Y', strtotime($settings['date']));
        }
        else
        {
            $commingDate = date('m/d/Y', strtotime($currentDate. ' + 28 days'));
        }
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="cell-view">
                            <div class="comming_shadow">
                                <div class="countdown" id="demo"></div>
                                <div id="clockdiv" class="timerWrapper">
                                    <div class="timerBlock">
                                        <div id="days" class="timer days"></div>
                                        <span>
                                            <?php 
                                                echo esc_attr($settings['days']); 
                                            ?>
                                        </span>
                                    </div>
                                    <div class="timerBlock">
                                        <div id="hours" class="timer hours"></div>
                                        <span>
                                            <?php 
                                                echo esc_attr($settings['hours']); 
                                            ?>
                                        </span>
                                    </div>
                                    <div class="timerBlock">
                                        <div id="minutes" class="timer minutes"></div>
                                        <span>
                                            <?php 
                                                echo esc_attr($settings['minutes']); 
                                            ?>
                                        </span>
                                    </div>
                                    <div class="timerBlock">
                                        <div id="seconds" class="timer seconds"></div>
                                        <span>
                                            <?php 
                                                echo esc_attr($settings['seconds']); 
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                jQuery(document).on('ready', function () {
                    (function (jQuery) {
                     setInterval(coundown,1000,<?php echo "'".$commingDate."'";?>);
                    })(jQuery);
                });
            </script>
    <?php
    }
}
?>