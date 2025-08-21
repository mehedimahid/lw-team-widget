<?php
namespace LW\Widgets\TeamsWidgets;
class LW_Teams_Renders {
    public static function output($widgets) {
        if ( ! wp_style_is('lw-teams-style', 'enqueued') ) {
            wp_enqueue_style('lw-teams-style');
        }
        $settings = $widgets->get_settings_for_display();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
        $args = [
            'post_type'      => 'lw-teams',
            'post_status' =>'publish',
            'posts_per_page' => 3,
            'paged'          => $paged,
        ];

        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            echo '<div class="lw-team-grid">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<div class="lw-team-item">';
                if (has_post_thumbnail()) {
                    echo '<div class="lw-team-member-img">';
                    // ✅ custom image size ব্যবহার
                    the_post_thumbnail('lw-team-thumb', [
                    ]);
                    echo '</div>';
                }
                echo '<h3 class="lw-team-member-name">' . esc_html(get_the_title()) . '</h3>';
                //  Position
                $positions = get_the_terms(get_the_ID(), 'member_position');
                if ($positions && !is_wp_error($positions)) {
                    $pos_names = wp_list_pluck($positions, 'name');
                    echo '<p class="lw-team-member-position">' . esc_html(implode(', ', $pos_names)) . '</p>';
                }
                //  Email
                $email = get_post_meta(get_the_ID(), '_lw_member_email', true);
                if ($email) {
                    echo '<p class="lw-team-member-email"><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></p>';
                }
                //  Phone
                $phone = get_post_meta(get_the_ID(), '_lw_member_phone', true);
                if ($phone) {
                    echo '<p class="lw-team-member-phone">' . esc_html($phone) . '</p>';
                }
                echo '<div class="lw-team-member-desc">' . wp_kses_post(get_the_content()) . '</div>';
                //  Address (optional)
                $address = get_post_meta(get_the_ID(), '_lw_member_address', true);
                if ($address) {
                    echo '<p class="lw-team-member-address">' . esc_html($address) . '</p>';
                }
                echo '</div>';
            }
            echo '</div>';
            //  Pagination
            $big = 999999999; // unique সংখ্যা
            $pagination = paginate_links([
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, $paged),
                'total'     => $query->max_num_pages,
                'prev_text' => __('« Prev', 'lw'),
                'next_text' => __('Next »', 'lw'),
                'type'      => 'list', // <ul><li> format
            ]);
            if ($pagination) {
                echo '<div class="lw-pagination" >' . $pagination . '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No team members found.', 'lw') . '</p>';
        }
    }
}