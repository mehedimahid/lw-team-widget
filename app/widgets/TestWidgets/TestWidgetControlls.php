<?php

namespace LW\widgets\TestWidgets;
use Elementor\Controls_Manager;

class TestWidgetControlls {
    public static function register( $widget ) {
        self::section1($widget);
    }

    private static function section1( $widget )
    {
        $widget->start_controls_section(
            "lw_test_section",
            [
                'label'=>__('LW Latest Tests', 'widget-widget-test'),
                'tab'=>Controls_Manager::TAB_CONTENT,
            ]
        );
        $widget->add_control(
            'lw_title2',
            [
                'label' => __( 'Test Title', 'lw' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'LW Test Widgets', 'lw' ),
                'placeholder' => __( 'Type your title here', 'lw' ),
            ]
        );
        $widget->add_control(
            'lw_description2',
            [
                'label' => __( 'Test Description', 'lw' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Type your description here', 'lw' ),
                'default' => __( 'This is a Test Elementor widget description.', 'lw' ),
            ]
        );
        $widget->add_control(
            'lw_lightbox',
            [
                'type' => Controls_Manager::SELECT,
                'label'=>esc_html__( 'Lightbox', 'lw' ),
                'options' => [
                    'default' => esc_html__( 'Defaukt', 'textdomain' ),
                    'yes' => esc_html__( 'Yes', 'lw' ),
                    'no' => esc_html__( 'NO', 'lw' ),
                ],
                'default' => 'no',
            ]
        );
        $widget->add_control(
            'lw_alingment',
            [
                'type' => Controls_Manager::CHOOSE,
                'label'=> esc_html__( 'Alingment', 'lw' ),
                'options' =>[
                    'left' => [
                        'title' => esc_html__( 'Left', 'lw' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'lw' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'lw' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'lw' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
            ]
        );
        $widget->end_controls_section();
    }

}