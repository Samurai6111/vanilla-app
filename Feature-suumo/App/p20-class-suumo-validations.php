<?php

class Suumo_Validation {

	/**
	 * __construct
	 *
	 * @param $data $_POSTの配列
	 */
	function __construct() {
	}

	function is_suumo_nonce_verified($nonce_key) {
		return vanilla_is_nonce_verified($nonce_key);
	}

	/**
	 *  URLが存在するか
	 *
	 * @param $url
	 */
	function url_exists($url) {
		// Use get_headers() function
		$headers = @get_headers($url);

		// Use condition to check the existence of URL
		if ($headers && strpos($headers[0], '200')) {
			return true;
		} else {
			return false;
		}
	}

	function is_url($str) {
		if (filter_var($str, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			return false;
		}
	}



	/**
	 * suumo data挿入時のバリデーション
	 *
	 * @param $data $_POSTの値
	 */
	function insert_suumo_data($data) {
		$validations_strings = [
			'suumo_url' => '物件URL',
		];

		$validations = [];

		$data_diff_key = array_diff_key($validations_strings, $data);
		$data_no_value = array_map(function ($value) {
			return '';
		}, $data_diff_key);
		$data_merged = array_merge($data, $data_no_value);

		foreach ($data_merged as $key => $value) {
			// ---------- 空欄ではないか ----------
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			} elseif ($key === 'suumo_url') {

				// ---------- URLであるか ----------
				if (!Self::is_url($value)) {
					$validations[$key] = '入力された文字列はURLではありません';
				}
				// ---------- URLが存在するか ----------
				elseif (!Self::url_exists($value)) {
					$validations[$key] = '入力されたURLは存在しません';
				}
				// ---------- URLがデータベース上に存在するか ----------
				elseif (vanilla_suumo_url_exists($value)) {
					$validations[$key] = '入力されたURLは既に登録されています';
				}
			}
		}

		return $validations;
	}


	/**
	 * customize_tableのバリデーション
	 *
	 * @param $data $_POSTの値
	 */
	function customize_table($data) {
		$validations_strings = [
			'suumo_table_custom_lables' => 'カラム名',
			'suumo_table_custom_values' => '住所',
		];

		$validations = [];

		foreach ($data as $key => $array ) {
			if (is_array($array)) {

				foreach ($array as $i => $value) {
					if (!$value) {
						$validations[$key][$i] = $validations_strings[$key] . 'を入力してください';
					}
				}
			}
		}

		return $validations;
	}

}
