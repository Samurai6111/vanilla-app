<?php

/*--------------------------------------------------
/* 同階層のファイルを全てインクルード
/*------------------------------------------------*/
$current_directory = dirname(__FILE__) . '/App/';
$file_list = glob($current_directory . '*.php');
foreach ($file_list as $file_path) {
	if (basename($file_path) === basename(__FILE__)) {
		continue;
	}
	require_once $file_path;
}
