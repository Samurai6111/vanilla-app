<?php
add_action('init', 'Suumo_Table::init');
class Suumo_Table {

	const MENU_SLUG         = 'suumo-setting-page';
	const CREDENTIAL_ACTION = self::MENU_SLUG . '_nonce_action';
	const CREDENTIAL_NAME   = self::MENU_SLUG . '_nonce_key';

	static function init() {
		return new self();
	}

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

		if (is_admin() && current_user_can('administrator')) {
			// メニュー追加
			add_action('admin_menu', [$this, 'set_plugin_menu']);
		}
	}

	function set_plugin_menu() {
		add_menu_page(
			'Summo',           /* ページタイトル*/
			'Suumo',           /* メニュータイトル */
			'manage_options',         /* 権限 */
			self::MENU_SLUG,    /* ページを開いたときのURL */
			[$this, 'suumo_setting_page'],       /* メニューに紐づく画面を描画するcallback関数 */
			'dashicons-format-gallery', /* アイコン see: https://developer.wordpress.org/resource/dashicons/#awards */
			99                          /* 表示位置のオフセット */
		);
	}

	function insert_suumo_table_data_form() {
?>
		<form action="" method="GET">
			<input type="text" name="suumo_url">
		</form>
	<?php
	}

	function suumo_setting_page() { ?>
		<div class="wrap">
			<h1><b>Suumo設定</b></h1>

			<form action="" method='post' id="my-submenu-form">

				<?php wp_nonce_field(self::CREDENTIAL_ACTION, self::CREDENTIAL_NAME) ?>

				<h2>Suumo</h2>
				<table class="form-table">
				</table>
				<input type='submit' value='保存' class='button button-primary button-large'>
				</p>
			</form>
		</div>
	<?php

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
		$columns = Self::get_table_columns();
		$column_keys = array_keys($columns);
		$values_row = Self::get_table_values();

	?>
		<form action="<?php echo get_permalink(); ?>" method="POST">
			<?php vanilla_wp_nonce_field('suumo_table') ?>
			<div class="suumoTableContainer">
				<table class="suumoTable">
					<thead>
						<tr>
							<th class="">
								編集
							</th>

							<?php foreach ($columns as $key => $name) { ?>
								<th class="<?php echo esc_attr('-' . $key) ?>">
									<?php echo esc_html($name) ?>
								</th>
							<?php } ?>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($values_row as $values) { ?>
							<tr class="">
								<?php
								$i = -1;
								foreach ($values as $value) {
									++$i;
									$column_key = $column_keys[$i];
								?>

									<?php if ($i === 0) { ?>
										<td>
											<button class="-reset" type="submit" name="suumo_table_form_action" value="delete">削除</button>

											<button class="-reset" type="button" onclick="suumo_data_edit_mode(event)">編集</button>


										</td>
									<?php } ?>


									<td class="<?php echo esc_attr('-' . $column_key) ?>">
										<input type="hidden" name="<?php echo esc_attr($column_key) ?>" value="<?php echo esc_attr($value) ?> ">
										<?php if ($column_key === 'link') { ?>
											<a href="<?php echo esc_url($value) ?>" target="_blank" rel="noopener">物件URL</a>
										<?php } else { ?>
											<?php echo esc_html($value) ?>
										<?php } ?>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</form>
<?php
	}
}
