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
		$this->colummn_all_slugs = $wpdb->get_col("DESC {$this->table_name}", 0);
		$this->colummn_slugs =array_diff($this->colummn_all_slugs, ['user_id']);
		$this->column_names = [
			'ID',
			'画像',
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

		if (count($this->colummn_slugs) === count($this->column_names)) {

			$this->table_columns = array_combine($this->colummn_slugs, $this->column_names);
		} else {
			$this->table_columns = [];

		}
	}


	/**
	 * wp_suumoのテーブルからカラム名を配列で取得する
	 * 引数を指定した場合、カラム名と引数の配列を合体させて出力する
	 *
	 * @param $columns_added = [key => value]
	 */
	function get_table_columns($columns_added = []) {
		global $wpdb;

		// $table_columns = array_combine($this->colummn_slugs, $this->column_names);
		$table_columns = array_merge($this->table_columns, $columns_added);

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
		$select_array = $this->colummn_slugs;

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
			$sql =  "SELECT $select_str1 FROM {$this->table_name} WHERE user_id = {$current_user->ID} ORDER BY `ID` DESC";
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
			$href = get_permalink() . "/?sort[{$key}]={$order}#suumoTable";
			$href = esc_url($href);
			$return = "<a class='suumoTable__thText -sort -{$order}' href='{$href}'>{$columns[$key]}</a>";
		} else {
			$return = "<p class='suumoTable__thText'>{$columns[$key]}</p>";
		}

		return $return;
	}


	function get_suumo_slider($image_json) {

		$image_array = json_decode($image_json);

		$slides = '';
		if ($image_array && !empty($image_array)) {
			foreach ($image_array as $image) {
				$slide = "<div class='swiper-slide'><figure class='suumotable__swiperFigure'><img src='{$image}'></figure></div>";
				$slides .= $slide;
			}

			$magnifying_glass_img = get_template_directory_uri() . '/Feature-suumo/Image/icon_magnifying_glass_navy_1.svg';
			$slider =
			"<div class='suumotable__swiperWrap'>" .
			"<img class=\"suumotable__swiperMagnifiy js__modal__trigger\" src=\"{$magnifying_glass_img}\" alt=\"虫眼鏡\"
			 data-modal-target=\"suumotable__swiper\">" .
			"<div class='suumotable__swiper'>" .
			"<div class='swiper-wrapper'>" .
			$slides .
			"</div>" .
			"<div class='suumotable__swiperButton swiper-button-prev'></div>" .
			"<div class='suumotable__swiperButton swiper-button-next'></div>" .
			"</div>" .
			"</div>";

			return $slider;
		} else {
			return false;
		}
	}


	/**
	 * データを出力するときにフォーマットする
	 *
	 * @param $value 値
	 * @param $key キー
	 */
	function format_suumo_value($value, $key) {
		if ($key === 'images') {
			$return = Self::get_suumo_slider($value);
		} elseif ($key === 'link') {
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
					<option value="favorite">お気に入り</option>
				</select>

				<?php
				suumo_button_type1([
					'text' => '適用',
					'class' => '-smallest -no-shadow',
				])
				?>
			</div>
			<div class="suumoTableContainer -custom-scrolbar">

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
						<?php foreach ($values_row as $values) {
							$suumo_id = $values->ID;

							$meta_is_favorite = get_suumo_meta($suumo_id, 'is_favorite');
							$is_favorite = ($meta_is_favorite === 'is_favorite') ? '-is-favorite' : '';
						?>
							<tr class="<?php echo esc_attr($is_favorite) ?>">
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
		$results = $wpdb->get_results("SELECT link FROM {$this->table_name}", OBJECT);
		$results = array_map(function ($value) {
			return $value->link;
		}, $results);

		return $results;
	}
}
