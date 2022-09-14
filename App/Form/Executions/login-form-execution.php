<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$s_POST = vanilla_sanitize_array($_POST);



	if (vanilla_is_nonce_verified('login_form')) {
		$Vanilla_Form = new Vanilla_Form();

		if (
			!s_GET('form-action') ||
			vanilla_is_nonce_verified('input')
		) {
			//--------------------------------------------------
			// バリデーション
			//--------------------------------------------------
			$Vanilla_Form_Validation = new Vanilla_Form_Validation();
			$validations = $Vanilla_Form_Validation->login_form($s_POST);
		}

		//--------------------------------------------------
		// フォームの送信時の処理
		//--------------------------------------------------
		elseif (vanilla_is_current_form_action('send')) {

			// ---------- メール送信 ----------
			$Vanilla_Form_Mail = new Vanilla_Form_Mail();
			$email_submitted_contents = $Vanilla_Form_Mail->get_form_values_to_string($s_POST, $contact_form_key_array);


			//--------------------------------------------------
			// ユーザー宛にメールを送信
			//--------------------------------------------------
			$is_user_email_sent = $Vanilla_Form_Mail->send_mail(
				s_POST('email'),
				'件名 : お問合せがありがとうございます',
				$Vanilla_Form_Mail->email_message_to_client($email_submitted_contents),
				$Vanilla_Form_Mail->headers,
				$attachments
			);

			// ---------- 送信が成功したらサンクスページにリダイレクト ----------
			if ($is_user_email_sent) {
				wp_safe_redirect(home_url('/thanks/'));
				exit;
			}
		}
	} else {
		echo '予期せぬエラーが発生しました。';
		exit;
	}
}
