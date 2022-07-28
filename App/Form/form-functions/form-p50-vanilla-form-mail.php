<?php

class Vanilla_Form_Mail {

	function __construct() {
		global $domain_email;
		$this->headers[] = 'From: ' . get_option('blogname') . ' <' . $domain_email . '>';
		$this->form_submission_key_array = [
			'company_name' => '会社名',
			'family_name' => 'お名前',
		];
	}


	/**
	 * クライアント宛のメールの件名
	 */
	function register_email_subject_to_client() {
		global $ef__branch_variable_array;

		$email_subject = $ef__branch_variable_array[s_GET('type')]['email_subject'];
		return $email_subject;
	}


	/**
	 * ユーザー宛のメールの件名
	 */
	function register_email_subject_to_user() {
		global $ef__branch_variable_array;

		$email_subject = '【奉優会｜採用サイト】'
			. $ef__branch_variable_array[s_GET('type')]['email_subject'];

		return $email_subject;
	}


	/**
	 * フォームから送信された内容をメール文の形にフォーマットする
	 *
	 * @param $_POST のフォームの送信内容
	 */
	function format_form_submittion($submitted_array) {
		global $form_submission_key_array;


		foreach ($form_submission_key_array as $form_submittion_key => $form_submition_value_array) {
			//--------------------------------------------------
			// $submitted_array[$form_submittion_key]が存在する場合
			// 言い換えると$_POSTの値をそのまま使用する場合
			//--------------------------------------------------
			if (isset($submitted_array[$form_submittion_key])) {
				$form_submition_value = $submitted_array[$form_submittion_key];
			}
			//--------------------------------------------------
			// $_POSTの値を加工する必要があるもの
			//--------------------------------------------------
			else {
				// ---------- 氏名 ----------
				if ($form_submittion_key === 'full_name') {
					$form_submition_value =
						vanilla_array($submitted_array, 'last_name') .
						vanilla_array($submitted_array, 'first_name');
				}
			}

			if ($form_submition_value) {
				$form_submition_value_array['value'] = $form_submition_value;
				$format_submittion_array[$form_submittion_key] = $form_submition_value_array;
			}
		}

		return $format_submittion_array;
	}


	/**
	 * フォームの送信内容を取得する
	 */
	private function email_submitted_contents($array) {
		$wrap = "=========================================\n";

		$submitted_contents = $wrap;

		foreach ($array as $key => $value) {
			if (!isset($value['value'])) {
				continue;
			} else {
				$ef__variable_ja = $value['name'];
				$ef__variable_value = $value['value'];
				$submitted_content = $ef__variable_ja
					. ' : '
					. $ef__variable_value
					. "\n";

				$submitted_contents .= $submitted_content;
			}
		}

		$submitted_contents .= $wrap;

		return $submitted_contents;
	}


	/**
	 * メールの本文（管理者宛）
	 *
	 * @param $submitted_array $_POSTの中身
	 */
	function register_email_message_to_client($submitted_array) {
		global $email_signature;
		$email_message_head
			= "HPからお問い合わせがありました\n"
			. "\n";

		$email_message_body =
			"以下お客様のご入力内容です。\n"
			. "\n"
			. $this->email_submitted_contents($submitted_array)
			. "\n";

		$email_message_footer
			= "\n"
			. $email_signature
			. "\n";

		$email_message
			= $email_message_head
			. $email_message_body
			. $email_message_footer;

		return $email_message;
	}


	/**
	 * メールの本文（ユーザー宛）
	 *
	 * @param $submitted_array $_POSTの中身
	 */
	function register_email_message_to_user($submitted_array) {
		global $email_signature;
		$email_message_head
			= "お問い合わせいただきありがとうございました。\n"
			. "\n";

		$email_message_body =
			"以下お客様のご入力内容です。\n"
			. "\n"
			. $this->email_submitted_contents($submitted_array)
			. "\n";

		$email_message_footer
			= "担当のものから3営業日以内にお返事いたします。 \n"
			. "\n"
			. $email_signature
			. "\n";

		$email_message
			= $email_message_head
			. $email_message_body
			. $email_message_footer;

		return $email_message;
	}

	/**
	 * メールを送る関数
	 *
	 */
	function send_mail($to, $subject, $message, $headers, $attachments) {
		$wp_mail = wp_mail(
			$to,
			$subject,
			$message,
			$headers,
			$attachments,
		);

		return $wp_mail;
	}
}
