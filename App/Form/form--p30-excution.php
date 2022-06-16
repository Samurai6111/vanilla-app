<?php

$nonce = isset($_POST['ef__nonce_field']) ? $_POST['ef__nonce_field'] : null;
$is_verified = $nonce && wp_verify_nonce($nonce, 'ef__nonce_action');

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$s_POST = vanilla_sanitize_array($_POST);

	if ($is_verified) {
		$Vanilla_Form = new Vanilla_Form();
		//--------------------------------------------------
		// 確認ページ
		//--------------------------------------------------
		if (s_GET('form-action') === 'confirm') {
			// ---------- 添付ファイルをメディアアップロード ----------
			if (!isset($_POST['ef__file_name'])) {
				$attachment__id = $Vanilla_Form->media_upload('ef__file_cv');
				$attachment__link = get_attached_file($attachment__id);
			}

			// ---------- 添付ファイルの情報を$_POSTに格納 ----------
			if (!isset($_POST['ef__file_link']) || s_FILES('ef__file_cv', 'name')) {
				$_POST['ef__file_id'] = $attachment__id;
				$_POST['ef__file_link'] = $attachment__link;
				$_POST['ef__file_name'] = s_FILES('ef__file_cv', 'name');
			}
		}

		//--------------------------------------------------
		// フォームの送信時の処理
		//--------------------------------------------------
		elseif (s_GET('form-action') === 'send') {

			// ---------- ファイル添付があった場合 ----------
			$attachment__link = s_POST('ef__file_link');
			$attachments = ($attachment__link) ? [$attachment__link] : [];

			// ---------- メール送信 ----------
			$Vanilla_Form_Mail = new Vanilla_Form_Mail();
			$ef_formated_submittion = $Vanilla_Form_Mail->ef__format_submittion($s_POST);

			//--------------------------------------------------
			// クライアント宛(管理者宛)にメール送信
			//--------------------------------------------------
			$is_client_email_sent = $Vanilla_Form_Mail->send_mail(
				$client_email,
				$Vanilla_Form_Mail->register_email_subject_to_client(),
				$Vanilla_Form_Mail->register_email_message_to_client($ef_formated_submittion),
				$Vanilla_Form_Mail->headers,
				$attachments
			);

			//--------------------------------------------------
			// ユーザー宛にメールを送信
			//--------------------------------------------------
			$is_user_email_sent = $Vanilla_Form_Mail->send_mail(
				s_POST('register_email'),
				$Vanilla_Form_Mail->register_email_subject_to_user(),
				$Vanilla_Form_Mail->register_email_message_to_user($ef_formated_submittion),
				$Vanilla_Form_Mail->headers,
				$attachments
			);

			// ---------- 送信が成功したらサンクスページにリダイレクト ----------
			if ($is_client_email_sent) {
				wp_safe_redirect(home_url('/thanks/'));
				exit;
			}
		}
	} else {
		echo '予期せぬエラーが発生しました。';
		exit;
	}
}
