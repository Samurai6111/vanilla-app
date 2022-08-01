<?php

class Vanilla_Form_Mail {

	function __construct() {
		global $domain_email;
		$this->headers[] = 'From: ' . get_option('blogname') . ' <' . $domain_email . '>';
		$this->form_submittion_key_array = [
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
	* フォームの送信内容を取得する
	*
	* @param array $form_submitted_values post送信の中身($_POST)
	* @param array $form_key_jap_array post送信のキーと日本語訳の配列
	*/
	static function get_form_values_to_string($form_submitted_values, $form_key_jap_array) {
		$wrap = "=========================================\n";

		$submitted_contents = $wrap;

		foreach ($form_submitted_values as $key => $value) {
			if (!isset($form_key_jap_array[$key])) {
				continue;
			} else {
				$jap_label = $form_key_jap_array[$key];
				$submitted_content =
					$jap_label
					. ' : '
					. $value
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
	function email_message_to_client($email_submitted_contents) {
		global $email_signature;
		$email_message_head
			= "HPからお問い合わせがありました\n"
			. "\n";

		$email_message_body =
			"以下お客様のご入力内容です。\n"
			. "\n"
			. $email_submitted_contents
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
	 * メールを送る関数
	 *
	 */
	function send_mail($to, $subject, $message, $headers, $attachments) {
		$wp_mail = wp_mail(
			$to,
			$subject,
			$message,
			$headers,
			$attachments
		);

		return $wp_mail;
	}
}
