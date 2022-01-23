<?php
$dir = get_theme_file_path() . '/App/Develop/Setups/';
$filelist = glob($dir . '*.php');
foreach ($filelist as $filepath) {
  $pieces = explode('/', $filepath);
  $count = count($pieces) - 1;
  if (
    strpos($filepath, '-copy') !== false ||
    $pieces[$count] == 'Dashboard.php'
  ) {
    continue;
  }
  include_once $filepath;
}