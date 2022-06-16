<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$nonce = isset($_POST['reset_password_form_nonce_field']) ? $_POST['reset_password_form_nonce_field'] : null;
	$is_verified = $nonce && wp_verify_nonce($nonce, 'reset_password_form_nonce_action');

	if ($is_verified) {
		$s_POST = vanilla_sanitize_array($_POST);
		$validations = Vanilla_Form_Validation::reset_password($s_POST);

		if (empty($validations)) {
			$results = Vanilla_User_Action::reset_password($s_POST);

			if ($results === 'success') {
				wp_safe_redirect(home_url('/reset-password/?form-action=sent'));
				exit;
			} else {
				$validations = ['エラー発生。ユーザーが存在しない可能性があります。サイト管理者に問い合わせてください、'];
			}
		}
	} else {
		echo '予期せぬエラーが発生しました。';
		exit;
	}
}
