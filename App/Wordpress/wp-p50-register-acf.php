<?php
// if (function_exists('acf_add_local_field_group')) {
// 	$acf_broup_name = 'facility_calculation';
// 	acf_add_local_field_group(array(
// 		'key' => 'facility_calculation',
// 		'title' => '見積もり計算のデータ',
// 		'fields' => [
// 			[
// 				'key' => 'field_' . wp_unique_id(),
// 				'label' => '区画分け',
// 				'name' => 'fc_is_divisible',
// 				'type' => 'select',
// 				'prefix' => '',
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 0,
// 				'wrapper' => array(
// 					'width' => '',
// 					'class' => '',
// 					'id' => '',
// 				),
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'maxlength' => '',
// 				'readonly' => 0,
// 				'disabled' => 0,
// 			]
// 		],
// 		'location' => array(
// 			array(
// 				array(
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'facility',
// 				),
// 			),
// 		),
// 		'menu_order' => 0,
// 		'position' => 'normal',
// 		'style' => 'default',
// 		'label_placement' => 'top',
// 		'instruction_placement' => 'label',
// 		'hide_on_screen' => '',
// 	));
// }