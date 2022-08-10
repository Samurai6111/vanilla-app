<?php

// use Carbon\Carbon;
/*--------------------------------------------------
/* 開発側の全共通の関数を定義するファイル
/*------------------------------------------------*/
global $wpdb;


/**
 * carbonで出力した値をフォーマット化する（composerが必要）
 *
 * @param $date 日付
 * @param $format フォーマット文章
 * @return $carbon_formated_data フォーマット化された日付のデータ
 */
// function carbon_formatting($date, $format = 'Y-n-j H:i:s')
// {
// 	$weekday_jap = [
// 		'日',
// 		'月',
// 		'火',
// 		'水',
// 		'木',
// 		'金',
// 		'土',
// 	];
// 	$carbon_formatting_date = new Carbon($date);
// 	$carbon_formatting_weekday = $weekday_jap[$carbon_formatting_date->dayOfWeek];


// 	if(strpos($format,'weekday') !== false){
// 		$format = str_replace("weekday", $carbon_formatting_weekday, $format);
// 	}

// 	$carbon_formated_data = $carbon_formatting_date->copy()->format($format);
// 	return $carbon_formated_data;
// }

/**
 * 「1234567890abcdefghijklmnopqrstuvwxyz」の中からランダムな文字列を出力する関数
 *
 * @param $length 桁数
 * @return ランダムな文字列
 */
function vanilla_random($length = 16)
{
	return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
}

/**
 * 現在のURLをパラメータ付きで取得する
 *
 * @return パラメータ含む現在のURL
 */
