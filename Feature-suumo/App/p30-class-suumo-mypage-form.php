<?php

class Suumo_Mypage_Form {

	function __construct($data) {
		$this->data = $data;

	}

	/**
	* メタデータを保存する関数
	*
	* @param
	* @return
	*/
	function update_user_meta($key) {
		update_user_meta($this->data['user_id'], $key, $this->data[$key]);
	}


	/**
	* ユーザーの情報を保存する
	*
	* @param
	* @return
	*/
	function save_user_info() {
		Self::update_user_meta('suumo_user_google_api_key');
	}
}
