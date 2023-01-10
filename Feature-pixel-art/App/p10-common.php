<?php

use Carbon\Carbon;

/**
 * 最初の日付を取得する関数
 *
 * @return $start_date
 */
function get_pixel_art_start_date() {
	$today = new Carbon('today');
	$start_date = $today->copy()->startOfYear()->subYears(15);

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
	$format = "M d H:i:10 Y +0900";
	$date_formatted = $date->copy()->format($format);

	return $date_formatted;
}
