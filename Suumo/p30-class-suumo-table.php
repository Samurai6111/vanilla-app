<?php
class Suumo_Table {

	function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'suumo';
		$this->column_names = [
			'ID',
			'URL',
			'家賃',
			'管理費',
			'敷金',
			'礼金',
			'間取り',
			'初期費用',
			'構造',
			'家賃',
		];
	}

	/**
	 * wp_suumoのテーブルからカラム名を配列で取得する
	 * 引数を指定した場合、カラム名と引数の配列を合体させて出力する
	 *
	 * @param $columns_added = [key => value]
	 */
	function get_table_columns($columns_added = []) {
		global $wpdb;
		$colummn_slugs = $wpdb->get_col("DESC {$this->table_name}", 0);
		$table_columns = array_combine($colummn_slugs, $this->column_names);
		$table_columns = array_merge($table_columns, $columns_added);

		return $table_columns;
	}

	/**
	 * テーブルの値取得
	 */
	function get_table_values() {
		global $wpdb;
		$table_values = $wpdb->get_results("SELECT * FROM $this->table_name", OBJECT);

		return $table_values;
	}


	/**
	 * テーブルをHTMLで出力する
	 */
	function echo_suumo_table() {
		$columns = self::get_table_columns();
		$column_keys = array_keys($columns);
		$values_row = self::get_table_values();
?>
		<table class="suumoTable">
			<thead>
				<tr>
					<?php foreach ($columns as $key => $name) { ?>
						<th class="<?php echo esc_attr('-' . $key) ?>">
							<?php echo esc_html($name) ?>
						</th>
					<?php } ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($values_row as $values) ?>
				<tr>
					<?php
					$i = -1;
					foreach ($values as $value) {
						++$i;
						$column_key = $column_keys[$i];
					?>
						<td class="<?php echo esc_attr('-' . $column_key) ?>">
							<?php if ($column_key === 'link') { ?>
								<a href="<?php echo esc_url($value) ?>" target="_blank" rel="noopener"><?php echo esc_html($value) ?></a>
							<?php } else { ?>
								<?php echo esc_html($value) ?>
							<?php } ?>
						</td>
					<?php } ?>
				</tr>
			</tbody>
		</table>
<?php
	}
}

$suumo_table = new Suumo_Table();
echo '<pre>';
var_dump($suumo_table->get_table_columns());
var_dump($suumo_table->get_table_values());
echo '</pre>';

$suumo_table->echo_suumo_table();
