<?php
function vanilla_get_area_terms() {
	$area_terms = [];
	$terms = get_terms('area', [
		'hide_empty' => false
	]);

	foreach ($terms as $term) {
		$area_terms[$term->term_id] = $term->name;
	}

	return $area_terms;
}

$studio_terms_acf_fields = [

	//--------------------------------------------------
	// グループ
	//--------------------------------------------------
	'group' => [
		'key' => 'group_taxonomy_acf_fields',
		'title' => 'グループのカスタムフィールド',
		'fields' => [
			[
				'key' => 'group_phone_number',
				'label' => 'グループの電話番号',
				'name' => 'group_phone_number',
				'type' => 'text',
				'placeholder' => '000-0000-0000',
			],
			[
				'key' => 'group_theme_color',
				'label' => 'グループのテーマカラー',
				'name' => 'group_theme_color',
				'type' => 'color_picker',
			],
			[
				'key' => 'group_area',
				'label' => 'グループのエリア',
				'name' => 'group_area',
				'type' => 'select',
				'choices' => vanilla_get_area_terms(),
			],
			[
				'key' => 'group_address',
				'label' => 'グループの住所',
				'name' => 'group_address',
				'type' => 'textarea',
			],
			[
				'key' => 'group_fax',
				'label' => 'グループのfax',
				'name' => 'group_fax',
				'type' => 'text',
			],
			[
				'key' => 'group_thumbnail',
				'label' => 'グループのサムネイル',
				'name' => 'group_thumbnail',
				'type' => 'image',
				'return_format' => 'url',
			],
			[
				'key' => 'group_access',
				'label' => 'グループのアクセス情報',
				'name' => 'group_access',
				'type' => 'textarea',
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'group',
				]
			]
		]
	],

	//--------------------------------------------------
	// シーン
	//--------------------------------------------------
	'scene' => [
		'key' => 'scene_taxonomy_acf_fields',
		'title' => 'グループのカスタムフィールド',
		'fields' => [
			[
				'key' => 'scene_thumbnail',
				'label' => 'サムネイル',
				'name' => 'scene_thumbnail',
				'type' => 'image',
			],
			[
				'key' => 'scene_pickup',
				'label' => 'ピックアップ',
				'name' => 'scene_pickup',
				'type' => 'true_false',
				'message' => 'トップページのTOPICSに表示させる'
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'scene',
				]
			]
		]
	],

	// 'scene' => [],
];
