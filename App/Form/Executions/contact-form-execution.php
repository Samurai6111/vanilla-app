<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$s_POST = vanilla_sanitize_array($_POST);


	if (vanilla_is_nonce_verified('contact_form')) {
		$Vanilla_Form = new Vanilla_Form();

		if (
			!s_GET('form-action') ||
			vanilla_is_nonce_verified('input')
		) {
			//--------------------------------------------------
			// バリデーション
			//--------------------------------------------------
			$Vanilla_Form_Validation = new Vanilla_Form_Validation();
			$validations = $Vanilla_Form_Validation->contact_form($s_POST);
		}
		//--------------------------------------------------
		// 確認ページ
		//--------------------------------------------------
		elseif (vanilla_is_current_form_action('confirm')) {
		}
		//--------------------------------------------------
		// フォームの送信時の処理
		//--------------------------------------------------
		elseif (vanilla_is_current_form_action('send')) {

			// ---------- メール送信 ----------
			$Vanilla_Form_Mail = new Vanilla_Form_Mail();
			$formated_submittion = $Vanilla_Form_Mail->format_form_submittion($s_POST, $form_submittion_key_array);

			//--------------------------------------------------
			// ユーザー宛にメールを送信
			//--------------------------------------------------
			$is_user_email_sent = $Vanilla_Form_Mail->send_mail(
				s_POST('email'),
				'件名 : お問合せがありがとうございます',
				$Vanilla_Form_Mail->register_email_message_to_user($formated_submittion),
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
