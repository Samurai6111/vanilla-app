<?php

$terms_acf_fields = [

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
];
