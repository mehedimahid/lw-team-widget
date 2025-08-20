<?php
namespace LW\teamswidgets;
class LW_teams_renders {
    public  static function output($widgets) {
        $settings = $widgets->get_settings_for_display();
        ?>
        <div class="responsive-container-block container">
            <p class="text-blk team-head-text">
                Our Team
            </p>
            <div class="responsive-container-block">
                <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
                    <div class="card">
                        <div class="team-image-wrapper">
                            <img class="team-member-image" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/expert1.png">
                        </div>
                        <p class="text-blk name">
                            <?php echo esc_html($settings['name']); ?>
                        </p>
                        <p class="text-blk position">
                            <?php echo  esc_html($settings['designation']); ?>
                        </p>
                        <p class="text-blk feature-text">
                            <?php  echo esc_html($settings['description']); ?>
                        </p>
                        <div class="social-icons">
                            <p><a href="mailto:  <?php echo esc_attr($settings['email']) ?>"> Email:<?php echo  esc_html($settings['email']) ?> '</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}