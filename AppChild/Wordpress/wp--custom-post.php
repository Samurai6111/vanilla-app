<?php
//*--------------------------------------------------
/* カスタム投稿の登録 hookの優先度は「20」」
/*------------------------------------------------*/
$priority = 20;


// ---------- 優先度のリセット ----------
$priority = false;


/*--------------------------------------------------
/* カスタム投稿追加
/*------------------------------------------------*/
function vanilla_register_post_types()
{

	// ---------- カスタム投稿（施設） ----------
	register_post_type(
		'facility', // カスタム投稿名(半角英字)
		[
			'labels' => [
				'name' => __('施設'), //管理画面に表示される文字（日本語OK)
				'singular_name' => __('施設'),
			],
			//投稿タイプの設定
			'public' => true, //公開するかしないか(デフォルト"true")
			'has_archive' => true, //trueにすると投稿した記事のアーカイブページを生成
			'menu_position' => 5, // 管理画面上でどこに配置するか
			'hierarchical' => true, // 投稿同士の階層
			//投稿編集ページの設定
			'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'post-formats'], //タイトル，編集，アイキャッチ対応)
			'menu_icon' => 'dashicons-building', // アイコン
			'show_in_rest' => true,
		]
	);
}
// add_action('init', 'vanilla_register_post_types', $priority);


//--------------------------------------------------
// 管理画面「投稿 →「イベント」に変更
//--------------------------------------------------
function change_post_menu_label()
{

	global $menu;
	global $submenu;
	$menu[5][0] = 'イベント';
	$submenu['edit.php'][5][0] = 'イベント一覧';
	$submenu['edit.php'][10][0] = '新しいイベント';
	$submenu['edit.php'][16][0] = 'タグ';
}

function change_post_object_label()
{

	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'イベント';
	$labels->singular_name = 'イベント';
	$labels->add_new = _x('追加', 'イベント');
	$labels->add_new_item = 'イベントの新規追加';
	$labels->edit_item = 'イベントの編集';
	$labels->new_item = '新規イベント';
	$labels->view_item = 'イベントを表示';
	$labels->search_items = 'イベントを検索';
	$labels->not_found = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}

// add_action('init', 'change_post_object_label');
// add_action('admin_menu', 'change_post_menu_label');


// これを別ファイルに作る wp--custom-admin-menu.php
function vanilla_hide_admin_menu()
{
	global $current_user;

	if ($current_user->user_login === 'yumemesse-admin' && is_admin()) {
		// To remove the theme editor and theme options submenus from
		// the Appearance admin menu, as well as the main 'Themes'
		// submenu you would use
		// ---------- 外観 ----------
		remove_menu_page('themes.php');
		remove_submenu_page('themes.php', 'themes.php');
		remove_submenu_page('themes.php', 'theme-editor.php');
		remove_submenu_page('themes.php', 'theme_options');

		// ---------- ダッシュボード ----------
		remove_menu_page('index.php');
		remove_submenu_page('index.php', 'update-core.php');

		// ---------- ユーザー ----------
		remove_menu_page('users.php');
		remove_submenu_page('users.php', 'user-new.php');
		remove_submenu_page('users.php', 'profile.php');

		// ---------- ツール ----------
		remove_menu_page('tools.php');

		// ---------- 設定 ----------
		remove_menu_page('options-general.php');

		// ---------- プラグイン ----------
		remove_menu_page('plugins.php');

		// ---------- acfフィールド ----------
		remove_menu_page('edit.php?post_type=acf-field-group');

		// ---------- mw wp form ----------
		remove_menu_page('edit.php?post_type=mw-wp-form');

		// ---------- mywpdb ----------
		remove_menu_page('mywpdb_page');

		// ---------- all in one wp migration ----------
		remove_menu_page('ai1wm_export');

		// ---------- all in one seo ----------
		remove_menu_page('aioseo');
	}
}

// add_action('admin_head', 'vanilla_hide_admin_menu');