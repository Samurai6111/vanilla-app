<?php

/**
 * 投稿の情報を出力するクラス
 *
 * @param $post_id 投稿id
 */
class Vanilla_Post
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