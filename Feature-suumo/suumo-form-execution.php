<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$s_POST = vanilla_sanitize_array($_POST);
	$Suumo_Validation = new Suumo_Validation();
	$Suumo_Form = new Suumo_Form();


	/*--------------------------------------------------
	/* suumo tableの処理
	/*------------------------------------------------*/
	// ---------- suumo data削除の処理 ----------
	if ($Suumo_Validation->is_suumo_nonce_verified('suumo_table')) {
		if ($s_POST['suumo_table_form_action'] === 'update') {
			$result = $Suumo_Form->update_table_meta($s_POST);
		}
		elseif ($s_POST['suumo_table_form_action'] === 'delete') {
			$result = $Suumo_Form->delete_suumo_data($s_POST);
		}
		elseif ($s_POST['suumo_table_form_action'] === 'favorite') {
			$result = $Suumo_Form->update_favorite($s_POST);
		}


		// $result = $Suumo_Form->delete_suumo_data($s_POST);
	}

	/*--------------------------------------------------
	/* suumo formの処理
	/*------------------------------------------------*/
	// ---------- suumo dataの挿入の処理 ----------
	if ($Suumo_Validation->is_suumo_nonce_verified('insert_suumo_data')) {
		$insert_suumo_data_validation = $Suumo_Validation->insert_suumo_data($s_POST);

		if (empty($insert_suumo_data_validation)) {
			$result = $Suumo_Form->insert_suumo_data($s_POST['suumo_url']);
			$param = 'suumo-data-inserted';
		} else {
			$result = false;
			$param = 'insert-fail';
		}
	}

	// ---------- suumo dataの挿入のキャンセル ----------
	if ($Suumo_Validation->is_suumo_nonce_verified('insert_suumo_data_cancel')) {
		$insert_suumo_data_validation = [];
		$result = true;
	}

	if ($result) {
		$param = ($param) ? "?param=" . $param : '';
		wp_safe_redirect(home_url('/suumo/' . $param));
		exit;
	}

}
