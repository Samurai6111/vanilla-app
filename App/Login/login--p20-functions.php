<?php
$dir = get_theme_file_path() . '/App/Login/login--functions/';
$filelist = glob($dir . '*.php');
foreach ($filelist as $filepath) {
	$pieces = explode('/', $filepath);
	$count = count($pieces) - 1;
	if (
		strpos($filepath, '-copy') !== false
	) {
		continue;
	}
	require_once $filepath;
}
