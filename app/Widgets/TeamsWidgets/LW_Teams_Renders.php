<?php
namespace LW\Widgets\TeamsWidgets;
class LW_Teams_Renders {
    public static function output($widgets) {
        $settings = $widgets->get_settings_for_display();
        $posts_per_page = !empty($settings['posts_per_page']) ? $settings['posts_per_page'] : 1;
        $posts_per_column = !empty($settings['posts_per_column']) ? $settings['posts_per_column'] : 3;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
        $args = [
            'post_type'      => 'lw-teams',
            'post_status' =>'publish',
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
        ];

        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            echo '<div class="lw-team-grid lw-column-'.esc_attr($posts_per_column).'">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<div class="lw-team-item">';
                foreach ($settings['posts_switch'] as $index => $item){
                    switch ($item['information']) {
                        case 'thumb':
                            if (has_post_thumbnail()) {
                                echo '<div class="lw-team-member-img">';
                                // ✅ custom image size ব্যবহার
                                the_post_thumbnail('lw-team-thumb', [
                                ]);
                                echo '</div>';
                            }
                            break;
                        case 'name':
                            echo '<h3 class="lw-team-member-name">' . esc_html(get_the_title()) . '</h3>';
                            break;
                        case 'position':
                            $positions = get_the_terms(get_the_ID(), 'member_position');
                            if ($positions && !is_wp_error($positions)) {
                                $pos_names = wp_list_pluck($positions, 'name');
                                echo '<p class="lw-team-member-position">' . 'Position : ' . esc_html(implode(', ', $pos_names)) . '</p>';
                            }
                            break;
                        case 'email':
                            $email = get_post_meta(get_the_ID(), '_lw_member_email', true);
                            if ($email) {
                                echo '<p class="lw-team-member-email"><a href="mailto:' . esc_attr($email) . '">' . "Email : " . esc_html($email) . '</a></p>';
                            }
                            break;
                        case 'phone':
                            $phone = get_post_meta(get_the_ID(), '_lw_member_phone', true);
                            if ($phone) {
                                echo '<p class="lw-team-member-phone">' . 'Phone Number :' . esc_html($phone) . '</p>';
                            }
                            break;
                        case 'address':
                            $address = get_post_meta(get_the_ID(), '_lw_member_address', true);
                            if ($address) {
                                echo '<p class="lw-team-member-address">' . 'Address : ' . esc_html($address) . '</p>';
                            }
                            break;
                        case 'description':
                            echo '<div class="lw-team-member-desc">' . wp_kses_post(get_the_content()) . '</div>';
                        break;
                    }

//                    if (has_post_thumbnail()) {
//                        echo '<div class="lw-team-member-img">';
//                        // ✅ custom image size ব্যবহার
//                        the_post_thumbnail('lw-team-thumb', [
//                        ]);
//                        echo '</div>';
//                    }
//                    echo '<h3 class="lw-team-member-name">' . esc_html(get_the_title()) . '</h3>';
//                    //  Position
//                    $positions = get_the_terms(get_the_ID(), 'member_position');
//                    if ($positions && !is_wp_error($positions)) {
//                        $pos_names = wp_list_pluck($positions, 'name');
//                        echo '<p class="lw-team-member-position">' . 'Position : ' . esc_html(implode(', ', $pos_names)) . '</p>';
//                    }
//                    //  Email
//                    $email = get_post_meta(get_the_ID(), '_lw_member_email', true);
//                    if ($email) {
//                        echo '<p class="lw-team-member-email"><a href="mailto:' . esc_attr($email) . '">' . "Email : " . esc_html($email) . '</a></p>';
//                    }
//                    //  Phone
//                    $phone = get_post_meta(get_the_ID(), '_lw_member_phone', true);
//                    if ($phone) {
//                        echo '<p class="lw-team-member-phone">' . 'Phone Number :' . esc_html($phone) . '</p>';
//                    }
//                    echo '<div class="lw-team-member-desc">' . wp_kses_post(get_the_content()) . '</div>';
//                    //  Address (optional)
//                    $address = get_post_meta(get_the_ID(), '_lw_member_address', true);
//                    if ($address) {
//                        echo '<p class="lw-team-member-address">' . 'Address : ' . esc_html($address) . '</p>';
//                    }
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