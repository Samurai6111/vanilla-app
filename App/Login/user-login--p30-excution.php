<?php

	if ('POST' === $_SERVER['REQUEST_METHOD']){
		$nonce = isset($_POST['user_login_form_nonce_field']) ? $_POST['user_login_form_nonce_field'] : null;
		$is_verified = $nonce && wp_verify_nonce($nonce, 'user_login_form_nonce_action');

		if ($is_verified) {
			$s_POST = vanilla_sanitize_array($_POST);
			$Vanilla_Form_Validation = new Vanilla_Form_Validation();
			$validations = $Vanilla_Form_Validation->user_login($s_POST);

			if (empty($validations)) {
				$Vanilla_User_Action = new Vanilla_User_Action();
				$user = $Vanilla_User_Action->user_login($s_POST);

				if ($user === 'success') {
					wp_safe_redirect(home_url('/mypage/'));
					exit;
				} else {
					$validations = ['パスワードが間違っています'];
				}
			}

		} else {
			echo '予期せぬエラーが発生しました。';
			exit;
		}
	}
