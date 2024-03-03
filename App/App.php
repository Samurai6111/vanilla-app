<?php

require_once(get_theme_file_path() . "/vendor/autoload.php");
/*--------------------------------------------------
/* /App内の全てのコアファイル
/*------------------------------------------------*/
require_once(get_theme_file_path() . "/App/Function/App-funtions.php");
require_once(get_theme_file_path() . "/App/Wordpress/App-wordpress.php");
require_once(get_theme_file_path() . "/App/Inserts/App-inserts.php");
require_once(get_theme_file_path() . "/App/Form/App-form.php");

// ---------- feature機能 ----------
require_once(get_theme_file_path() . "/Feature-suumo/App-suumo.php");
require_once(get_theme_file_path() . "/Feature-map/App-map.php");
require_once(get_theme_file_path() . "/Feature-pixel-art/App-pixel-art.php");
require_once(get_theme_file_path() . "/Feature-data-extraction/App-data-extraction.php");
require_once(get_theme_file_path() . "/Feature-roulette/App-roulette.php");
require_once(get_theme_file_path() . "/Feature-housechore-simulation/App-housechore-simulation.php");
