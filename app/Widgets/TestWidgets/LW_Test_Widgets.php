<?php

namespace LW\Widgets\TestWidgets;
use Elementor\Widget_Base;

class LW_Test_Widgets extends Widget_Base{
    public function get_name() {
        return 'lw-test-widgets';
    }
    public function get_title() {
        return __( 'LW Latest Tests', 'widget-widget-test' );
    }
    public function get_icon() {
        return 'eicon-facebook-like-box';
    }
    public function get_categories() {
        return [ 'lw-custom-category' ];
    }
    protected function _register_controls() {
       TestWidgetControlls::register($this);
    }
    protected function render() {
         TestWidgetsRender::output($this);
    }
}