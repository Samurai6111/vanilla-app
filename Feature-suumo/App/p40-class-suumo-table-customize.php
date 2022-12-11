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
		$i = 0;
		foreach ($suumo_table_custom_lables as $lable) {
			++$i;
			$key = "suumo_table_meta_{$i}";
			$key_GET = (isset($_GET['sort'])) ? array_keys($_GET['sort'])[0] : '';

			if (
				$key === $key_GET &&
				@array_values($_GET['sort'])[0] === 'asc'
			) {
				$order = 'desc';
			} else {
				$order = 'asc';
			}

			$return =
				'<form action="' . get_permalink() . '#suumoTable" type="GET" class="suumoTable__sortButtonWrap ' . esc_attr('-' . $order) . '">' .
				'<button type="submit" class="-reset" name="sort[' . $key . ']" value="' . $order . '">' . $lable . '</button>' .
				'</form>';
?>
			<th class="<?php echo esc_attr('-' . $key) ?>">
				<?php echo ($return) ?>
			</th>
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
function my_suumo_table_custom_column_values($suumo_id) {
	global $current_user;
	$user_id = $current_user->ID;

	$suumo_table_custom_lable_json = get_user_meta($user_id, 'suumo_table_custom_lable_json', true);
	$suumo_table_custom_lables = json_decode($suumo_table_custom_lable_json);

	if (!empty($suumo_table_custom_lables)) {
		$i = 0;
		foreach ($suumo_table_custom_lables as $lable) {
			++$i;

			$meta_key = "suumo_table_meta_{$i}";
	?>
			<td>
				<input type="number" name="<?php echo esc_attr("{$meta_key}__{$suumo_id}") ?>" size="5" value="<?php echo esc_attr(get_suumo_meta($suumo_id, $meta_key)) ?>" onchange="checkbox_first_turned_checked(event)" inputmode="numeric"> 分
			</td>
		<?php } ?>
	<?php } ?>
<?php

}
add_action('suumo_table_custom_column_values', 'my_suumo_table_custom_column_values');
