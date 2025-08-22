<?php

namespace LW\Teams;

class LWTeamsAjax
{
    public function __construct() {
        add_action('wp_ajax_lw_load_teams', [$this, 'lw_load_teams_callback']);
        add_action('wp_ajax_nopriv_lw_load_teams', [$this, 'lw_load_teams_callback']);
    }
    public static function lw_load_teams_callback()
    {
        check_ajax_referer('lw_teams_nonce', 'nonce');
        $posts_per_page   = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;
        $posts_per_column = isset($_POST['posts_per_column']) ? intval($_POST['posts_per_column']) : 3;
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $posts_switch = isset($_POST['posts_switch']) ? $_POST['posts_switch'] : [] ;
        $current_page_id = isset($_POST['current_page_id']) ? $_POST['current_page_id'] : null ;

        $args = [
            'post_type' => 'lw-teams',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
        ];

        $query = new \WP_Query($args);
        ob_start();

        if ($query->have_posts()) {
           while ($query->have_posts()) {
                $query->the_post();

                echo '<div class="lw-team-item">';
                foreach ($posts_switch as $index => $item){
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
                }
                echo '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No team members found.', 'lw') . '</p>';
        }
        $html = ob_get_clean();
        ob_start();
        $big = 999999999; // need an unlikely integer
        $pagination = paginate_links( [
            'base'      => trailingslashit( get_permalink( $current_page_id ) ) . 'page/%#%/',
            'format'    => '',
            'current'   => max( 1, $paged ),
            'total'     => $query->max_num_pages,
            'type'      => 'plain',
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »'),
        ] );
        ob_get_clean();
        wp_send_json_success([
            'html' => $html,
            'pagination' => $pagination
        ]);
    }
}