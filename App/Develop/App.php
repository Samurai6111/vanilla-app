<?php

/*--------------------------------------------------
/* ファイルをインクルード
/*------------------------------------------------*/
$dir = dirname(__FILE__) . '/';
$file_list = glob($dir . '*.php');
foreach ($file_list as $file_path) {
  if (basename($file_path) == basename(__FILE__)) {
    continue;
  }
  include $file_path;
}