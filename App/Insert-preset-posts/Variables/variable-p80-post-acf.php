<?php

$studio_posts_acf_fields = [
	'key' => 'studio_post_acf_fields',
	'title' => '投稿のカスタムフィールド',
	'fields' => [
		[
			'key' => 'studio_direct_phone_number',
			'label' => 'スタジオ直通',
			'name' => 'studio_direct_phone_number',
			'type' => 'text',
			'placeholder' => '000-0000-0000',
		],
		[
			'key' => 'studio_topic',
			'label' => 'トピック',
			'name' => 'studio_topic',
			'type' => 'repeater',
			'layout' => 'block',
			'sub_fields' => [
				[
					'key' => 'studio_topic_text',
					'label' => 'トピックのリード文章',
					'name' => 'studio_topic_text',
					'type' => 'textarea',
					'return_format' => 'br',
				],
				[
					'key' => 'studio_topic_imgs',
					'label' => 'トピックの画像一覧',
					'name' => 'studio_topic_imgs',
					'type' => 'repeater',
					'sub_fields' => [
						[
							'key' => 'studio_topic_img',
							'label' => 'トピックの画像',
							'name' => 'studio_topic_img',
							'type' => 'image',
							'return_format' => 'url',
						]
					]
				],
			]
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			]
		]
	]
];
