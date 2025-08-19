<?php

namespace LW\widgets;
use LW\widgets\TestWidgets\LW_Test_Widgets;

class LW_Custom_Widgets
{
    public function __construct(){
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action( 'elementor/elements/categories_registered', [$this, 'add_widgets_categories']);
    }

    public function register_widgets($widgets_manager) {
        $widgets_manager->register(new LW_Test_Widgets());
    }
    public function add_widgets_categories($categorise_manager) {
        $categorise_manager->add_category(
          'lw-custom-category',
            [
                'title' => __('Custom Categorise', 'lw'),
                'icon'=> 'fa fa-plug',
            ]
        );
    }
}