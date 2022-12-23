<?php
add_action('init', function () {
	$post_type = 'page';
	$post_slug = 'map-form';
	$post_title = 'マップフォーム';
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
		// ---------- メタ情報追加 ----------
		$inserted_page_templateFile_path = "Feature-map/page-map-form.php";
		update_post_meta($inserted_page_id, "_wp_page_template", $inserted_page_templateFile_path);
	}
});
