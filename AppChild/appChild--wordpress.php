<?php

/*--------------------------------------------------
/* /AppChild/Wordpress/内のファイルを全てインクルード
/*------------------------------------------------*/
$dir = get_theme_file_path() . '/AppChild/Wordpress/';
$filelist = glob($dir . '*.php');
foreach ($filelist as $filepath) {
  $pieces = explode('/', $filepath);
  $count = count($pieces) - 1;
  if (
    strpos($filepath, '-copy') !== false
  ) {
    continue;
  }
  include $filepath;
}
