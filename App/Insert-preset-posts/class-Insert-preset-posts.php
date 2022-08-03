<?php

class Insert_Preset_Posts {
	//--------------------------------------------------
	// デフォルトのタグとカテゴリをサイドバーから削除
	//--------------------------------------------------
	static function vanilla_unregister_default_taxonomy() {
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	}

	/*--------------------------------------------------
	/* taxonomy追加
	/*------------------------------------------------*/
	static function vanilla_register_taxonomies() {
		// ---------- ファイルインクルード ----------
		require dirname(__FILE__) . '/Variables/variable-p10-taxonomies.php';

		// ---------- 処理実行 ----------
		foreach ($taxonomies as $taxonomy_slug => $taxonomy_name) {
			register_taxonomy(
				$taxonomy_slug,
				'post',
				[
					'hierarchical'          => true,
					'labels'                => [
						'name'         =>  $taxonomy_name,
						'menu_name'         =>  $taxonomy_name,
						'edit_item'         =>  $taxonomy_name . 'を編集',
						'search_items'      =>  $taxonomy_name . 'を検索',
						'add_new_item'      =>  $taxonomy_name . 'を新規作成',
					],
					'show_ui'               => true,
					'show_admin_column'     => true,
					'query_var'             => true,
				]
			);
		}
	}


	/*--------------------------------------------------
	/* 親termの登録
	/*------------------------------------------------*/
	static function vanilla_insert_parent_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p20-parent-terms.php';

		// ---------- 親term登録実行 ----------
		foreach ($parent_terms_list as $taxonomy_slug => $parent_terms) {
			foreach ($parent_terms as $parent_term_slug => $parent_term_name) {
				if (!term_exists($parent_term_slug, $taxonomy_slug)) {
					wp_insert_term(
						$parent_term_name, // 日本語名
						$taxonomy_slug, // taxonomy名
						[
							'slug' => $parent_term_slug, // スラッグ
							'parent' => 0, // 親
						]
					);
				}
			}
		}
	}


	/*--------------------------------------------------
	/* 子termの登録
	/*------------------------------------------------*/
	static function vanilla_insert_child_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p30-child-terms.php';

		$taxonomy_slug = 'group';

		// ---------- 親term登録実行 ----------
		foreach ($child_terms_list as $parent_term_slug => $child_terms) {
			$child_term_id = get_term_by('slug', $parent_term_slug, $taxonomy_slug)->term_id;

			foreach ($child_terms as $child_term_slug => $child_term_name) {

				if (!term_exists($child_term_slug, $taxonomy_slug)) {
					wp_insert_term(
						$child_term_name, // 日本語名
						$taxonomy_slug, // taxonomy名
						[
							'slug' => $child_term_slug, // スラッグ
							'parent' => $child_term_id, // 親
						]
					);
				}
			}
		}
	}


	//--------------------------------------------------
	// termにacfの枠追加
	//--------------------------------------------------
	static function vanilla_register_acf_to_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p40-terms-acf.php';

		foreach ($terms_acf_fields as $terms_acf_field) {

			if (function_exists('acf_add_local_field_group')) {
				acf_add_local_field_group([
					'key' => $terms_acf_field['key'],
					'title' => $terms_acf_field['title'],
					'fields' => $terms_acf_field['fields'],
					'location' => $terms_acf_field['location'],
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
				]);
			}
		}
	}


	//--------------------------------------------------
	//termにacfのvalueを追加
	//--------------------------------------------------
	static function vanilla_insert_meta_value_to_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p50-terms-meta.php';

		foreach ($terms_meta_array as $taxonomy_name => $terms_meta) {
			//--------------------------------------------------
			// シーンの処理
			//--------------------------------------------------
			foreach ($terms_meta as $term_slug => $acf_array) {
				$term_id = get_term_by('slug', $term_slug, $taxonomy_name)->term_id;
				foreach ($acf_array as $acf_key => $acf_value) {
					if (function_exists('update_field')) {
						update_field($acf_key, $acf_value, $taxonomy_name . '_' . $term_id);
					}
				}
			}
		}
	}


	//--------------------------------------------------
	//スタジオの投稿を挿入
	//--------------------------------------------------
	static function vanilla_insert_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p60-posts.php';
		foreach ($posts as $post) {

			if (!vanilla_the_slug_exists($post['post_slug'])) {
				// ---------- 投稿・固定ページ作成 ----------
				$post_array = array(
					"post_type"      => 'post',
					"post_name"      => $post['post_slug'],
					"post_title"     => $post['post_title'],
					"post_content"   => '',
					"post_status"    => "publish",
					"post_author"    => 1,
					"post_parent"    => 0,
					"comment_status" => "closed"
				);
				$inserted_page_id = wp_insert_post($post_array);
			}
		}
	}


	//--------------------------------------------------
	//スタジオの投稿にターム挿入
	//--------------------------------------------------
	static function vanilla_set_post_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p70-post-terms.php';

		foreach ($post_terms as $post_slug => $post_term_list) {
			$post = get_page_by_path($post_slug, OBJECT, 'post');
			foreach ($post_term_list as $taxonomy_name => $post_term_name) {
				if (is_array($post_term_name)) {
					$post_term_name_formatted = [];
					foreach ($post_term_name as $post_term_name_each) {
						$post_term_id = get_term_by('slug', $post_term_name_each, $taxonomy_name)->term_id;
						$post_term_name_formatted[] = $post_term_id;
					}
				} else {
					$post_term_name_formatted = get_term_by('slug', $post_term_name, $taxonomy_name)->term_id;
				}

				// echo '<pre>';
				// var_dump($post_term_name_formatted);
				// echo '</pre>';


				wp_set_post_terms($post->ID, $post_term_name_formatted, $taxonomy_name);
			}
		}
	}


	//--------------------------------------------------
	// 投稿にacfの枠追加
	//--------------------------------------------------
	static function vanilla_register_acf_to_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p80-post-acf.php';

		if (function_exists('acf_add_local_field_group')) {
			acf_add_local_field_group([
				'key' => $posts_acf_fields['key'],
				'title' => $posts_acf_fields['title'],
				'fields' => $posts_acf_fields['fields'],
				'location' => $posts_acf_fields['location'],
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
			]);
		}
	}


	//--------------------------------------------------
	// 投稿にacfの枠追加
	//--------------------------------------------------
	static function vanilla_insert_meta_value_to_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p90-post-meta.php';

		foreach ($post_meta_array as $slug => $meta_array) {
			$post_id = get_page_by_path($slug, OBJECT, 'post')->ID;
			foreach ($meta_array as $meta_key => $meta_value) {
				if (function_exists('update_field')) {
					update_field($meta_key, $meta_value, $post_id);
				}
			}
		}
	}
}

