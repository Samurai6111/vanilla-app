<?php

class Suumo_Mypage_Form {

	function __construct($data) {
		$this->data = $data;
	}

	/**
	 * メタデータを保存する関数
	 */
	function update_user_meta($key) {
		update_user_meta($this->data['user_id'], $key, $this->data[$key]);
	}

	/**
	 * メタデータを保存する関数
	 */
	function update_user($key) {
		$user_id = wp_update_user([
			'ID' => $this->data['user_id'],
			$key => $this->data[$key],
		]);

		return $user_id;
	}


	/**
	 * ユーザーの情報を保存する
	 *
	 * @param
	 * @return
	 */
	function save_user_info() {
		//= ユーザー情報登録 ====
		$user_id = self::update_user('user_pass');

		//= メタ情報登録 ====
		Self::update_user_meta('suumo_user_google_api_key');
	}

	function get_direction_by_two_location($location1, $location2) {
		https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=YOUR_API_KEY
//

	}


	/**
	 * テーブルカスタマイズ
	 *
	 * @param
	 * @return
	 */
	function table_customize() {

		//= 空白を削除 ====
		$suumo_table_custom_lables = $this->data['suumo_table_custom_lables'];
		$suumo_table_custom_values = $this->data['suumo_table_custom_values'];

		//= jsonに変換 ====
		$suumo_table_custom_lable_json = json_encode($suumo_table_custom_lables, JSON_UNESCAPED_UNICODE);
		$suumo_table_custom_value_json = json_encode($suumo_table_custom_values, JSON_UNESCAPED_UNICODE);

		//= メタデータに保存 ====
		update_user_meta($this->data['user_id'], 'suumo_table_custom_lable_json', $suumo_table_custom_lable_json);
		update_user_meta($this->data['user_id'], 'suumo_table_custom_value_json', $suumo_table_custom_value_json);
	}


	static function the_table_custom_validation($key, $i) {
		global $validations;
		if ($validations[$key][$i]) { ?>
			<p class="-color-red"><?php echo esc_html($validations[$key][$i]) ?></p>
		<?php }
	}


	/**
	 * ユーザーのテーブルカスタマイズ部分を出力する関数
	 */
	static function the_suumo_user_table_customs() {
		global $current_user, $validations;
		$user_id = $current_user->ID;

		$suumo_table_custom_lable_json = get_user_meta($user_id, 'suumo_table_custom_lable_json', true);
		$suumo_table_custom_lables = json_decode($suumo_table_custom_lable_json);

		if (!empty($suumo_table_custom_lables)) {
			$i = 0;
			foreach ($suumo_table_custom_lables as $lable) {
			?>
				<tr>
					<td>
						<div class="pageMypageTable__tdHasButton">
							<input class="-reset" type="text" name="suumo_table_custom_lables[]" size="50" value="<?php echo esc_attr($lable) ?>" required>

							<?php suumo_button_type1([
								'text' => '×',
								'attr' => 'type=button onclick=remove_suumo_table_custom_column(event)',
								'tag' => 'button',
								'class' => '-color-reverse -small',
							]) ?>
						</div>
					</td>
				</tr>
			<?php
				++$i;
			} ?>
		<?php } ?>

		<script>
			function remove_suumo_table_custom_column(e) {
				let target = $(e.target)
				target.parents('tr').remove()
			}
		</script>
<?php

	}
}
