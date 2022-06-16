<?php

class Vanilla_Form_Validation {

	static function echo_validation_results($validations) {

		if (
			'POST' === $_SERVER['REQUEST_METHOD'] &&
			$validations &&
			count($validations) > 0
		) { ?>
			<div class="formValidation -login">
				<ul class="formValidation__list">
					<li class="formValidation__item -error">
						入力に誤りがあります。下記の項目をご確認ください。
					</li>

					<?php foreach ($validations as $validation_key => $validation_value) { ?>
						<li class="formValidation__item -error">
							・<?= esc_html($validation_value) ?>
						</li>
					<?php } ?>
				</ul>
			</div>
<?php } else {
			return false;
		}
	}

	/**
	 * ユーザー登録・登録情報変更のバリデーション
	 *
	 * @param $key $_POSTのkey
	 */
	function user_register($array) {
		unset($array['user_register_form_nonce_field']);
		unset($array['_wp_http_referer']);

		$validations_strings = [
			'usermeta_last_name' => '名字',
			'usermeta_first_name' => '名前',
			'usermeta_dob_year' => '生年月日（年）',
			'usermeta_dob_month' => '生年月日（月）',
			'usermeta_dob_date' => '生年月日（日）',
			'usermeta_gender' => '性別',
			'user_email' => 'メールアドレス',
			'user_email_confirm' => 'メールアドレス（確認）',
			'user_password' => 'パスワード',
			'user_password_confirm' => 'パスワード（確認）',
		];

		$validations = [];

		$array_diff_key = array_diff_key($validations_strings, $array);
		$array_no_value = array_map(function($value) { return ''; }, $array_diff_key);
		$array_merged = array_merge($array, $array_no_value);

		if (!isset($array['usermeta_gender'])) {
			$array['usermeta_gender'] = '';
		}

		foreach ($array_merged as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}

			if (
				!is_user_logged_in() &&
				$array['user_email'] &&
				vanilla_user_exists('user_email', $array['user_email'])
			) {
				$validations['user_email'] = 'このメールアドレスのユーザーは既に存在しています。';
			}

			if (
				$array['user_email'] !== $array['user_email_confirm']
			) {
				$validations['user_email_confirm'] = 'メールアドレスが一致していません。';
			}

			if (
				$array['user_password'] !== $array['user_password_confirm']
			) {
				$validations['user_password_confirm'] = 'パスワードが一致していません。';
			}
		}

		return $validations;
	}

	/**
	 * ユーザーログイン
	 *
	 * @param $key $_POSTのkey
	 */
	function user_login($array) {
		$validations_strings = [
			'login_email' => 'メールアドレス',
			'login_password' => 'パスワード',
		];

		$validations = [];

		foreach ($array as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}

			if (
				$array['login_email'] &&
				!vanilla_user_exists('user_email', $array['login_email'])
			) {
				$validations['login_email'] =  $array['login_email'] . 'でご登録のユーザーは存在しません';
			}
		}

		return $validations;
	}

	/**
	 * パスワードを忘れた方へ
	 *
	 * @param $key $_POSTのkey
	 */
	static function forgot_password($array) {
		$validations_strings = [
			'forgot_password_email' => 'メールアドレス',
		];

		$validations = [];

		foreach ($array as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}

			if (
				$array['forgot_password_email'] &&
				!vanilla_user_exists('user_email', $array['forgot_password_email'])
			) {
				$validations['forgot_password_email'] =  $array['forgot_password_email'] . 'でご登録のユーザーは存在しません';
			}
		}

		return $validations;
	}

	/**
	 * リセットパスワード
	 *
	 * @param $key $_POSTのkey
	 */
	static function reset_password($array) {
		$validations_strings = [
			'reset_password' => '新しいパスワード',
		];

		$validations = [];

		foreach ($array as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}
		}

		return $validations;
	}
}
