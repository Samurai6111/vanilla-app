<?php

/*--------------------------------------------------
/* Wordpressの設定を記述するファイル
/* 基本的には全てのサイトで共通のものはここに記述してそうでないものはfunctions.phpに書く
/* 優先度は「10」
/*------------------------------------------------*/

// /**
//  *WordPress同梱のjQueryを読み込ませない
//  */
// function vanilla_deregister_script()
// {
// 	if (!is_admin()) {
// 		wp_deregister_script('jquery');
// 	}
// }
// add_action('init', 'vanilla_deregister_script');


/**
 * /Assets/Scss/内の全てのscssファイルを取得し、
 * style.scssに全てimportする
 */
function vanilla_overwrite_style_scss() {
	$style_text = '';
	$import = '@import';
	$scss_directory = get_stylesheet_directory() . '/Assets/Scss/';
	$style_scss_uri = get_template_directory_uri() . '/Assets/Scss/style.scss';
	$style_scss_directory = $scss_directory . '/style.scss';

	//= style.scssの中身を取得 ====
	$style_scss_contents = file_get_contents($style_scss_uri);
	//= style.scssの「@import」を数 ====
	$style_scss_import_count = substr_count($style_scss_contents, $import);
	//= 「/Assets/Scss/」ディレクトリのstyle.scssを除いたscssファイルのパスを取得 ====
	$scss_file_list = array_filter(
		glob($scss_directory . '*.scss'),
		function ($scss) {
			return false === strpos($scss, 'style.scss');
		}
	);

	//= ディレクトリのscssファイルと「@import」の数が一致していなかったら ====
	//= style.scsの中身を空にする ====
	if ($style_scss_import_count !== count($scss_file_list)) {
		file_put_contents($style_scss_directory, '');
	}

	//= 「/Assets/Scss/」ディレクトリ内の全てのscssファイル分の ====
	//= 「@import」の文字列を作る ====
	foreach ($scss_file_list as $scss_file) {
		$scss_file_name = basename($scss_file);
		$scss_name = str_replace(".scss", "", $scss_file_name);
		$scss_name = str_replace("_", "", $scss_name);

		$style_text .= "$import'" . $scss_name . "';";
	}

	//= style.scssに「@import」の文字列を追加 ====
	file_put_contents($style_scss_directory, $style_text);
}



/**
 * 全ページ共通のcss読み込み(wp-headで読み込まれるもの)
 */
function vanilla_load_css() {

	//--------------------------------------------------
	// style.scss上書き
	//--------------------------------------------------
	vanilla_overwrite_style_scss();

	/*--------------------------------------------------
  /* css読み込み
  /* /Assets/css ディレクトリより下のcssを全て読み込む
  /*------------------------------------------------*/
	wp_enqueue_style('style.css', get_template_directory_uri() . '/Assets/Css/style.css', [], '1.0.3');
	wp_enqueue_style('reset.css', get_template_directory_uri() . '/Assets/Css/reset.css', [], '1.0.3');
}
add_action('wp_enqueue_scripts', 'vanilla_load_css');


/**
 * 全ページ共通のjs読み込み
 */
function vanilla_load_js() {

	/*--------------------------------------------------
	/* jQuery読み込み
	/*------------------------------------------------*/
	if (!is_admin()) {
		//デフォルトjquery削除
		wp_deregister_script('jquery');

		//GoogleCDNから読み込む
		wp_enqueue_script('jquery-js', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	}

	/*--------------------------------------------------
  /* js読み込み
  /* /Assets/Js/Header ディレクトリより下のjsを全てheaderに読み込む
  /*------------------------------------------------*/
	$js_directory = get_stylesheet_directory() . '/Assets/Js/Header/';
	$js_file_list = glob($js_directory . '*.js');
	foreach ($js_file_list as $js_file) {
		$js_file_name = basename($js_file);
		$js_name = str_replace(".js", "", $js_file_name);
		$js_file_path = get_template_directory_uri() . '/Assets/Js/Header/' . $js_file_name;

		if (strpos($js_name, '_') !== false) {
			continue;
		}
		wp_enqueue_script($js_name, $js_file_path, [], '1.0.3');
	}

	/*--------------------------------------------------
  /* js読み込み
  /* /Assets/Js/Footer ディレクトリより下のjsを全てfooterに読み込む
  /*------------------------------------------------*/
	$js_directory = get_stylesheet_directory() . '/Assets/Js/Footer/';
	$js_file_list = glob($js_directory . '*.js');
	foreach ($js_file_list as $js_file) {
		$js_file_name = basename($js_file);
		$js_name = str_replace(".js", "", $js_file_name);
		$js_file_path = get_template_directory_uri() . '/Assets/Js/Footer/' . $js_file_name;

		if (strpos($js_name, '_') !== false) {
			continue;
		}
		wp_enqueue_script($js_name, $js_file_path, [], '1.0.3', true);
	}
}
add_action('wp_enqueue_scripts', 'vanilla_load_js');


/**
 * 「ダッシュボードページ」のウィジェットを削除
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


/**
 * 投稿ページにサムネイル追加
 */
add_theme_support('post-thumbnails');
add_theme_support('title-tag');


/**
 * 「購読者」が管理画面に入れないようにする
 */
add_action('auth_redirect', 'subscriber_auth_redirect');
function subscriber_auth_redirect($user_id) {
	$user = get_userdata($user_id);
	if (!$user->has_cap('edit_posts')) {
		wp_redirect(get_home_url());
		exit();
	}
}


/**
 * 「購読者」の時ツールバーを非表示にする
 */
add_action('after_setup_theme', 'subscriber_hide_admin_bar');
function subscriber_hide_admin_bar() {
	$user = wp_get_current_user();
	if (isset($user->data) && !$user->has_cap('edit_posts')) {
		show_admin_bar(false);
	}
}


/**
 * アップロードされたメディアの各サイズごとの自動生成を停止
 */
add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'disable_image_sizes');
function disable_image_sizes($new_sizes) {
	unset($new_sizes['thumbnail']);
	unset($new_sizes['medium']);
	unset($new_sizes['large']);
	unset($new_sizes['medium_large']);
	unset($new_sizes['1536x1536']);
	unset($new_sizes['2048x2048']);
	return $new_sizes;
}


