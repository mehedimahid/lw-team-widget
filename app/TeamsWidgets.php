<?php
namespace LW;
use LW\widgets\LW_Custom_Widgets;
use LW\teamswidgets\LWTeams;
use LW\teamswidgets\LW_Teams_Widgets;

class TeamsWidgets {
    public function __construct() {
        new LW_Teams_Widgets();
        new LWTeams();
        new LW_Custom_Widgets();
    }
}