<?php
use Carbon\Carbon;

class Vanilla_User_Action {

	function __construct() {
	}

	/**
	 * ユーザー登録する関数
	 *
	 * @param $user_register_data_array サニタイズされた$_POSTの中身
	 */
	function insert_user($user_register_data_array) {
		//--------------------------------------------------
		// ログインしている時
		//--------------------------------------------------
		if (!is_user_logged_in()) {
			$unique_id = vanilla_db_table_rows('users') + 1;
			$rand = vanilla_random(6);

			$userdata = [
				'user_login'  =>  'user_' . $unique_id . '_' . $rand,
				'user_email'   =>  $user_register_data_array['user_email'],
				'user_pass'   =>  $user_register_data_array['user_password'],
				'role'   =>  'subscriber',
			];
			$user_id = wp_insert_user($userdata);
		}
		//--------------------------------------------------
		// ログインしていない時
		//--------------------------------------------------
		else {
			$user_id = get_current_user_id();
		}

		return $user_id;
	}

	/**
	 * ユーザーメタの変更・追加する関数
	 *
	 * @param $user_id 対象のユーザーID
	 * @param $user_register_data_array サニタイズされた$_POSTの中身
	 */
	function update_meta($user_id, $user_register_data_array) {
		foreach ($user_register_data_array as $register_key => $register_value) {
			if (strpos($register_key, 'usermeta') !== false) {
				update_user_meta($user_id, $register_key, $register_value);
			}
		}
	}

	/**
	* ユーザーをログインさせる関数
	*
	* @param $s_POST サニタイズされた$_POST
	*/
	function user_login($s_POST) {
		$credentials = [
			'user_login' => $s_POST['login_email'],
			'user_password' => $s_POST['login_password'],
			'remember' => true
		];
		$user = wp_signon($credentials, false);

		if (is_wp_error($user)) {
			return $user->get_error_message();
		} else {
			return 'success';
		}
		// wp_signon( $credentials:array, $secure_cookie:string|boolean )

	}

	/**
	* パスワードを忘れた時の処理
	*
	* @param $s_POST サニタイズされた$_POST
	*/
	static function forgot_password($s_POST) {
		$user_email = $s_POST['forgot_password_email'];
		$user = get_user_by('email', $user_email);
		$user_id = $user->ID;

		//--------------------------------------------------
		// メタ情報追加
		//--------------------------------------------------
		$password_reset_key = vanilla_random();
		$now = Carbon::now()->format('Y-m-d H:i:s');
		update_user_meta($user_id, 'password_reset_time', $now);
		update_user_meta($user_id, 'password_reset_key', $password_reset_key);

		//--------------------------------------------------
		// メール文章作成
		//--------------------------------------------------
		global $domain_email;
		$sitle_title = get_option('blogname');
		$reset_password_link = home_url('/reset-password/?user-id=' . $user_id . '&password-reset-key=' . $password_reset_key);

		$subject = '【' . $sitle_title . '】パスワードリセット';
		$headers = ['From: ' . $sitle_title . ' <' . $domain_email . '>'];
		$message =
		"どなたかが次のアカウントのパスワードリセットをリクエストしました: \n\r"
		. "サイト名: " . $sitle_title . "\n\r"
		. "ユーザーメールアドレス: " . $user_email . "\n\r"
		. "もしこれが間違いだった場合は、このメールを無視すれば何も起こりません。 \n\r"
		. "パスワードをリセットするには、以下へアクセスしてください。（リンクは発行後30分で無効になります） \n\r"
		. $reset_password_link;

		$return = [
			'to' => $user_email,
			'subject' => $subject,
			'message' => $message,
			'headers' => $headers,
			'attachments' => '',
		];

		return $return;
	}


	/**
	* パスワードリセットの処理
	*
	* @param $s_POST サニタイズされた$_POST
	*/
	static function reset_password($s_POST) {

		$user_id = wp_update_user([
			'ID' => $s_POST['user_id'],
			'user_pass' => $s_POST['reset_password'],
		]);

		if (is_wp_error($user_id)) {
			return $user_id->get_error_message();
		} else {

			//--------------------------------------------------
			// メタデータの削除
			//--------------------------------------------------
			update_user_meta($user_id, 'password_reset_time', 'invalid');
			update_user_meta($user_id, 'password_reset_key', 'invalid');

			return 'success';
		}
	}
}
