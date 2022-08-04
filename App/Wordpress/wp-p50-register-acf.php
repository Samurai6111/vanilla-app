<?php
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'test',
		'title' => 'テスト acf',
		'fields' => [
			[
				'key' => 'cold',
				'label' => 'cold',
				'name' => 'cold',
				'type' => 'select',
				'choices' => [
					'冷', '温'
				]
			],
			[
				'key' => 'currency',
				'label' => 'currency',
				'name' => 'currency',
				'type' => 'select',
				'choices' => [
					'円', '$'
				]
			],
			[
				'key' => 'hot',
				'label' => 'hot',
				'name' => 'hot',
				'type' => 'select',
				'choices' => [
					'true', 'false'
				]
			],
			[
				'key' => 'href',
				'label' => 'href',
				'name' => 'href',
				'type' => 'text',
			],
			[
				'key' => 'image',
				'label' => 'image',
				'name' => 'image',
				'type' => 'image',
				'return_format' => 'url',
			],
			[
				'key' => 'lead',
				'label' => 'lead',
				'name' => 'lead',
				'type' => 'textarea',
			],
			[
				'key' => 'limited',
				'label' => 'limited',
				'name' => 'limited',
				'type' => 'text',
			],
			[
				'key' => 'price',
				'label' => 'price',
				'name' => 'price',
				'type' => 'select',
				'choices' => [
					'デフォルトあり, 数字:960, 単位:並' => [
						[
							'default' => true,
							'number' => 960,
							'unit' => '並',
						]
					],
					'デフォルトなし, 数字:1000, 単位:並' => [
						'default' => false,
						'number' => 1000,
						'unit' => '並',
					],
				],
			],
			[
				'key' => 'priceNotes',
				'label' => 'priceNotes',
				'name' => 'priceNotes',
				'type' => 'text',
			],
			[
				'key' => 'shopExclusive',
				'label' => 'shopExclusive',
				'name' => 'shopExclusive',
				'type' => 'text',
			],
			[
				'key' => 'sizeUnit',
				'label' => 'sizeUnit',
				'name' => 'sizeUnit',
				'type' => 'checkbox',
				'choices' => [
					'小', '並', '大盛', '特盛', '得'
				],
			],
			[
				'key' => 'takeoutAvailability',
				'label' => 'takeoutAvailability',
				'name' => 'takeoutAvailability',
				'type' => 'select',
				'choices' => [
					'お持ち帰り可',
					'お持ち帰り不可',
				],
			],
			[
				'key' => 'takeoutOnly',
				'label' => 'takeoutOnly',
				'name' => 'takeoutOnly',
				'type' => 'select',
				'choices' => [
					'可',
					'不可',
				],
			],
		],
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'test',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
}
