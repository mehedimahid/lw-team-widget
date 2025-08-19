<?php

namespace LW\widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class LW_widgets_class extends Widget_Base{
    public function get_name() {
        return 'lw_custom_widget';
    }
    public function get_title() {
        return __( 'LW Custom Widgets', 'lw' );
    }
    public function get_icon() {
        return 'eicon-star';
    }
    public function get_categories() {
        return [ 'lw_custom_category' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'lw_content_section',
            [
                'label' => __( 'LW Content', 'lw' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'lw_title',
            [
                'label' => __( 'LW Title', 'lw' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'LW Custom Widgets', 'lw' ),
                'placeholder' => __( 'Type your title here', 'lw' ),
            ]
        );
        $this->add_control(
            'lw_description',
            [
                'label' => __( 'LW Description', 'lw' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Type your description here', 'lw' ),
                'default' => __( 'This is a custom Elementor widget description.', 'lw' ),
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'lw_style_section',
            [
                'label' => __( 'LW Style', 'lw' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'lw_title_color',
            [
                'label' => __( 'Title Color', 'lw' ),
                'type' => Controls_Manager::COLOR,
                'selectors' =>[
                    '{{WRAPPER}} .lw_title' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
          <div class="lw_widgets">
            <h2 class="lw_title"><?php echo esc_html($settings['lw_title']) ;?></h2>
            <p class="lw_description"><?php echo esc_html($settings['lw_description']) ;?></p>
         </div>
       <?php
    }
}