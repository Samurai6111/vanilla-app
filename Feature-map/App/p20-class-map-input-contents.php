<?php
class Map_Input_Contents extends Vanilla_Form_Row_Input_Contents {

	/**
	 * 住所と使うデータのインデックスを決める
	 */
	function address_selection() {
		$csv_data_array = vanilla_sanitize_array($_GET)['csv_data'][0];
?>
		<div class="vanillaForm__inputs">
			<?php foreach ($csv_data_array as $index => $text) { ?>
				<div class="vanillaForm__input">
					<?php

					Vanilla_Form_Row_Input::radio(
						[
							'name' => 'address_selection_index',
							'value' => $index,
							'text' => $text,
							'id' => $text,
							'attr' => '',
						],
					);
					?>
				</div>
			<?php } ?>
		</div>
	<?php
	}

	/**
	 * ピンデータのインデックスを決める
	 */
	function pin_data_selection() {
		$csv_data_array = vanilla_sanitize_array($_GET)['csv_data'][0];
		unset($csv_data_array[$_GET['address_selection_index']]);
	?>
		<div class="vanillaForm__inputs">
			<?php foreach ($csv_data_array as $index => $text) { ?>
				<div class="vanillaForm__input">
					<?php

					Vanilla_Form_Row_Input::checkbox(
						[
							'name' => 'pin_data_selection_index_array',
							'value' => $index,
							'text' => $text,
							'id' => $text,
							'attr' => '',
						],
					);
					?>
				</div>
			<?php } ?>
		</div>
<?php
	}

	/**
	 * URLパラメータ上のcsvのデータをhiddenのインプットに変換する
	 *
	 * @param array $params csvの配列データ
	 * @return
	 */
	static function csv_hidden_input($params) {
		if (!empty($params) && isset($params['csv_data'])) {
			$csv_data_array = $params['csv_data'];
			foreach ($csv_data_array as $index => $csv_data) {
				foreach ($csv_data as $i => $value) {
					$name_attr = esc_attr("csv_data[{$index}][$i]");
					$value_attr = esc_attr($value);
					echo "<input type='hidden' name='{$name_attr}' value='{$value_attr}'>";

					if (count($csv_data) === ($i + 1)) {
						$latlon_array = map_get_latlon($csv_data[$params['address_selection_index']]);

						$latitude_attr = esc_attr("csv_data[{$index}][latitude]");
						$latitude_value = $latlon_array["latitude"];
						$longitude_attr = esc_attr("csv_data[{$index}][longitude]");
						$longitude_value = $latlon_array["longitude"];

						echo "<input type='hidden' name='{$latitude_attr}' value='{$latitude_value}'>";
						echo "<input type='hidden' name='{$longitude_attr}' value='{$longitude_value}'>";
					}
				}
			}
		} else {
			return false;
		}
	}


	/**
	 * URLパラメータ上のデータをhiddenのinputタグとして出力する
	 *
	 * @param array $params csvの配列データ
	 * @return
	 */
	static function param_hidden_input($params, $key) {
		if (!empty($params) && isset($params[$key])) {
			echo "<input type='hidden' name='{$key}' value='{$params[$key]}'>";
		} else {
			return false;
		}
	}
	/**
	 * hiddenのinputタグとして出力する
	 *
	 * @param array $params csvの配列データ
	 * @return
	 */
	static function hidden_input($key, $value) {
		echo "<input type='hidden' name='{$key}' value='{$value}'>";
	}
}
