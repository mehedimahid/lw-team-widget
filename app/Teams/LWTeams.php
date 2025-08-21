<?php
namespace LW\Teams;

class LWTeams
{
    public function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('init', array($this, 'register_teams'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
        add_action('after_setup_theme', [$this, 'add_image_size']);
    }
    public function enqueue_assets()
    {
        wp_register_style(
            'lw-teams-style',
            LW_DIR_URL.'app/assets/css/teamStyle.css',
            [],
            '1.0.0'
        );
    }
    public function add_image_size(){
        add_image_size('lw-team-thumb', 300, 300, true);
    }
    public function register_teams(){
        register_post_type(
             'lw-teams',[
            'labels' => [
                'name'=>'Team Members',
                'singular_name'=>'Team',
                'add_new'       => __('Add New Member', 'lw'),
                'add_new_item'  => __('Add Team Member', 'lw'),
                'edit_item'     => __('Edit Team Member', 'lw'),
                'new_item'      => __('New Team Member', 'lw'),
                'view_item'     => __('View Team Member', 'lw'),
                'search_items'  => __('Search Team Members', 'lw'),
                'not_found'     => __('No team members found', 'lw'),
            ],
            'public' => true,
            'menu_icon' => 'dashicons-groups',
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => false,
        ]);
        $arg = [
            'labels' => [
                'name'              => __( 'Positions', 'textdomain' ),
                'singular_name'     => __( 'Position', 'textdomain' ),
            ],
            'hierarchical'      => true,
        ];
        register_taxonomy(
             'member_position',
            'lw-teams',
            $arg
        );
    }
    public function add_meta_boxes(){
        add_meta_box(
            'lw-teams',
            __('Teams', 'lw'),
            [$this, 'add_meta_boxes_callback'],
            'lw-teams',
        );
    }
    public function add_meta_boxes_callback($post){
        $email = get_post_meta($post->ID, '_lw_member_email', true);
        $Phone = get_post_meta($post->ID, '_lw_member_phone', true);
        $Address = get_post_meta($post->ID, '_lw_member_address', true);
        wp_nonce_field( 'lw_teams_nonce_action', 'lw_teams_nonce' );
        ?>
        <div>
            <p>
                <label for="lw_member_email"><strong><?php _e('Email:', 'lw'); ?></strong></label><br>
                <input type="email" name="lw_member_email" id="lw_member_email" value="<?php echo esc_attr($email) ?>" style="width:100%;" />
            </p>
            <p>
                <label for="lw_member_phone"><strong><?php _e('Phone Number:', 'lw'); ?></strong></label><br>
                <input type="number" name="lw_member_phone" id="lw_member_phone" value="<?php echo esc_attr($Phone) ?>" style="width:100%;" />
            </p>
            <p>
                <label for="lw_member_address"><strong><?php _e('Address:', 'lw'); ?></strong></label><br>
                <input type="text" name="lw_member_address" id="lw_member_address" value="<?php echo esc_attr($Address) ?>" style="width:100%;" />
            </p>
        </div>
        <?php
    }
    public function save_meta_boxes($post_id){
        if(!isset($_POST['lw_teams_nonce']) || !wp_verify_nonce($_POST['lw_teams_nonce'], 'lw_teams_nonce_action')){
            return;
        }
        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return;
        }
        if( ! current_user_can('edit_post', $post_id) ){
            return;
        }
        if(array_key_exists('lw_member_email', $_POST)){
            update_post_meta($post_id, '_lw_member_email', sanitize_text_field($_POST['lw_member_email']));
        }
        if(array_key_exists('lw_member_phone', $_POST)){
            update_post_meta($post_id, '_lw_member_phone', sanitize_text_field($_POST['lw_member_phone']));
        }
        if(array_key_exists('lw_member_address', $_POST)){
            update_post_meta($post_id, '_lw_member_address', sanitize_text_field($_POST['lw_member_address']));
        }
    }
}