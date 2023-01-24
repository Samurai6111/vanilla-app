<?php
use Carbon\Carbon;

/**
 * スプレッドシートのインスタンス
 *
 * @param
 * @return
 */
class GoogleSheet {
	public static function instance() {

		$credentials_path =  get_theme_file_path() . "/Assets/Json/confidential.json";
		$client = new \Google_Client();
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAuthConfig($credentials_path);
		return new Google_Service_Sheets($client);
	}
}

/**
 * スプレッドシートに値を追加する関数
 *
 * @param $data
 * @return
 */
function insert_sheet_values($data) {
	$sheets = GoogleSheet::instance();
	$sheet_id =  get_option('sheet_id');
	$values = new \Google_Service_Sheets_ValueRange();
	$values->setValues([
		'values' => $data
	]);
	$params = ['valueInputOption' => 'USER_ENTERED'];
	$sheets->spreadsheets_values->append(
		$sheet_id,
		'A2',
		$values,
		$params
	);
}

/**
 * googleの検索結果を配列で取得する関数
 *
 * @param $q
 * @return $result
 */
function get_search_values($data) {
	require_once(get_theme_file_path() . "/External-library/google-search-results.php");
	require_once(get_theme_file_path() . "/External-library/restclient.php");

	$query = [
		"engine" => "google",
		"q" => $data['q'],
		"location" => "Japan",
		"google_domain" => "google.co.jp",
		"gl" => "jp",
		"hl" => "ja",
		"nfpr" => "1",
		"safe" => "active",
		"device" => $data['device'] // mobile, desktop, tablet

	];

	$serp_api_key = get_option('serp_api_key');
	$search = new GoogleSearch($serp_api_key);
	$result = $search->get_json($query);
	// $result = json_decode($json);

	$value_arrays = [];
	$value_arrays['ads'] = ($result->ads) ? $result->ads : [];
	$value_arrays['organic_results'] = ($result->organic_results) ? $result->organic_results : [];

	return $value_arrays;
}


function execute_insertion($data) {
	$now = new Carbon('now');
	$now = $now->copy()->format('Y-m-d H:i:s');
	$type_ja = [
		'ads' => '広告',
		'organic_results' => '通常',
	];
	$value_arrays = get_search_values($data);

	if (!empty($value_arrays)) {
		foreach ($value_arrays as $type => $array) {
			foreach ($array as $index => $values) {
				$data_to_insert = [
					"サイトタイトル" => $values->title,
					"サイトURL" => $values->link,
					"タイプ" => $type_ja[$type],
					"デバイス" => $data['device'],
					"検索キーワード" => $data['q'],
					"日付" => $now,
				];

				$data_to_insert = array_values($data_to_insert);
				insert_sheet_values($data_to_insert);
			}
		}

		$rtn = true;
	} else {
		$rtn = false;
	}

	return $rtn;
}

// echo '<pre>';
// var_dump(get_search_values('プログラミング'));
// echo '</pre>';
// exit;
