<?php


$setting_menu_slug = 'vanilla-app-setting';
$credential_action = $setting_menu_slug . '_nonce_action';
$credential_key = $setting_menu_slug . '_nonce_key';

add_action('admin_menu', 'vanilla_custom_admin_menu');
add_action('admin_init', 'vanilla_custom_admin_menu_save_config');

function vanilla_custom_admin_menu() {
	global $setting_menu_slug, $credential_action, $credential_key;
	add_menu_page(
		'App', // ページタイトル
		'App',
		/* メニュータイトル */
		'manage_options',
		/* 権限 */
		$setting_menu_slug,
		/* ページを開いたときのURL */
		'vanilla_custom_admin_page',
		/* メニューに紐づく画面を描画するcallback関数 */
		'dashicons-format-gallery',
		/* アイコン see: https://developer.wordpress.org/resource/dashicons/#awards */
		99 /* 表示位置のオフセット */
	);
}

//========================
//設定画面の項目データベースに保存する
//========================
function vanilla_custom_admin_menu_save_config() {
	global $setting_menu_slug, $credential_action, $credential_key;
	$data = vanilla_sanitize_array($_POST);

	//== nonceで設定したcredentialのチェック ========
	if (isset($data[$credential_key]) && $data[$credential_key]) {
		if (check_admin_referer($credential_action, $credential_key)) {

			update_option('vanilla_app_google_api_key', $data['vanilla_app_google_api_key']);
			update_option('vanilla_google_custom_search_api_key', $data['vanilla_google_custom_search_api_key']);

			wp_safe_redirect(menu_page_url($setting_menu_slug));
		}
	}
}

function vaniila_admin_table_row($text, $key) {
?>
	<tr>
		<th>
			<label for="vanilla_google_custom_search_api_key"><?php echo $text ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo esc_attr($key) ?>" id="<?php echo esc_attr($key) ?>" value="<?php echo esc_attr(get_option($key)) ?>">
		</td>
	</tr>
<?php
}

function vanilla_custom_admin_page() {
	global $setting_menu_slug, $credential_action, $credential_key;
?>
	<div class="wrap">
		<h1><b>App設定</b></h1>

		<form action="" method='post' id="my-submenu-form">

			<?php wp_nonce_field($credential_action, $credential_key) ?>

			<h2>App</h2>
			<table class="form-table">

				<?php vaniila_admin_table_row('Google Api Key', 'vanilla_app_google_api_key') ?>
				<?php vaniila_admin_table_row('Google Custom Search API', 'vanilla_google_custom_search_api_key') ?>
				<?php vaniila_admin_table_row('Google Custom Search CX', 'vanilla_google_custom_search_cx_key') ?>
			</table>
			<input type='submit' value='保存' class='button button-primary button-large'>
			</p>
		</form>
	</div>
<?php

}
