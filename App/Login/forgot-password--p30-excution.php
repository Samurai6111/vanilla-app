<?php

	if ('POST' === $_SERVER['REQUEST_METHOD']){
		$nonce = isset($_POST['forgot_password_form_nonce_field']) ? $_POST['forgot_password_form_nonce_field'] : null;
		$is_verified = $nonce && wp_verify_nonce($nonce, 'forgot_password_form_nonce_action');

		if ($is_verified) {
			$s_POST = vanilla_sanitize_array($_POST);
			$validations = Vanilla_Form_Validation::forgot_password($s_POST);

			if (empty($validations)) {
				$mail = Vanilla_User_Action::forgot_password($s_POST);

				//--------------------------------------------------
				// メール送信
				//--------------------------------------------------
				$wp_mail = wp_mail(
					$mail['to'],
					$mail['subject'],
					$mail['message'],
					$mail['headers'],
				);

				if ($wp_mail) {
					wp_safe_redirect( home_url('/forgot-password/?form-action=sent') );
					exit;
				}

			}

		} else {
			echo '予期せぬエラーが発生しました。';
			exit;
		}
	}
