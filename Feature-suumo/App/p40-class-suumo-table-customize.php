<?php

/**
 * テーブルのカラムに追加項目を増やす
 *
 * @param
 * @return
 */
function my_suumo_table_custom_column_lables() {
	global $current_user;
	$user_id = $current_user->ID;

	$suumo_table_custom_lable_json = get_user_meta($user_id, 'suumo_table_custom_lable_json', true);
	$suumo_table_custom_lables = json_decode($suumo_table_custom_lable_json);

	if (!empty($suumo_table_custom_lables)) {
		foreach ($suumo_table_custom_lables as $lable) {
?>
			<th><?php echo esc_html($lable) ?></th>
		<?php } ?>
	<?php } ?>
<?php

}
add_action('suumo_table_custom_column_lables', 'my_suumo_table_custom_column_lables');

/**
 * テーブルのバリューに追加項目を増やす
 *
 * @param
 * @return
 */
function my_suumo_table_custom_column_values() {
	global $current_user;
	$user_id = $current_user->ID;

	$suumo_table_custom_value_json = get_user_meta($user_id, 'suumo_table_custom_value_json', true);
	$suumo_table_custom_values = json_decode($suumo_table_custom_value_json);

	if (!empty($suumo_table_custom_values)) {
		foreach ($suumo_table_custom_values as $value) {
?>
			<th><?php echo esc_html($value) ?></th>
		<?php } ?>
	<?php } ?>
<?php

}
// add_action('suumo_table_custom_column_values', 'my_suumo_table_custom_column_values');
