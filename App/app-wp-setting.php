<?php

/*--------------------------------------------------
/* 「ダッシュボードページ」のウィジェットを削除
/*------------------------------------------------*/
function remove_dashboard_widgets()
{
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

/*--------------------------------------------------
/* 投稿ページにサムネイル追加
/*------------------------------------------------*/
add_theme_support('post-thumbnails');

/*--------------------------------------------------
/* 「購読者」が管理画面に入れないようにする
/*------------------------------------------------*/
add_action( 'auth_redirect', 'subscriber_auth_redirect' );
function subscriber_auth_redirect( $user_id ) {
$user = get_userdata( $user_id );
if ( !$user->has_cap( 'edit_posts' ) ) {
wp_redirect( get_home_url() );
exit();
}
}


/*--------------------------------------------------
/* 「購読者」の時ツールバーを非表示にする
/*------------------------------------------------*/
add_action( 'after_setup_theme', 'subscriber_hide_admin_bar' );
function subscriber_hide_admin_bar() {
$user = wp_get_current_user();
if ( isset( $user->data ) && !$user->has_cap( 'edit_posts' ) ) {
show_admin_bar( false );
}
}


/*--------------------------------------------------
/* アップロードされたメディアの各サイズごとの自動生成を停止
/*------------------------------------------------*/
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'disable_image_sizes' );
function disable_image_sizes( $new_sizes ) {
  unset( $new_sizes['thumbnail'] );
  unset( $new_sizes['medium'] );
  unset( $new_sizes['large'] );
  unset( $new_sizes['medium_large'] );
  unset( $new_sizes['1536x1536'] );
  unset( $new_sizes['2048x2048'] );
  return $new_sizes;
}


/*--------------------------------------------------
/* テーマフォルダ直下のeditor-style.cssを読み込み
/*------------------------------------------------*/
add_editor_style("editor-style.css");
add_theme_support("editor-style");

/*--------------------------------------------------
/* WPのテキストエディタにもfontAwesomeを表示させる

/*------------------------------------------------*/
function vf_add_editor_styles()
{
  add_editor_style('asset/fonts/fontawesome.min.css');
}
add_action('admin_init', 'vf_add_editor_styles');
