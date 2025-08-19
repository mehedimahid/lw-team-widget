<?php

namespace LW;
use LW\widgets\LW_widgets_class;
class LW_Custom_Widgets
{
    public function __construct(){
        add_action('elementor/widgets/register', [$this, 'lw_register_widgets']);
        add_action('elementor/elements/categorise_registered', [$this,'lw_add_widgets_categories']);
    }
// Elementor সক্রিয় কিনা চেক করা
    function lw_is_elementor_active() {
        return did_action( 'elementor/loaded' );
    }
    public function lw_register_widgets($widgets_manager) {
        $widgets_manager->register(new LW_widgets_class());
    }
    public function lw_add_widgets_categories($categorise_manager)
    {
        $categorise_manager->add_category(
          'lw_custom_category',
            [
                'title' => __('LW Custom Categorise', 'lw'),
                'icon'=> 'fa fa-plug',
            ]
        );
    }
}