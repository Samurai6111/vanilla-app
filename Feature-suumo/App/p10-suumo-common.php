<?php


//*--------------------------------------------------
/* Suumo関連共通の変数と関数
/*------------------------------------------------*/
//*--------------------------------------------------
/* 変数
/*------------------------------------------------*/
global $wpdb;
$suumo_table_name = $wpdb->prefix . 'suumo';
$suumo_xpath_array = [
	'suumo_surroundings' => [
		'rent' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[2]/div/div[2]/div/div[1]/div/div[1]',
		'management_fee' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[2]/div/div[2]/div/div[1]/div/div[2]/div/div[2]',
		'deposit' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[2]/div/div[2]/div/div[2]/ul/li[1]/div/div[2]/span[1]',
		'retainer_fee' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[2]/div/div[2]/div/div[2]/ul/li[1]/div/div[2]/span[3]',
		'room_arragement' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[3]/div[1]/div/div[2]/ul/li[1]/div/div[2]',
		'initial_fee' => 1,
		'construction' => 1,
		'address' => '//*[@id="js-view_gallery"]/div[1]/div[2]/div[3]/div[2]/div[2]/div/div[2]/div',
	],
];


//*--------------------------------------------------
/* 関数
/*------------------------------------------------*/

function vanilla_format_yen_to_int($str) {

	$str = str_replace("円", "", $str);
	$str = str_replace("¥", "", $str);
	$str = str_replace(",", "", $str);

	if (strpos($str, '万') !== false) {
		$number = (int)str_replace('万', "", $str);
		$number = $number * 10000;
	} elseif (strpos($str, '千') !== false) {
		$number = (int)str_replace('千', "", $str);
		$number = $number * 1000;
	} else {
		$number = (int)$str;
	}

	return $number;
}


function vanilla_get_approximate_initial_fee(
	$rent,
	$management_fee,
	$deposit,
	$retainer_fee
) {


	// ---------- 計算式 ----------
	// 家賃
	// ＋管理費
	// ＋敷金
	// ＋礼金
	// ＋前家賃
	// ＋前管理費
	// ＋仲介手数料（家賃＊１.１）
	// ＋保証会社（家賃＊１）

	$initial_fee =
		$rent +
		$management_fee +
		$deposit +
		$retainer_fee +
		$rent * 1.1 +
		$rent;

	return $initial_fee;
}

/**
* データベース内に同じURLが存在するか
*
* @param $suumo_url
*/
function vanilla_suumo_url_exists($suumo_url) {
	global $wpdb, $suumo_table_name;

	$result = $wpdb->get_row(
		"SELECT * FROM $suumo_table_name
		WHERE link = '" . $suumo_url . "'"
	);

	if ($result) {
		return true;
	} else {
		return false;
	}
}

/**
* １行で処理の内容を記述
*
* @param $address = 住所 or 場所の名前
* @param $zoom = サイズ
*/
function vanilla_get_googlemap_url($address){
  $address = urlencode($address);
  $zoom = 15;
  return "http://maps.google.co.jp/maps?q={$address}&z={$zoom}";
}
