<?php

/**
 * ユーザーの情報を出力するクラス
 *
 * @param $user ユーザーの情報
 * @param $filed ユーザーの情報を参照するフィールド(id, email, user_login, slug)
 */
class Vanilla_User
{
	public function __construct($user, $filed = 'id')
	{
		global $user_payment_plan_array;
		// ---------- wp usersの情報 ----------
		$user_info_array = get_user_by($filed, $user);
		$user_id = $user_info_array->ID;
		$this->user_id = $user_id;
		$this->user_email = $user_info_array->user_email;
		$this->user_displayName = $user_info_array->display_name;
		$this->user_login = $user_info_array->user_login;

		// ---------- メタ情報 ----------
		$this->user_lastName = get_user_meta($user_id, "user_lastName", true);
	}
}