・概要
固定ページを挿入するためのファイルを格納するフォルダ

・ルール
「insert-」以降の「p10」は優先度を示している。数字が小さくなるほど早く読み込まれる
「insert-p10-」以降の文字列は固定ページのスラッグ名

・例
【スラッグ名が「company」、タイトルが「会社概要」という固定ページを生成する場合】
1. 「insert-p10-page-company.php」というファイルをApp/Inserts/直下に生成
2. 下記コードを追記
<?php
add_action('init', function () {
	$post_type = 'page';
	$post_slug = 'company';
	$post_title = '会社概要';
	$post_content = '';

	if (!vanilla_the_slug_exists($post_slug)) {

		// ---------- 投稿・固定ページ作成 ----------
		$post_array = array(
			"post_type"      => $post_type,
			"post_name"      => $post_slug,
			"post_title"     => $post_title,
			"post_content"   => $post_content,
			"post_status"    => "publish",
			"post_author"    => 1,
			"post_parent"    => 0,
			"comment_status" => "closed"
		);
		$inserted_page_id = wp_insert_post($post_array);

		// ---------- 対象のテンプレートファイルの「テーマファイルからの」パスを定義 ----------
		$inserted_page_templateFile_path = "Pages/page-thanks.php";

		// ---------- テンプレートファイルを設定 ----------
		update_post_meta($inserted_page_id, "_wp_page_template", $inserted_page_templateFile_path);
	}
});