//--------------------------------------------------
// 実行
//--------------------------------------------------
add_action('admin_head', 'Insert_Preset_Posts::vanilla_unregister_default_taxonomy');
add_action('init', 'Insert_Preset_Posts::vanilla_register_taxonomies');
add_action('init', 'Insert_Preset_Posts::vanilla_insert_parent_terms');
add_action('init', 'Insert_Preset_Posts::vanilla_insert_child_terms');
add_action('init', 'Insert_Preset_Posts::vanilla_register_acf_to_terms');
add_action('init', 'Insert_Preset_Posts::vanilla_insert_meta_value_to_terms');
add_action('init', 'Insert_Preset_Posts::vanilla_insert_posts');
add_action('init', 'Insert_Preset_Posts::vanilla_set_post_terms');
add_action('init', 'Insert_Preset_Posts::vanilla_register_acf_to_posts');
add_action('init', 'Insert_Preset_Posts::vanilla_insert_meta_value_to_posts');



//--------------------------------------------------
// 全てのスタジオの投稿、taxonomyを削除
//--------------------------------------------------
function vanilla_reset_posts() {
	global $pagenow;

	///--------------------------------------------------
	// アクションの削除
	//--------------------------------------------------
	remove_action('admin_head', 'Insert_Posts::vanilla_unregister_default_taxonomy', 20);
	remove_action('init', 'Insert_Posts::vanilla_register_taxonomies', 20);
	remove_action('init', 'Insert_Posts::vanilla_insert_parent_terms', 20);
	remove_action('init', 'Insert_Posts::vanilla_insert_child_terms', 20);
	remove_action('init', 'Insert_Posts::vanilla_register_acf_to_terms', 20);
	remove_action('init', 'Insert_Posts::vanilla_insert_meta_value_to_terms', 20);
	remove_action('init', 'Insert_Posts::vanilla_insert_posts', 20);
	remove_action('init', 'Insert_Posts::vanilla_set_post_terms', 20);
	remove_action('init', 'Insert_Posts::vanilla_register_acf_to_posts', 20);
	remove_action('init', 'Insert_Posts::vanilla_insert_meta_value_to_posts', 20);

	//--------------------------------------------------
	// taxonomy削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p10-taxonomies.php';

	foreach ($taxonomies as $taxonomy_slug => $taxonomy_name) {
		register_taxonomy($taxonomy_slug, array());
	}
	$tax = $taxonomies;
	if ($pagenow == 'edit-tags.php' && in_array($_GET['taxonomy'], $tax)) {
		wp_die('Invalid taxonomy');
	}

	//--------------------------------------------------
	// 親ターム削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p20-parent-terms.php';
	foreach ($parent_terms_list as $taxnonmy_name => $parent_terms) {
		foreach ($parent_terms as $parent_term_slug => $parent_term_name) {
			$term_id = get_term_by('slug', $parent_term_slug, $taxnonmy_name)->term_id;
			wp_delete_term($term_id, $taxnonmy_name);
		}
	}

	//--------------------------------------------------
	// 子ターム削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p30-child-terms.php';
	$taxonomy_slug = 'group';
	// ---------- 親term登録実行 ----------
	foreach ($child_terms_list as $parent_term_slug => $child_terms) {
		foreach ($child_terms as $child_term_slug => $child_term_name) {
			$term_id = get_term_by('slug', $child_term_slug, $taxonomy_slug)->term_id;
			wp_delete_term($term_id, $taxonomy_slug);
		}
	}

	///--------------------------------------------------
	// studio削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p60-posts.php';
	foreach ($posts as $post) {
		$post_id = get_page_by_path($post['post_slug'], OBJECT, 'post')->ID;
		wp_delete_post($post_id, true);
	}
}
// add_action('init', 'vanilla_reset_posts', 20);
