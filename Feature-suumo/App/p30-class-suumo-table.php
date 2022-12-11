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
		$this->meta_table_name = $wpdb->prefix . 'suumometa';
		$this->column_names = [
			'ID',
			'URL',
			'家賃',
			'管理費',
			'敷金',
			'礼金',
			'間取り',
			'初期費用(概算)',
			'構造',
			'住所',
			'緯度',
			'経度',
		];

		if (is_admin() && current_user_can('administrator')) {
			// メニュー追加
			add_action('admin_menu', [$this, 'set_plugin_menu']);
			add_action('admin_init', [$this, 'save_config']);
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

	//========================
	//設定画面の項目データベースに保存する
	//========================
	function save_config() {

		//== nonceで設定したcredentialのチェック ========
		if (isset($_POST[self::CREDENTIAL_NAME]) && $_POST[self::CREDENTIAL_NAME]) {
			if (check_admin_referer(self::CREDENTIAL_ACTION, self::CREDENTIAL_NAME)) {

				update_option('google_api_key', $_POST['google_api_key']);

				wp_safe_redirect(menu_page_url(self::MENU_SLUG));
			}
		}
	}

	function suumo_setting_page() { ?>
		<div class="wrap">
			<h1><b>Suumo設定</b></h1>

			<form action="" method='post' id="my-submenu-form">

				<?php wp_nonce_field(self::CREDENTIAL_ACTION, self::CREDENTIAL_NAME) ?>

				<h2>Suumo</h2>
				<table class="form-table">
					<tr>
						<th>
							<label for="google_api_key">Google Api Key</label>
						</th>
						<td>
							<input type="text" name="google_api_key" id="google_api_key" value="<?php echo esc_attr(get_option('google_api_key')) ?>">
						</td>
					</tr>
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
		$colummn_slugs = array_splice($colummn_slugs, 0, 12);
		$table_columns = array_combine($colummn_slugs, $this->column_names);
		$table_columns = array_merge($table_columns, $columns_added);

		return $table_columns;
	}

	/**
	 * テーブルの値取得
	 */
	function get_table_values() {
		global $wpdb, $current_user;

		$column_name = @array_keys($_GET['sort'])[0];
		$order = strtoupper(@array_values($_GET['sort'])[0]);
		$sort = "ORDER BY `{$column_name}` $order";
		$select_array = [
			"ID",
			"link",
			"rent",
			"management_fee",
			"deposit",
			"retainer_fee",
			"room_arragement",
			"initial_fee",
			"construction",
			"address",
			"latitude",
			"longitude",
		];

		$select_str1 = implode(',', $select_array);
		$select_sql = array_map(function ($value) {
			return "{$this->table_name}.$value";
		}, $select_array);
		$select_str2 = implode(',', $select_sql);

		//= メタデータを含めたソート ====
		if (strpos($column_name, 'suumo_table_meta_') !== false) {
			$sql = "SELECT {$select_str2}
			FROM {$this->table_name}
			INNER JOIN {$this->meta_table_name} ON ( {$this->table_name}.ID = {$this->meta_table_name}.suumo_id )
			WHERE 1=1 AND
			{$this->meta_table_name}.meta_key = '{$column_name}' AND
			user_id = {$current_user->ID}
			GROUP BY {$this->table_name}.ID
			ORDER BY {$this->meta_table_name}.meta_value+0 {$order}
			";
		}
		//= wp_suumoのソート ====
		elseif ($column_name && $order) {
			$sql =  "SELECT $select_str1 FROM {$this->table_name} WHERE user_id = {$current_user->ID} {$sort}";
		}
		//= デフォルト ====
		else {
			$sql =  "SELECT $select_str1 FROM {$this->table_name} WHERE user_id = {$current_user->ID}";
		}
		$table_values = $wpdb->get_results($sql, OBJECT);

		return $table_values;
	}


	/**
	 * カラムを出力するときにフォーマットする
	 *
	 * @param $value 値
	 * @param $key キー
	 */
	function format_suumo_column($key) {
		$columns = Self::get_table_columns();


		if (
			$key === 'rent' ||
			$key === 'management_fee' ||
			$key === 'deposit' ||
			$key === 'retainer_fee' ||
			$key === 'room_arragement' ||
			$key === 'initial_fee'
		) {
			$column_name = @array_keys($_GET['sort'])[0];
			if (
				$column_name === $key &&
				@array_values($_GET['sort'])[0] === 'asc'
			) {
				$order = 'desc';
			} else {
				$order = 'asc';
			}
			$return =
				'<form action="' . get_permalink() . '#suumoTable" type="GET" class="suumoTable__sortButtonWrap ' . esc_attr('-' . $order) . '">' .
				'<button type="submit" class="-reset" name="sort[' . $key . ']" value="' . $order . '">' . $columns[$key] . '</button>' .
				'</form>';
		} else {
			$return = "<p class='suumoTable__thText'>{$columns[$key]}</p>";
		}

		return $return;
	}


	/**
	 * データを出力するときにフォーマットする
	 *
	 * @param $value 値
	 * @param $key キー
	 */
	function format_suumo_value($value, $key) {
		if ($key === 'link') {
			$return = '<a href="' . esc_url($value) . '" target="_blank" rel="noopener">掲載サイトへ</a>';
		} elseif (
			$key ===  'rent' ||
			$key ===  'management_fee' ||
			$key ===  'deposit' ||
			$key ===  'retainer_fee' ||
			$key ===  'initial_fee'
		) {
			$return = '¥' . num($value);
		} elseif ($key === 'address') {
			$return = '<a href="' . vanilla_get_googlemap_url($value) . '" target="_blank" rel="noopener">' . $value . '</a>';
		} else {
			$return = $value;
		}

		return $return;
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

			<div class="classsuumoTable__actions">
				<select name="suumo_table_form_action">
					<option value="" disabled selected>編集 ▼</option>
					<option value="update">更新</option>
					<option value="delete">削除</option>
				</select>

				<?php
				suumo_button_type1([
					'text' => '適用',
					'class' => '-smallest -no-shadow',
				])
				?>
			</div>
			<div class="suumoTableContainer">

				<table class="suumoTable" id="suumoTable">
					<thead>
						<tr>
							<th class="suumoTable__firstTh">

							</th>

							<?php foreach ($columns as $key => $name) { ?>
								<th class="<?php echo esc_attr('-' . $key) ?>">
									<?php echo Self::format_suumo_column($key) ?>
								</th>
							<?php } ?>

							<?php do_action('suumo_table_custom_column_lables') ?>
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
											<div class="suumoTable__checkboxFirst">
												<input type="checkbox" name="<?php echo esc_attr($column_key) ?>[]" value="<?php echo esc_attr($value) ?> ">
											</div>
										</td>
									<?php } ?>


									<td class="<?php echo esc_attr('-' . $column_key) ?>">
										<?php $result = Self::format_suumo_value($value, $column_key) ?>
										<?php echo wp_kses_post($result) ?>
									</td>
								<?php } ?>

								<?php

								$suumo_id = $values->ID;
								do_action('suumo_table_custom_column_values', $suumo_id) ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</form>

<?php
	}

	function get_suumo_urls() {
		global $wpdb;
		$results = $wpdb->get_results("SELECT link FROM {$this->table_name}", OBJECT );
		$results = array_map(function ($value) {
			return $value->link;
		}, $results);

		return $results;

	}
}
