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
        $widgets->start_controls_section('content_section', [
            'label' => esc_html__('Teams Info', 'lw-team-widget'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
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