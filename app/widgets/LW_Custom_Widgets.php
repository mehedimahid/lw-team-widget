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
        $categories = [];
            $categories['lw-custom-category'] =  [
                'title' => __('Custom Categorise', 'lw'),
                'icon'=> 'fa fa-plug',
            ];
        $other_categories = $categorise_manager->get_categories();
        $categories = array_merge(
            array_slice( $other_categories, 0, 1 ),
            $categories,
            array_slice( $other_categories, 1 )
        );
        $set_categories = function ( $categories ) use ( $categorise_manager ) {
            $categorise_manager->categories = $categories;
        };
        $set_categories->call( $categorise_manager, $categories );
    }
}