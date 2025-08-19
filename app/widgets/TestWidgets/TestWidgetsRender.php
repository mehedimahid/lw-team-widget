<?php

namespace LW\widgets\TestWidgets;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class TestWidgetsRender {
    public  static function output($widgets) {
        $settings = $widgets->get_settings_for_display();
        ?>
        <div class="lw_widgets2">
            <h2 class="lw_title2"><?php echo esc_html($settings['lw_title2']) ;?></h2>
            <p class="lw_description2"><?php echo esc_html($settings['lw_description2']) ;?></p>
        </div>
<?php
    }
}