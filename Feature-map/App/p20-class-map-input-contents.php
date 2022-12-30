<?php
class Map_Input_Contents extends Vanilla_Form_Row_Input_Contents
{

	/**
	 * 住所と使うデータのインデックスを決める
	 */
	function address_selection()
	{


		?>
				<div class="vanillaForm__inputs"
						 id="vanillaForm__inputsAddressSelection">
				</div>

				<script>
					let wrap = $('#vanillaForm__inputsAddressSelection')
					let csv_data_json = window.localStorage.getItem('csv_data_json')
					let csv_data_object = JSON.parse(csv_data_json)
					let csv_data_labels = csv_data_object[0]

					csv_data_labels.forEach(function(item, index) {
						let input_wrap =
							`<div class="vanillaForm__input">
							<input id="${item}" type="radio" placeholder="" name="address_selection_index" value="${index}">
							<label for="${item}" class="vanillaForm__inputLabel">${item}</label>
							</div>`
							wrap.append(input_wrap)
					});
				</script>
			<?php
	}

	/**
	 * ピンデータのインデックスを決める
	 */
	function pin_data_selection()
	{
		// $csv_data_array = vanilla_sanitize_array($_GET)['csv_data'][0];
		// unset($csv_data_array[$_GET['address_selection_index']]);
		// unset($csv_data_array['latitude']);
		// unset($csv_data_array['longitude']);
		?>
				<div class="vanillaForm__inputs" id="vanillaForm__inputsPindataSelection"></div>

				<script src="<?php echo get_template_directory_uri(); ?>/Feature-map/Assets/Js/common.js"></script>
				<script>
					let wrap = $('#vanillaForm__inputsPindataSelection')
					let csv_data_json = window.localStorage.getItem('csv_data_json')
					let csv_data_object = JSON.parse(csv_data_json)

					let csv_data_labels = csv_data_object[0]

					delete csv_data_labels[get_param('address_selection_index')];
					delete csv_data_labels['latitude'];
					delete csv_data_labels['longitude'];

					Object.keys(csv_data_labels).forEach(function(i) {
						let item = csv_data_labels[i]
						let input_wrap =
							`<div class="vanillaForm__input">
							<input id="${item}" type="checkbox" placeholder="" name="pin_data_selection_index_array[]" value="${i}">
							<label for="${item}" class="vanillaForm__inputLabel">${item}</label>
							</div>`
							wrap.append(input_wrap)
					});
				</script>
			<?php
	}


	/**
	 * URLパラメータ上のデータをhiddenのinputタグとして出力する
	 *
	 * @param array $params csvの配列データ
	 * @return
	 */
	static function param_hidden_input($params, $key)
	{
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
	static function hidden_input($key, $value)
	{
		echo "<input type='hidden' name='{$key}' value='{$value}'>";
	}
}
