<?php
/*
Plugin Name: LW Team Widgets
Plugin URI: 
Description: A simple plugin that shows a welcome message to new visitors.
Version: 1.0
Author: Mehedi Hasan
Author URI: https://github.com/mehedimahid
License: GPL2
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
use LW\Teams;

define( 'LW_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'LW_DIR_URL', plugin_dir_url(__FILE__) );
require_once LW_DIR_PATH . 'vendor/autoload.php';

add_action( 'plugins_loaded', 'lw_team' );
function lw_team(){
    new Teams();
}