function vanilla_get_current_link()
{
	return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * 特定のスラッグを持つ投稿がデータベース上に存在する場合の関数
 *
 * @param $post_name 投稿スラッグ
 * @return boolean
 */
function vanilla_the_slug_exists($post_name)
{
	global $wpdb;
	if ($wpdb->get_row(
		"SELECT post_name FROM wp_posts
        WHERE post_name = '" . $post_name . "'",
		'ARRAY_A'
	)) {
		return true;
	} else {
		return false;
	}
}

/**
 * ユーザーが存在するかどうが調べる関数
 *
 * @param $filed ユーザーの情報を参照するフィールド(id, email, user_login, slug)
 * @param $user ユーザーの情報
 * @return boolean
 */
function vanilla_user_exists($field, $user)
{
	global $wpdb;
	$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE $field =  %s", $user));
	if ($count == 1) {
		return true;
	} else {
		return false;
	}
}

/**
 * リダイレクト関数がheaderの下でも動くように
 */
add_action('init', 'vanilla_do_output_buffer');
function vanilla_do_output_buffer()
{
	ob_start();
}

/**
 * 投稿を消すリンクを出力
 *
 * @param $post_id 投稿id
 */
function vanilla_delete_post_link($post_id)
{
	$post = get_post($post_id);
	$post_type = get_post_type($post_id);
	$delete_link = wp_nonce_url(admin_url() . "post.php", "post=" . $post_id . "&action=delete");
	return $delete_link;
}

/**
 * 開発者用の条件分岐関数
 * wp_optionsのadmin_emailでログインしていた場合にtrueを返す
 */
function is_developer()
{
	$login_email = get_option('admin_email');
	$user_id = get_current_user_id();
	$user_info_array = get_user_by('id', $user_id);
	$user_login = $user_info_array->user_email;

	if ($user_login == $login_email) {
		return true;
	} else {
		return false;
	}
}


/**
 * ローカル環境の条件分岐
 */
function is_local($whitelist = ['127.0.0.1', '::1'])
{
	return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

/**
 * 検証用関数
 *
 * @param $var_dump dumpしたい値
 */
function ovd($var_dump)
{
	ob_start();
	var_dump($var_dump);
	$dump = ob_get_contents();
	ob_end_clean();
	file_put_contents(get_template_directory() . '/dump.php', $dump, FILE_APPEND);
}

/**
 * 数字にコンマをつける
 *
 * @param $num 数字
 */
function num($number) {

	if (is_int($number)) {
		$return = number_format($number);

		return $return;
	}
}

/**
 * ページ送りの$pagedを出力する関数
 *
 * @param $
 */
function vanilla_paged()
{
	// ---------- ページネーション ----------
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	return $paged;
}


/**
 * 配列のサニタイズ
 *
 * @param $request $_POSTや＄_GET
 */
function vanilla_sanitize_array($request)
{
  $sanitized = [];
	foreach ($request as $request_key => $request_value) {

		if (!is_array($request_value)) {
			$sanitized[$request_key] = htmlspecialchars($request_value, ENT_QUOTES, 'UTF-8');

		} else {
			$request_child = $request_value;

			foreach ($request_child as $request_child_key => $request_child_value) {
				if (!is_array($request_child_value)) {

					$sanitized[$request_key][$request_child_key] = htmlspecialchars($request_child_value, ENT_QUOTES, 'UTF-8');
				} else {

					$request_grandChild = $request_child_value;
					foreach ($request_grandChild as $request_grandChild_key => $request_grandChild_value) {
						$sanitized[$request_key][$request_child_key][$request_grandChild_key] = htmlspecialchars($request_grandChild_value, ENT_QUOTES, 'UTF-8');
					}
				}
			}
		}
	}

	return $sanitized;
}

/**
 * 一つの値のサニタイズ
 *
 * @param $request
 */
function vanilla_sanitize($request) {
	$sanitized = htmlspecialchars($request, ENT_QUOTES, 'UTF-8');
  return $sanitized;
}

/**
 * カラーコードのhexからrgbに変換し、配列で値を返す
 *
 * @param $hex カラーコード
 */
function vanilla_hex_to_rgb($hex, $format = ',')
{
	$hex      = str_replace('#', '', $hex);
	$length   = strlen($hex);
	$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
	$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
	$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
	if ($format === 'array') {
		$rtn = $rgb;
	} else {
		$rtn = $rgb['r'] . $format . $rgb['g'] . $format . $rgb['b'];
	}

	return $rtn;
}

//--------------------------------------------------
// form系の関数
//--------------------------------------------------
/**
 * ＄＿POSTの中身をサニタイズ
 *
 * @param $
 */
function s_POST($key) {
	$s_POST = vanilla_sanitize_array($_POST);
	if (isset($s_POST[$key]) || array_key_exists($key, $s_POST)) {
		return $s_POST[$key];
	} else {
		return false;
	}
}


/**
 * ＄＿GETの中身をサニタイズ
 *
 * @param $
 */
function s_GET($key) {
	$s_GET = vanilla_sanitize_array($_GET);
	if (isset($s_GET[$key])) {
		return $s_GET[$key];
	} else {
		return false;
	}
}

/**
 * ＄＿FILESの中身をサニタイズ
 *
 * @param $
 */
function s_FILES($key1, $key2) {
	if (!empty($_FILES)) {
		$s_FILES = vanilla_sanitize_array($_FILES[$key1]);

		if (isset($s_FILES[$key2])) {
			return $s_FILES[$key2];
		} else {
			return false;
		}
	}
}


/**
 * 特定のテーブルのデータの行数を取得する
 *
 * @param $table_name prefixを除いたテーブルの名前
 */
function vanilla_db_table_rows($table_name) {
	global $wpdb;
	$table_name = $wpdb->prefix . $table_name;
	$count_query = "select count(*) from $table_name";
	$num = $wpdb->get_var($count_query);
	return $num;
}

/**
 * メディアライブラリのスラッグからサムネイルIDを取得する関数
 *
 * @param $slug メディア投稿のスラッグ（多くの場合はファイル名になる）
 * @return サムネイルのID
 */
function vanilla_get_attachment_post_id($slug) {
	$thumbnail_args = [
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'posts_per_page' => 1,
		'name' => $slug,
	];
	$thumbnail_id = get_posts($thumbnail_args)[0]->ID;

	return $thumbnail_id;
}
