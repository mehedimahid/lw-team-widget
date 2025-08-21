<?php
namespace LW\Widgets\TeamsWidgets;
use Elementor\Widget_Base;
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
        LW_Teams_Widgets_Controller::register($this);
    }

    protected function render() {
        LW_Teams_Renders::output($this);
    }
}