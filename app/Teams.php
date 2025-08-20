<?php
namespace LW;
use LW\Widgets\LW_Custom_Widgets;
use LW\Teams\LWTeams;

class Teams {
    public function __construct() {
        new LWTeams();
        new LW_Custom_Widgets();
    }
}