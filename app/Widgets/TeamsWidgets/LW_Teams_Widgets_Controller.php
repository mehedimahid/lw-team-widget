<?php

namespace LW\Widgets\TeamsWidgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class LW_Teams_Widgets_Controller
{
    public static function register($widgets)
    {
        self::teamsWidgetsController($widgets);
    }
    private static function teamsWidgetsController($widgets){
        $widgets->start_controls_section('posts_control', [
            'label' => esc_html__('Posts Control', 'lw-team-widget'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
        $widgets->add_control(
            'posts_per_page',
            [
                'label'   => __('Posts Per Page', 'lw'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
                'min'     => 1,
                'max'     => 50,
            ]
        );
        $widgets->add_control(
            'posts_per_column',
            [
                'label'   => __('Posts Per Column', 'lw'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => __('1 Column', 'lw'),
                    '2' => __('2 Columns', 'lw'),
                    '3' => __('3 Columns', 'lw'),
                    '4' => __('4 Columns', 'lw'),
                    '5' => __('5 Columns', 'lw'),
                ],
            ]
        );
        $widgets->add_control(
            'posts_switch',
            [
                'label'   => __('Posts Switch', 'lw'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => [
                    [
                        'name'=> 'information',
                        'label' => esc_html__( 'Information', 'textdomain' ),
                        'type' => Controls_Manager::SELECT,
                        'default'=>'',
                        'options' => [
                            'thumb' => __('Thumbnail', 'lw'),
                            'name' => __('Name', 'lw'),
                            'position' => __('Position', 'lw'),
                            'email' => __('E-mail', 'lw'),
                            'phone' => __('Phone Number', 'lw'),
                            'description' => __('Description', 'lw'),
                            'address' => __('Address', 'lw'),
                            'shortcode' => __('Short Code', 'lw'),
                        ],
                    ],
                ],
                'default'=>[
                    [
                        'information' => 'thumb',
                    ],
                    [
                        'information' => 'name',
                    ],
                    [
                        'information' => 'position',
                    ],
                    [
                        'information' => 'email',
                    ],
                    [
                        'information' => 'phone',
                    ],
                    [
                        'information' => 'address',
                    ],
                    [
                        'information' => 'description',
                    ],
                ],
                'title_field' => '{{{ information }}}',

            ]
        );
        $widgets->end_controls_section();
        //name style
        $widgets->start_controls_section('style_name_section', [
            'label' => esc_html__('Name Style', 'lw-team-widget'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $widgets->add_control('name_color', [
            'label' => esc_html__('Name Color', 'lw-team-widget'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lw-team-member-name' => 'color: {{VALUE}};',
            ]
        ]);
        $widgets->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'selector' => '{{WRAPPER}} .lw-team-member-name',
        ]);
        $widgets->end_controls_section();

        //Email style
        $widgets->start_controls_section('style_email_section', [
            'label' => esc_html__('Email Style', 'lw-team-widget'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $widgets->add_control('email_color', [
            'label' => esc_html__('Email Color', 'lw-team-widget'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lw-team-member-email' => 'color: {{VALUE}};',
            ]
        ]);
        $widgets->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'email_typography',
            'selector' => '{{WRAPPER}} .lw-team-member-email',
        ]);
        $widgets->end_controls_section();

        //phone style
        $widgets->start_controls_section('style_phone_section', [
            'label' => esc_html__('Phone Style', 'lw-team-widget'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $widgets->add_control('phone_color', [
            'label' => esc_html__('Phone Number Color', 'lw-team-widget'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lw-team-member-phone' => 'color: {{VALUE}};',
            ]
        ]);
        $widgets->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'phone_typography',
            'selector' => '{{WRAPPER}} .lw-team-member-phone',
        ]);
        $widgets->end_controls_section();
    }
}