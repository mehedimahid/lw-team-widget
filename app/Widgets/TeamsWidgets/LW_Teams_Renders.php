<?php
namespace LW\Widgets\TeamsWidgets;
class LW_Teams_Renders {
    public static function output($widgets) {
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
            echo '<div class="lw-team-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;">';

            while ($query->have_posts()) {
                $query->the_post();

                echo '<div class="lw-team-item" style="border:1px solid #eee;padding:15px;text-align:center;border-radius:10px;">';

                if (has_post_thumbnail()) {
                    echo '<div class="lw-team-img" style="margin-bottom:10px;">';
                    // ✅ custom image size ব্যবহার
                    the_post_thumbnail('lw-team-thumb', [
                        'style' => 'border-radius:5%; width:100%; object-fit:cover;'
                    ]);
                    echo '</div>';
                }

                echo '<h3>' . esc_html(get_the_title()) . '</h3>';

                // 📌 Position (taxonomy terms)
                $positions = get_the_terms(get_the_ID(), 'member_position');
                if ($positions && !is_wp_error($positions)) {
                    $pos_names = wp_list_pluck($positions, 'name');
                    echo '<p class="lw-team-position" style="font-weight:bold;color:#555;">' . esc_html(implode(', ', $pos_names)) . '</p>';
                }

                // 📧 Email
                $email = get_post_meta(get_the_ID(), '_lw_member_email', true);
                if ($email) {
                    echo '<p class="lw-team-email"><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></p>';
                }

                // 📱 Phone
                $phone = get_post_meta(get_the_ID(), '_lw_member_phone', true);
                if ($phone) {
                    echo '<p class="lw-team-phone">' . esc_html($phone) . '</p>';
                }


                echo '<div class="desc">' . wp_kses_post(get_the_content()) . '</div>';
                // 🏠 Address (optional)
                $address = get_post_meta(get_the_ID(), '_lw_member_address', true);
                if ($address) {
                    echo '<p class="lw-team-address">' . esc_html($address) . '</p>';
                }
                echo '</div>';
            }

            echo '</div>';
            // 📌 Pagination
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
                echo '<div class="lw-pagination" style="margin-top:20px;text-align:center;">' . $pagination . '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No team members found.', 'lw') . '</p>';
        }
    }

}