<?php
function vanilla_get_topics() {
$scene = 'scene';
$Vanilla_Terms = new Vanilla_Terms($scene);
$topics = $Vanilla_Terms->get_terms([
	'meta_key' => 'scene_pickup',
	'meta_value' => 1,
]);

$topic_array = [];
foreach ($topics as $topic) {
	$topic_array[$topic->slug] = $topic->name;
}

	return $topic_array;
}

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
			'key' => 'studio_fax',
			'label' => 'FAX',
			'name' => 'studio_fax',
			'type' => 'text',
			'placeholder' => '000-0000-0000',
		],
		[
			'key' => 'studio_address',
			'label' => '住所',
			'name' => 'studio_address',
			'type' => 'textarea',
			'return_format' => 'br',
		],
		[
			'key' => 'studio_operating_hour',
			'label' => '営業時間',
			'name' => 'studio_operating_hour',
			'type' => 'textarea',
			'return_format' => 'br',
		],
		[
			'key' => 'studio_still_shooting_price_weekday',
			'label' => 'スチール 平日',
			'name' => 'studio_still_shooting_price_weekday',
			'type' => 'number',
		],
		[
			'key' => 'studio_movie_shooting_ptice_weekday',
			'label' => 'ムービー 平日',
			'name' => 'studio_movie_shooting_ptice_weekday',
			'type' => 'number',
		],
		[
			'key' => 'studio_still_shooting_price_holidays',
			'label' => 'スチール',
			'name' => 'studio_still_shooting_price_holidays',
			'type' => 'number',
		],
		[
			'key' => 'studio_movie_shooting_ptice_holidays',
			'label' => 'ムービー',
			'name' => 'studio_movie_shooting_ptice_holidays',
			'type' => 'number',
		],
		[
			'key' => 'studio_small_scale_movie_shooting_ptice',
			'label' => '小規模ムービー',
			'name' => 'studio_small_scale_movie_shooting_ptice',
			'type' => 'number',
		],
		[
			'key' => 'studio_minimum_usage_hour',
			'label' => '最低利用時間',
			'name' => 'studio_minimum_usage_hour',
			'type' => 'number',
		],
		[
			'key' => 'studio_capacity',
			'label' => '収容人数',
			'name' => 'studio_capacity',
			'type' => 'number',
		],
		[
			'key' => 'studio_area',
			'label' => '床面積',
			'name' => 'studio_area',
			'type' => 'number',
		],
		[
			'key' => 'studio_garden_area',
			'label' => '庭面積',
			'name' => 'studio_garden_area',
			'type' => 'number',
		],
		[
			'key' => 'studio_room_height',
			'label' => '室内高',
			'name' => 'studio_room_height',
			'type' => 'number',
		],
		[
			'key' => 'studio_electricity_capacitance',
			'label' => '電気容量',
			'name' => 'studio_electricity_capacitance',
			'type' => 'number',
		],
		[
			'key' => 'studio_parking_capacity',
			'label' => '駐車場',
			'name' => 'studio_parking_capacity',
			'type' => 'number',
		],
		[
			'key' => 'studio_carry_in_vehicle',
			'label' => '搬入車',
			'name' => 'studio_carry_in_vehicle',
			'type' => 'textarea',
			'return_format' => 'br',
		],
		[
			'key' => 'studio_nearby_parking',
			'label' => '近隣コインP',
			'name' => 'studio_nearby_parking',
			'type' => 'link',
		],
		[
			'key' => 'studio_access',
			'label' => 'アクセス',
			'name' => 'studio_access',
			'type' => 'text',
		],
		[
			'key' => 'studio_google_map',
			'label' => 'google mapのリンク',
			'name' => 'studio_google_map',
			'type' => 'link',
		],
		[
			'key' => 'studio_facility',
			'label' => '設備',
			'name' => 'studio_facility',
			'type' => 'textarea',
			'return_format' => 'br',
		],
		[
			'key' => 'studio_topic',
			'label' => 'トピック',
			'name' => 'studio_topic',
			'type' => 'repeater',
			'layout' => 'block',
			'sub_fields' => [
				[
					'key' => 'studio_topic_slug',
					'label' => 'トピックのターム',
					'name' => 'studio_topic_slug',
					'type' => 'select',
					'choices' => vanilla_get_topics(),
					'return_format' => ''
				],
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
