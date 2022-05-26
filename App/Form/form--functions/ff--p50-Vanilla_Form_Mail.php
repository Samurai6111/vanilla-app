<?php

class Vanilla_Form_Mail {

	function __construct() {
		global $domain_email;
		$this->headers[] = 'From: ' . get_option('blogname') . ' <' . $domain_email . '>';
	}


	/**
	 * クライアント宛のメールの件名
	 */
	function ef__email_subject_to_client() {
		global $ef__branch_variable_array;

		$email_subject = $ef__branch_variable_array[s_GET('type')]['email_subject'];
		return $email_subject;
	}


	/**
	 * ユーザー宛のメールの件名
	 */
	function ef__email_subject_to_user() {
		global $ef__branch_variable_array;

		$email_subject = '【奉優会｜採用サイト】'
			. $ef__branch_variable_array[s_GET('type')]['email_subject'];

		return $email_subject;
	}


	/**
	 * 「きっかけ」の文字列を作成
	 */
	function ef__get_submitted_opportunities() {
		$ef__opportunities = s_POST('ef__opportunities');
		$opportunity_outputs = "";
		if (!empty($ef__opportunities)) {
			$i = 0;
			foreach ($ef__opportunities as $key => $ef__opportunity) {
				if ($ef__opportunity[0]) {
					++$i;
					if ($i === 1) {
						$opportunity_output = $ef__opportunity[0];
					} else {
						$opportunity_output = "、" . $ef__opportunity[0];
					}
				} else {
					$opportunity_output = '';
				}
				$opportunity_outputs .= $opportunity_output;
			}
		}
		return $opportunity_outputs;
	}


	/**
	 * フォームから送信された内容をメール文の形にフォーマットする
	 *
	 * @param $_POST のフォームの送信内容
	 */
	function ef__format_submittion($submitted_array) {
		global $ef__mail_key_array;

		$format_submittion_array = $ef__mail_key_array;

		foreach ($format_submittion_array as $ef__mail_key => $ef__mail_value_array) {

			if (
				isset($submitted_array[$ef__mail_key])
				&& $ef__mail_key !== 'ef__opportunities'
			) {
				$ef__mail_value = $submitted_array[$ef__mail_key];
			} else {
				// ---------- 氏名 ----------
				if ($ef__mail_key === 'ef__full_name') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__last_name') . vanilla_array($submitted_array, 'ef__first_name');
				}
				// ---------- カナ ----------
				elseif ($ef__mail_key === 'ef__full_name_kana') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__last_name_kana') . vanilla_array($submitted_array, 'ef__first_name_kana');
				}
				// ---------- 学部・学科 ----------
				elseif ($ef__mail_key === 'ef__full_department') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__school_of') . vanilla_array($submitted_array, 'ef__department');
				}
				// ---------- 卒業年月日 ----------
				elseif ($ef__mail_key === 'ef__graduation_ym') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__graduation_year') . vanilla_array($submitted_array, 'ef__graduation_month');
				}
				// ---------- 住所 ----------
				elseif ($ef__mail_key === 'ef__full_address') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__prefecture') . vanilla_array($submitted_array, 'ef__town');
				}
				// ---------- 生年月日 ----------
				elseif ($ef__mail_key === 'ef__dob') {
					$ef__mail_value = vanilla_array($submitted_array, 'ef__dob_year') . vanilla_array($submitted_array, 'ef__dob_month') . vanilla_array($submitted_array, 'ef__dob_date');
				}
				// ---------- サイト訪問のきっかけ ----------
				elseif ($ef__mail_key === 'ef__opportunities') {
					$ef__mail_value = $this->ef__get_submitted_opportunities();
				} else {
					$ef__mail_value = '';
				}
				// // ---------- 氏名 ----------
				// if ($ef__mail_key === 'ef__full_name') {
				// 	$ef__mail_value = $submitted_array['ef__last_name'] . $submitted_array['ef__first_name'];
				// }
				// // ---------- カナ ----------
				// elseif ($ef__mail_key === 'ef__full_name_kana') {
				// 	$ef__mail_value = $submitted_array['ef__last_name_kana'] . $submitted_array['ef__first_name_kana'];
				// }
				// // ---------- 学部・学科 ----------
				// elseif ($ef__mail_key === 'ef__full_department') {
				// 	$ef__mail_value = $submitted_array['ef__school_of'] . $submitted_array['ef__department'];
				// }
				// // ---------- 卒業年月日 ----------
				// elseif ($ef__mail_key === 'ef__graduation_ym') {
				// 	$ef__mail_value = $submitted_array['ef__graduation_year'] . $submitted_array['ef__graduation_month'];
				// }
				// // ---------- 住所 ----------
				// elseif ($ef__mail_key === 'ef__full_address') {
				// 	$ef__mail_value = $submitted_array['ef__prefecture'] . $submitted_array['ef__town'];
				// }
				// // ---------- 生年月日 ----------
				// elseif ($ef__mail_key === 'ef__dob') {
				// 	$ef__mail_value = $submitted_array['ef__dob_year'] . $submitted_array['ef__dob_month'] . $submitted_array['ef__dob_date'];
				// }
				// // ---------- サイト訪問のきっかけ ----------
				// elseif ($ef__mail_key === 'ef__opportunities') {
				// 	$ef__mail_value = $this->ef__get_submitted_opportunities();
				// }
				// else {
				// 	$ef__mail_value = '';
				// }
			}

			if ($ef__mail_value) {
				$ef__mail_value_array['value'] = $ef__mail_value;
				$format_submittion_array[$ef__mail_key] = $ef__mail_value_array;
			}
		}

		return $format_submittion_array;
	}


	/**
	 * フォームの送信内容を取得する
	 */
	private function ef__get_email_submitted_contents($array) {
		global $ef__input_key_array;
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

			// if (isset($ef__input_key_array[$key])) {
			// 	$ef__variable_ja = $value['name'];
			// 	$submitted_content = $ef__variable_ja
			// 		. ' : '
			// 		. $value['value']
			// 		. "\n";

			// 	$submitted_contents .= $submitted_content;
			// }
		}

		$submitted_contents .= $wrap;

		return $submitted_contents;
	}


	/**
	 * メールの本文（管理者宛）
	 *
	 * @param $submitted_array $_POSTの中身
	 */
	function ef__email_message_to_client($submitted_array) {
		global $email_signature;
		$email_message_head
			= "HPからお問い合わせがありました\n"
			. "\n";

		$email_message_body =
			"以下お客様のご入力内容です。\n"
			. "\n"
			. $this->ef__get_email_submitted_contents($submitted_array)
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
	function ef__email_message_to_user($submitted_array) {
		global $email_signature;
		$email_message_head
			= "お問い合わせいただきありがとうございました。\n"
			. "\n";

		$email_message_body =
			"以下お客様のご入力内容です。\n"
			. "\n"
			. $this->ef__get_email_submitted_contents($submitted_array)
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
