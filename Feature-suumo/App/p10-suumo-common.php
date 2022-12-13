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
/**
* 日本語の文字列を数字に変換する
*
* @param $str 金額
* @return
*/
function vanilla_format_yen_to_int($str) {

	$str = str_replace("円", "", $str);
	$str = str_replace("¥", "", $str);
	$str = str_replace(",", "", $str);

	if (strpos($str, '万') !== false) {
		$number = (float)str_replace('万', "", $str);
		$number = $number * 10000;
	} elseif (strpos($str, '千') !== false) {
		$number = (float)str_replace('千', "", $str);
		$number = $number * 1000;
	} else {
		$number = (float)$str;
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
	global $wpdb, $suumo_table_name, $current_user;

	$result = $wpdb->get_row(
		"SELECT * FROM $suumo_table_name
		WHERE link = {$suumo_url}
		AND user_id = {$current_user->ID}
		"
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
function vanilla_get_googlemap_url($address) {
	$address = urlencode($address);
	$zoom = 15;
	return "http://maps.google.co.jp/maps?q={$address}&z={$zoom}";
}


function test($url) {
	require_once(get_theme_file_path() . "/Feature-suumo/Library/phpQuery-onefile.php");


	$html = file_get_contents($url);
	$html_document = phpQuery::newDocument($html);
	$suumo_selectors = [
		'images' => '#js-view_gallery-navlist > li > a.property_view_thumbnail > img.property_view_thumbnail-img',
		'rent' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-main > div > div.property_view_main-emphasis',
		'management_fee' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-main > div > div.property_view_main-data > div > div.property_data-body',
		'deposit' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-sub > ul > li:nth-child(1) > div > div.property_data-body > span:nth-child(1)',
		'retainer_fee' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-sub > ul > li:nth-child(1) > div > div.property_data-body > span:nth-child(3)',
		'room_arragement' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(3) > div.l-property_view_detail-main > div > div.property_view_detail-body > ul > li:nth-child(1) > div > div.property_data-body',
		'initial_fee' => 1,
		'construction' => "#contents > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(4)",
		'address' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(3) > div.l-property_view_detail-sub > div:nth-child(2) > div > div.property_view_detail-body > div',
	];

	foreach ($suumo_selectors as $key => $suumo_selector) {

		$suumo_dom = $html_document->find($suumo_selector);
		// if (!is_array($suumo_dom)) {
		// 	echo vanilla_format_yen_to_int($suumo_dom->text());
		// }
		if ($key === 'images') {
			$img_src_array = [];
			for ($i = 0; $i < count($suumo_dom); $i++) {
				$img_src = $html_document->find("{$suumo_selector}:eq({$i})")->attr("data-src");
				$img_src_array[] = $img_src;
			}
			$suumo_data = json_encode($img_src_array, JSON_UNESCAPED_UNICODE);
		} elseif (
			$key === 'rent' ||
			$key === 'management_fee' ||
			$key === 'deposit' ||
			$key === 'retainer_fee'
		) {
			$suumo_data = vanilla_format_yen_to_int($suumo_dom->text());
		} else {
			$suumo_data = ($suumo_dom->text()) ? sanitize_text_field($suumo_dom->text()) : '-';
		}

		$suumo_data_array[$key] = $suumo_data;

		// ---------- 初期費用だけ最後に計算 ----------
		$initial_fee = vanilla_get_approximate_initial_fee(
			$suumo_data_array['rent'],
			$suumo_data_array['management_fee'],
			$suumo_data_array['deposit'],
			$suumo_data_array['retainer_fee']
		);
		$suumo_data_array['initial_fee'] = (int)$initial_fee;
	}
}
