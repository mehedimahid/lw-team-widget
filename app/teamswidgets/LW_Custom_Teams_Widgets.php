<?php
namespace LW\teamswidgets;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
class LW_Custom_Teams_Widgets extends Widget_Base{
    public function get_name() {
        return 'lw-custom-teams';
    }
    public function get_title() {
        return __( 'Custom Teams', 'lw-team-widget' );
    }
    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['lw_teams_widget'];
    }
    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Team Info', 'lw'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('name', [
            'label' => __('Name', 'lw'),
            'type' => Controls_Manager::TEXT,
            'default' => __('John Doe', 'lw'),
        ]);

        $this->add_control('email', [
            'label' => __('Email', 'lw'),
            'type' => Controls_Manager::TEXT,
            'default' => __('john@example.com', 'lw'),
        ]);
        $this->add_control('designation', [
                    'label' => __('Designation', 'lw'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Manager', 'lw'),
                ]);

        $this->add_control('description', [
            'label' => __('Bio', 'lw'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Short bio here...', 'lw'),
        ]);
        $this->add_control(
            'team_member_image',
            [
                'label' => __('Team Member Image', 'lw'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        LW_teams_renders::output($this);
    }
}