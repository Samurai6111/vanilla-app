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
// 管理画面「投稿 →「スタジオ」に変更
//--------------------------------------------------
function vanilla_change_post_menu_label()
{

	global $menu;
	global $submenu;
	$menu[5][0] = 'スタジオ';
	$submenu['edit.php'][5][0] = 'スタジオ一覧';
	$submenu['edit.php'][10][0] = '新しいスタジオ';
	$submenu['edit.php'][16][0] = 'タグ';
}
// add_action('admin_menu', 'vanilla_change_post_menu_label');

function vanilla_change_post_object_label()
{

	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'スタジオ';
	$labels->singular_name = 'スタジオ';
	$labels->add_new = _x('追加', 'スタジオ');
	$labels->add_new_item = 'スタジオの新規追加';
	$labels->edit_item = 'スタジオの編集';
	$labels->new_item = '新規スタジオ';
	$labels->view_item = 'スタジオを表示';
	$labels->search_items = 'スタジオを検索';
	$labels->not_found = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}

// add_action('init', 'vanilla_change_post_object_label');