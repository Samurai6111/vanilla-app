<?php
//*--------------------------------------------------
/* taxonomyの登録 hookの優先度は「30」」
/*------------------------------------------------*/
$priority = 30;


// ---------- 優先度のリセット ----------
$priority = false;

/*--------------------------------------------------
/* カスタムtaxonomy投稿追加
/*------------------------------------------------*/
function vanilla_register_taxonomies()
{

	/*--------------------------------------------------
/* カスタム投稿「施設」のtaxonomyを追加
/*------------------------------------------------*/
	register_taxonomy(
		'facility_taxonomy',
		'facility',
		[
			'hierarchical'          => true,
			'labels'                => [
				'menu_name'         => '施設パラメータ',
				'edit_item'         => '施設パラメータを編集',
				'search_items'      => '施設パラメータを検索',
				'add_new_item'      => '施設パラメータを新規作成',
			],
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
		]
	);
}
// add_action('init', 'vanilla_register_taxonomies', $priority);

/*--------------------------------------------------
/* taxonomyにtermを追加
/*------------------------------------------------*/
function vanilla_insert_terms()
{
	/*--------------------------------------------------
	/* 親taxonomyの登録
	/*------------------------------------------------*/
	if (!term_exists('facility_size', 'facility_taxonomy')) {
		wp_insert_term(
			'広さ', // 日本語名
			'facility_taxonomy', // taxonomy名
			[
				'slug' => 'facility_size', // スラッグ
				'description' => '施設の広さ', // 記述
				'parent' => 0, // 親
			]
		);
	}

	/*--------------------------------------------------
	/* 子taxonomyの登録
	/*------------------------------------------------*/
	if (!term_exists('facility_size__small', 'facility_taxonomy')) {
		$parent_term = term_exists('facility_size', 'facility_taxonomy');
		$parent_term_id = $parent_term['term_id'];

		wp_insert_term(
			'37㎡~270㎡', // 日本語名
			'facility_taxonomy', // taxonomy名
			[
				'slug' => 'facility_size__small', // スラッグ
				'description' => '37㎡~270㎡', // 記述
				'parent' => $parent_term_id, // 親
			]
		);
	}
}
// add_action('init', 'vanilla_insert_terms', 40);