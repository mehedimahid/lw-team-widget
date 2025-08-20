<?php
namespace LW\teamswidgets;

class LWTeams
{
    public function __construct(){
        add_action('init', array($this, 'register_teams'));
    }
    public function register_teams(){
        register_post_type(
                'lw-teams',[
            'labels' => [
                'name'=>'Teams',
                'singular_name'=>'Team',
            ],
            'public' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
        ]);
    }
}