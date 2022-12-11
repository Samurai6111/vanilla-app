<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$s_POST = vanilla_sanitize_array($_POST);
	$Suumo_Validation = new Suumo_Validation();


	/*--------------------------------------------------
	/* suumo tableの処理
	/*------------------------------------------------*/
	// ---------- ユーザー基本情報 ----------
	if ($Suumo_Validation->is_suumo_nonce_verified('suumo_mypage_user_info')) {
		$Suumo_Mypage_Form = new Suumo_Mypage_Form($s_POST);
		$Suumo_Mypage_Form->save_user_info();
		$result = true;
	}

	// ---------- テーブルカスタマイズ ----------
	if ($Suumo_Validation->is_suumo_nonce_verified('suumo_table_customize')) {

		$Suumo_Mypage_Form = new Suumo_Mypage_Form($s_POST);
		$Suumo_Mypage_Form->table_customize();
		$result = true;
		$param = "tab-target=tab2";

	}


	if ($result) {
		$param = ($param) ? '?' . $param : '';
		wp_safe_redirect(home_url('/suumo/mypage/' . $param));
		exit;
	}

}
