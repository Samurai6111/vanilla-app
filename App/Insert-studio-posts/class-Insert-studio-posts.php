<?php

class Insert_Studio_Posts {
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
	static function vanilla_register_studio_taxonomies() {
		// ---------- ファイルインクルード ----------
		require dirname(__FILE__) . '/Variables/variable-p10-studio-taxonomies.php';

		// ---------- 処理実行 ----------
		foreach ($studio_taxonomies as $taxonomy_slug => $taxonomy_name) {
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
	static function vanilla_insert_studio_parent_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p20-studio-parent-terms.php';

		// ---------- 親term登録実行 ----------
		foreach ($studio_parent_terms_list as $taxonomy_slug => $studio_parent_terms) {
			foreach ($studio_parent_terms as $studio_parent_term_slug => $studio_parent_term_name) {
				if (!term_exists($studio_parent_term_slug, $taxonomy_slug)) {
					wp_insert_term(
						$studio_parent_term_name, // 日本語名
						$taxonomy_slug, // taxonomy名
						[
							'slug' => $studio_parent_term_slug, // スラッグ
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
	static function vanilla_insert_studio_child_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p30-studio-child-terms.php';

		$taxonomy_slug = 'group';

		// ---------- 親term登録実行 ----------
		foreach ($studio_child_terms_list as $studio_parent_term_slug => $studio_child_terms) {
			$studio_child_term_id = get_term_by('slug', $studio_parent_term_slug, $taxonomy_slug)->term_id;

			foreach ($studio_child_terms as $studio_child_term_slug => $studio_child_term_name) {

				if (!term_exists($studio_child_term_slug, $taxonomy_slug)) {
					wp_insert_term(
						$studio_child_term_name, // 日本語名
						$taxonomy_slug, // taxonomy名
						[
							'slug' => $studio_child_term_slug, // スラッグ
							'parent' => $studio_child_term_id, // 親
						]
					);
				}
			}
		}
	}


	//--------------------------------------------------
	// termにacfの枠追加
	//--------------------------------------------------
	static function vanilla_register_acf_to_studio_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p40-studio-terms-acf.php';

		foreach ($studio_terms_acf_fields as $studio_terms_acf_field) {

			if (function_exists('acf_add_local_field_group')) {
				acf_add_local_field_group([
					'key' => $studio_terms_acf_field['key'],
					'title' => $studio_terms_acf_field['title'],
					'fields' => $studio_terms_acf_field['fields'],
					'location' => $studio_terms_acf_field['location'],
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
	static function vanilla_insert_meta_value_to_studio_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p50-studio-terms-meta.php';

		foreach ($studio_terms_meta_array as $taxonomy_name => $studio_terms_meta) {
			//--------------------------------------------------
			// シーンの処理
			//--------------------------------------------------
			foreach ($studio_terms_meta as $term_slug => $acf_array) {
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
	static function vanilla_insert_studio_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p60-studio-posts.php';
		foreach ($studio_posts as $studio_post) {

			if (!vanilla_the_slug_exists($studio_post['post_slug'])) {
				// ---------- 投稿・固定ページ作成 ----------
				$post_array = array(
					"post_type"      => 'post',
					"post_name"      => $studio_post['post_slug'],
					"post_title"     => $studio_post['post_title'],
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
	static function vanilla_set_studio_post_terms() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p70-studio-post-terms.php';

		foreach ($studio_post_terms as $studio_post_slug => $studio_post_term_list) {
			$post = get_page_by_path($studio_post_slug, OBJECT, 'post');
			foreach ($studio_post_term_list as $taxonomy_name => $studio_post_term_name) {
				if (is_array($studio_post_term_name)) {
					$studio_post_term_name_formatted = [];
					foreach ($studio_post_term_name as $studio_post_term_name_each) {
						$studio_post_term_id = get_term_by('slug', $studio_post_term_name_each, $taxonomy_name)->term_id;
						$studio_post_term_name_formatted[] = $studio_post_term_id;
					}
				} else {
					$studio_post_term_name_formatted = get_term_by('slug', $studio_post_term_name, $taxonomy_name)->term_id;
				}

				// echo '<pre>';
				// var_dump($studio_post_term_name_formatted);
				// echo '</pre>';


				wp_set_post_terms($post->ID, $studio_post_term_name_formatted, $taxonomy_name);
			}
		}
	}


	//--------------------------------------------------
	// 投稿にacfの枠追加
	//--------------------------------------------------
	static function vanilla_register_acf_to_studio_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p80-studio-post-acf.php';

		if (function_exists('acf_add_local_field_group')) {
			acf_add_local_field_group([
				'key' => $studio_posts_acf_fields['key'],
				'title' => $studio_posts_acf_fields['title'],
				'fields' => $studio_posts_acf_fields['fields'],
				'location' => $studio_posts_acf_fields['location'],
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
	static function vanilla_insert_meta_value_to_studio_posts() {
		// ---------- ファイルインクルード ----------
		require_once dirname(__FILE__) . '/Variables/variable-p90-studio-post-meta.php';

		foreach ($studio_pos_meta_array as $studio_slug => $meta_array) {
			$post_id = get_page_by_path($studio_slug, OBJECT, 'post')->ID;
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
add_action('admin_head', 'Insert_Studio_Posts::vanilla_unregister_default_taxonomy');
add_action('init', 'Insert_Studio_Posts::vanilla_register_studio_taxonomies');
add_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_parent_terms');
add_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_child_terms');
add_action('init', 'Insert_Studio_Posts::vanilla_register_acf_to_studio_terms');
add_action('init', 'Insert_Studio_Posts::vanilla_insert_meta_value_to_studio_terms');
add_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_posts');
add_action('init', 'Insert_Studio_Posts::vanilla_set_studio_post_terms');
add_action('init', 'Insert_Studio_Posts::vanilla_register_acf_to_studio_posts');
add_action('init', 'Insert_Studio_Posts::vanilla_insert_meta_value_to_studio_posts');



//--------------------------------------------------
// 全てのスタジオの投稿、taxonomyを削除
//--------------------------------------------------
function vanilla_reset_studio_posts() {
	global $pagenow;

	///--------------------------------------------------
	// アクションの削除
	//--------------------------------------------------
	remove_action('admin_head', 'Insert_Studio_Posts::vanilla_unregister_default_taxonomy', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_register_studio_taxonomies', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_parent_terms', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_child_terms', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_register_acf_to_studio_terms', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_insert_meta_value_to_studio_terms', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_insert_studio_posts', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_set_studio_post_terms', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_register_acf_to_studio_posts', 20);
	remove_action('init', 'Insert_Studio_Posts::vanilla_insert_meta_value_to_studio_posts', 20);

	//--------------------------------------------------
	// taxonomy削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p10-studio-taxonomies.php';

	foreach ($studio_taxonomies as $taxonomy_slug => $taxonomy_name) {
		register_taxonomy($taxonomy_slug, array());
	}
	$tax = $studio_taxonomies;
	if ($pagenow == 'edit-tags.php' && in_array($_GET['taxonomy'], $tax)) {
		wp_die('Invalid taxonomy');
	}

	//--------------------------------------------------
	// 親ターム削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p20-studio-parent-terms.php';
	foreach ($studio_parent_terms_list as $taxnonmy_name => $studio_parent_terms) {
		foreach ($studio_parent_terms as $studio_parent_term_slug => $studio_parent_term_name) {
			$term_id = get_term_by('slug', $studio_parent_term_slug, $taxnonmy_name)->term_id;
			wp_delete_term($term_id, $taxnonmy_name);
		}
	}

	//--------------------------------------------------
	// 子ターム削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p30-studio-child-terms.php';
	$taxonomy_slug = 'group';
	// ---------- 親term登録実行 ----------
	foreach ($studio_child_terms_list as $studio_parent_term_slug => $studio_child_terms) {
		foreach ($studio_child_terms as $studio_child_term_slug => $studio_child_term_name) {
			$term_id = get_term_by('slug', $studio_child_term_slug, $taxonomy_slug)->term_id;
			wp_delete_term($term_id, $taxonomy_slug);
		}
	}

	///--------------------------------------------------
	// studio削除
	//--------------------------------------------------
	// ---------- ファイルインクルード ----------
	require dirname(__FILE__) . '/Variables/variable-p60-studio-posts.php';
	foreach ($studio_posts as $studio_post) {
		$post_id = get_page_by_path($studio_post['post_slug'], OBJECT, 'post')->ID;
		wp_delete_post($post_id, true);
	}
}
// add_action('init', 'vanilla_reset_studio_posts', 20);