/**
 * テーマフォルダ直下のeditor-style.cssを読み込み
 */
add_editor_style("editor-style.css");
add_theme_support("editor-style");


/**
 * WPのテキストエディタにもfontAwesomeを表示させる
 */
function vf_add_editor_styles() {
	add_editor_style('asset/fonts/fontawesome.min.css');
}
add_action('admin_init', 'vf_add_editor_styles');


/**
 * admin barのカスタマイズ
 */
function vanilla_custom_admin_var($admin_bar) {

	global $current_user;
	if ($current_user->user_login === 'vanilla-admin') {
		/*--------------------------------------------------
	/* 現在のテンプレートファイルを表示
	/*------------------------------------------------*/
		global $template;
		$themre_path = get_stylesheet_directory() . '/';
		$current_template_file_name = basename($template);
		$current_template_file = str_replace($themre_path, "", $template);
		$current_theme_slug = get_option('stylesheet');

		$current_template_link = admin_url() . '/theme-editor.php?file=' . $current_template_file . '&theme=' . $current_theme_slug;

		if (!is_admin()) {

			$admin_bar->add_menu(array(
				'id'    => 'current_template_link',
				'title' => 'current template : ' . $current_template_file_name, // Your menu title
				'href'  => $current_template_link, // URL
				'meta'  => array(
					'target' => '_blank',
				),
			));
		}

		/*--------------------------------------------------
	/* メニューの削除
	/*------------------------------------------------*/
		$admin_bar->remove_node('wp-logo');
		$admin_bar->remove_node('customize');
		$admin_bar->remove_node('comments');
		$admin_bar->remove_node('new-content');
		$admin_bar->remove_node('updates');
	}
}
add_action('admin_bar_menu', 'vanilla_custom_admin_var', 100);


/**
 * 投稿保存直前時に処理を追加する
 *
 * @param int  $post_id  投稿 ID。
 */
function vanilla_pre_post_update($post_id) {

	/*--------------------------------------------------
  /* 管理画面で固定ページを編集した時に
  /* _wp_page_templateのmetaデータを引き継ぐ
  /*------------------------------------------------*/
	$_wp_page_template = get_post_meta($post_id, '_wp_page_template', true);
	session_start();
	$_SESSION['wp_page_template'] = [$post_id => $_wp_page_template];
}
add_action('pre_post_update', 'vanilla_pre_post_update');


/**
 * 投稿保存時に処理を追加する
 *
 * @param int  $post_id  投稿 ID。
 */
function vanilla_edit_post($post_id) {

	/*--------------------------------------------------
  /* 管理画面で固定ページを編集した時に
  /* _wp_page_templateのmetaデータを引き継ぐ
  /*------------------------------------------------*/
	session_start();
	foreach ($_SESSION['wp_page_template'] as $key => $value) {
		$slash_count = substr_count($value, "/");
		if ($slash_count >= 2) {
			update_post_meta($key, '_wp_page_template', $value);
		}
	}
	session_unset();
}
add_action('edit_post', 'vanilla_edit_post');


/*--------------------------------------------------
/* コメント機能を消す
/*------------------------------------------------*/
add_action('admin_init', function () {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});


/*--------------------------------------------------
/* 外観 > メニューの位置設定
/*------------------------------------------------*/
add_theme_support('customize-selective-refresh-widgets');


/**
 * vanilla_get_footer
 */
function vanilla_get_footer() {
	include(get_theme_file_path() . "/Assets/Components/g-custom-js-command.php");
}
add_action('get_footer', 'vanilla_get_footer');
add_action('admin_footer', 'vanilla_get_footer');

//== wordpressから送られるメールを停止 ========
// ユーザー登録時に登録者へ送信されるメール
add_filter('wp_new_user_notification_email', '__return_false');

// ユーザー登録時に管理者へ送信されるメール
add_filter('wp_new_user_notification_email_admin', '__return_false');

// メールアドレス変更時に登録者へ送信されるメール
add_filter('send_email_change_email', '__return_false');

// パスワード変更時に登録者へ送信されるメール
add_filter('send_password_change_email', '__return_false');

// パスワードリセット時に管理者へ送信されるメール
add_filter('wp_password_change_notification_email', '__return_false');

/**
 * 管理画面のfooterにコードを追記する
 */
function vanilla_admin_footer() {
	global $pagenow;
	if ($pagenow === 'post.php') {
?>
		<script src="<?php echo get_template_directory_uri(); ?>/Assets/Js/Custom/admin-custom.js"></script>
	<?php } ?>
<?php
}
add_action('admin_footer', 'vanilla_admin_footer');
