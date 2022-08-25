<?php

$terms_acf_fields = [

	//--------------------------------------------------
	// グループ
	//--------------------------------------------------
	'group' => [
		'key' => 'category_acf_fields',
		'title' => 'カテゴリのカスタムフィールド',
		'fields' => [
			[
				'key' => 'category_theme_color',
				'label' => 'カテゴリのカラー',
				'name' => 'category_theme_color',
				'type' => 'color_picker',
			],
		],
		'location' => [
			[
				[
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'category',
				]
			]
		]
	],
];
