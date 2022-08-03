<?php

/**
 * カテゴリの情報を出力するクラス
 *
 * @param $term_id 投稿id
 */
class Vanilla_Terms {
	public function __construct($taxonomy) {
		// ---------- termの情報 ----------
		$this->taxonomy = $taxonomy;
	}


	/**
	 * ターム一覧を取得
	 *
	 * @param $args WP_Term_Queryの$argsと同じ
	 */
	function get_terms($args) {
		//--------------------------------------------------
		// 初期値
		//--------------------------------------------------
		$args_init = [
			'taxonomy' => $this->taxonomy,
			'hide_empty' => false,
			'orderby'   => 'meta_value_num',
			'order'   => 'ASC',
			'meta_key'   => 'term_order',
			'parent' => 0,
		];

		//--------------------------------------------------
		// 変数の変更
		//--------------------------------------------------
		foreach ($args_init as $key => $value) {
			$args_value = (!isset($args[$key])) ? $value : $args[$key];
			$args[$key] = $args_value;
		}

		$term_query = new WP_Term_Query($args);
		return $term_query->get_terms();
	}

	function get_term($term_slug) {
		return get_term_by('slug', $term_slug, $this->taxonomy);
	}

	/**
	 * カスタムフィールドの値を取得する
	 *
	 * @param $key カスタムフィールdのキー
	 * @param $term_id タームID
	 */
	function get_field($key, $term_id) {
		$acf_id = $this->taxonomy . '_' . $term_id;
		return get_field($key, $acf_id);
	}
}
