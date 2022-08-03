<?php
add_action('init', function () {

	$post_type = 'post';
	$post_slug = 'test123';
	$post_title = 'テスト投稿';
	$post_content = '<h1>見出し１</h1>
<h2>見出し2</h2>
<h3>見出し3</h3>
<h4>見出し4</h4>
<h5>見出し5</h5>
<h6>見出し6</h6>
<strong>太字の文章太字の文章太字の文章太字の文章太字の文章太字の文章太字の文章</strong>

<em>イタリックの文章イタリックの文章イタリックの文章イタリックの文章イタリックの文章</em>
<blockquote>引用引用引用引用引用引用引用引用引用引用引用引用引用引用引用引用引用引用</blockquote>
&nbsp;
<ul>
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
</ul>
<ul style="list-style-type: circle;">
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
</ul>
<ul style="list-style-type: square;">
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
 	<li>番号なしリスト</li>
</ul>
&nbsp;
<ol>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
<ol style="list-style-type: lower-alpha;">
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
<ol style="list-style-type: lower-greek;">
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
<ol style="list-style-type: lower-roman;">
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
<ol style="list-style-type: upper-alpha;">
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
<ol style="list-style-type: upper-roman;">
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
 	<li>番号付きリスト</li>
</ol>
左よせ
<p style="text-align: center;">中央よせ</p>
<p style="text-align: right;">右よせ</p>
<a href="/">リンク</a>
<table style="border-collapse: collapse; width: 100%;">
<tbody>
<tr>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
</tr>
<tr>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
</tr>
<tr>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
<td style="width: 33.3333%;">テーブル</td>
</tr>
</tbody>
</table>
';

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
	}
});