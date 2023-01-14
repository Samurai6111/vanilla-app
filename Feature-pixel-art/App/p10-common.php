<?php

use Carbon\Carbon;

/**
 * 最初の日付を取得する関数
 *
 * @return $start_date
 */
function get_pixel_art_start_date() {
	$param = vanilla_sanitize_array($_GET);
	$target_date_GET = @$param['target-date'] . "-01-01";

	if ($target_date_GET) {
		$target_date = new Carbon($target_date_GET);
		$start_date = $target_date->copy();
	} else {
		$target_date = new Carbon('today');
		$start_date = $target_date->copy()->startOfYear()->subYears(18);
	}

	return $start_date;
}




/**
 * 取得した日付をgit commandのformatに整える
 *
 * @param $date
 * @return $result
 */
function format_git_command_date($date) {
	$date = new Carbon($date);
	// "Dec 29 23:59:59 2022 +0900"
	$format = "D M d 23:59:59 Y";
	$date_formatted = $date->copy()->format($format);

	return $date_formatted;
}
