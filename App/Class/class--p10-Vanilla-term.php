<?php

/**
 * カテゴリの情報を出力するクラス
 *
 * @param $term_id 投稿id
 */
class Vanilla_Term
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