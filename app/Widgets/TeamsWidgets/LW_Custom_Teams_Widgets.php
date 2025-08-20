<?php
namespace LW\Widgets\TeamsWidgets;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
class LW_Custom_Teams_Widgets extends Widget_Base{
    public function get_name() {
        return 'lw-teams';
    }
    public function get_title() {
        return __( 'Teams', 'lw-team-widget' );
    }
    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['lw-custom-category'];
    }
    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Team Info', 'lw'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        LW_Teams_Renders::output($this);
    }
}