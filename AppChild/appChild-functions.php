<?php
/**
 * 投稿の情報を出力するクラス
 *
 * @param $post_id 投稿id
 */
class Post
{
	public function __construct($post_id)
	{
		// ---------- wp postの情報 ----------
		$get_post = get_post($post_id);
		$this->post_type = $get_post->post_type;
		$this->post_status = $get_post->post_status;
		$this->post_title = get_post_field('post_title', $post_id);

		// ---------- メタ情報 ----------
		$this->interview__position = get_post_meta($post_id, "interview__position", true);
	}
}

/**
 * カテゴリの情報を出力するクラス
 *
 * @param $term_id 投稿id
 */
class Term
{
	public function __construct($term_id)
	{
		// ---------- termの情報 ----------
		$get_term = get_term($term_id);
		$this->slug = $get_term->slug;
		$this->name = $get_term->name;
		$this->description = $get_term->description;

		// ---------- メタ情報 ----------
		$this->interview__category_color = get_term_meta($term_id, "interview__category_color", true);
	}
}