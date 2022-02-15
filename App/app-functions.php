<?php
// use Carbon\Carbon;



global $wpdb;

/*--------------------------------------------------
/* 開発側の全共通の関数を定義するファイルです
/*------------------------------------------------*/

/**
 * carbonで出力した値をフォーマット化する
 *
 * @param $date 日付
 * @param $hours 時間部分の指定
 */
// function carbon_formatting($date, $hours = "H:i")
// {
//   global $weekday_jap;
//   $carbon_formatting_date = new Carbon($date);
//   $carbon_formatting_weekday = $weekday_jap[$carbon_formatting_date->dayOfWeek];
//   $carbon_formated_data = $carbon_formatting_date->copy()->format("n月j日($carbon_formatting_weekday) $hours");
//   return $carbon_formated_data;
// }

/**
 * スラッグから投稿ID取得
 *
 * @param $post_name 投稿スラッグ
 */
function vanilla_slug_to_post_id($post_name)
{
  return get_page_by_path($post_name, "OBJECT", "email")->ID;
}

/**
 * ランダムな数を出力
 *
 * @param $length 桁数
 */
function vanilla_random($length = 16)
{
  return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
}

/**
 * 現在のURLをパラメータ付きで取得する
 */
function vanilla_get_current_link()
{
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * 特定のスラッグを持つ投稿がデータベース上に存在する場合の関数
 *
 * @param $post_name 投稿スラッグ
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
 */
function vanilla_user_exists($field, $user)
{
  // $field = wp_usersのcolumn名 e.g. user_login, ID, user_emailなど
  // $user = 値
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
  $delLink = wp_nonce_url(admin_url() . "post.php", "post=" . $post_id . "&action=delete");
  return $delLink;
}

/**
 * 開発者用の条件分岐関数
 *
 * @param $login_email ここで指定したユーザーでログインしている時にtrueを返す
 */
function is_developer($login_email = 'kawakatsu6111.work@gmail.com')
{
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
 * ローカル環境のみ
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
  file_put_contents(get_template_directory() . '/App/dump.php', $dump, FILE_APPEND);
}


/**
 * ユーザーの情報を出力するクラス
 *
 * @param $user ユーザーの情報
 * @param $filed ユーザーの情報を参照するフィールド(id, email, user_login, slug)
 */
class co_user
{
  public function __construct($user, $filed = 'id')
  {
    global $user_paymentPlan_array;
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


/**
 * 投稿の情報を出力するクラス
 *
 * @param $post_id 投稿id
 */
class co_post
{
  public function __construct($post_id)
  {
    // ---------- wp postの情報 ----------
    $get_post = get_post($post_id);
    $this->post_type = $get_post->post_type;
    $this->post_status = $get_post->post_status;
    $this->post_title = get_post_field('post_title', $post_id);

    // ---------- メタ情報 ----------
    $this->reservation_date = get_post_meta($post_id, "reservation_date", true);
  }
}

/**
 * 数字にコンマをつける
 *
 * @param $num 数字
 */
function num($number)
{
  return number_format($number);
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
 * サニタイズ
 *
 * @param $request $_POSTや＄_GET
 */
function vanilla_sanitaize($request)
{
  $sanitized = [];
  foreach ($request as $key => $value) {
    $sanitized[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }

  return $sanitized;
}