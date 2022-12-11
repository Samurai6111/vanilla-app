<?php


/**
 * ログインフォームに追加のinput
 */
function my_login_inputs($default_inputs) {
	$default_inputs[2] = [
		'name'   => "",
		'type'   => 'hidden',
		'tag'    => 'login_redirect_url',
		'class'  => 'login_redirect_url',
		'div'    => 'login_redirect_url',
	];

	return $default_inputs;
}
add_filter('wpmem_inc_login_inputs', 'my_login_inputs');

/**
 * ログイン時のリダイレクト
 *
 * @param
 * @return
 */
function vanilla_my_login_redirect($redirect_to, $user_id) {
	echo '<pre>';
	var_dump($_POST['login_redirect_url']);
	echo '</pre>';
	if (isset($_POST['login_redirect_url']) && $_POST['login_redirect_url']) {
		$redirect_url = $_POST['login_redirect_url'];
	} else {
		$redirect_url = home_url();
	}

	return $redirect_url;
}
add_filter('wpmem_login_redirect', 'vanilla_my_login_redirect', 10, 2);

/**
 * ログアウト時のリダイレクト
 */
function vanilla_my_logout_redirect($redirect_to) {
	return home_url();
}
add_filter('wpmem_logout_redirect', 'vanilla_my_logout_redirect');


//= WordPressの管理画面ログインURLを変更する ====
define('LOGIN_CHANGE_PAGE', 'wp-content/themes/vanilla-app/Pages/page-login.php');





//= 指定以外のログインURLは403エラーにする ====
function vanilla_login_change_init() {
	if (!defined('LOGIN_CHANGE') || sha1('keyword') != LOGIN_CHANGE) {
		status_header(403);
		exit;
	}
}
// add_action('login_init', 'vanilla_login_change_init');

//= ログイン済みか新設のログインURLの場合はwp-login.phpを置き換える ====
function vanilla_login_change_site_url($url, $path, $orig_scheme, $blog_id) {
	if (
		$path === 'wp-login.php' &&
		(is_user_logged_in() || strpos($_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE) !== false)
	)
		$url = str_replace('wp-login.php', LOGIN_CHANGE_PAGE, $url);
		// echo '<pre>';
		// var_dump($url);
		// echo '</pre>';
	return $url;
}
add_filter('site_url', 'vanilla_login_change_site_url', 10, 4);

//= ログアウト時のリダイレクト先の設定 ====
function vanilla_login_change_wp_redirect($location, $status) {
	if (strpos($_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE) !== false)
		$location = str_replace('wp-login.php', LOGIN_CHANGE_PAGE, $location);
		// echo '<pre>';
		// var_dump($location);
		// echo '</pre>';
	return $location;
}
add_filter('wp_redirect', 'vanilla_login_change_wp_redirect', 10, 2);


/**
* ログアウトURL
*/
function vanilla_logout_url() {
	return home_url('/login/?a=logout');
}
