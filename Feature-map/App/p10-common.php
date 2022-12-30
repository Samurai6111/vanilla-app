<?php

/**
 * 配列をURLのパラメータに変換する
 *
 * @param array $array
 * @return
 */
function array_to_url_param($array) {
	if (is_array($array)) {
		$result = http_build_query($array);
	} else {
		$result = false;
	}

	return $result;
}


/**
 * 配列をチェックする
 *
 * @param $array
 */
function check_csv_data_array($array) {
	if (
		is_array($array) &&
		!empty($array)
	) {
		return true;
	} else {
		return false;
	}
}

/**
 * input type="file"でアップロードされたcsvファイルを
 * 配列に変換する
 *
 * @param string $input_name inputタグのname属性
 * @return
 */
function uploaded_csv_to_array($input_name) {

	$csv_directory = get_theme_file_path() . '/Feature-map/Assets/Csv/';

	if (is_uploaded_file($_FILES[$input_name]["tmp_name"])) {
		$file_tmp_name = $_FILES[$input_name]["tmp_name"];
		$file_name = $_FILES[$input_name]["name"];
		$csv_file = $csv_directory . $file_name;

		//= 拡張子を判定 ====
		if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
			$result = 'CSVファイルのみ対応しています。';
		} else {

			//= ファイルをdataディレクトリに移動 ====
			if (move_uploaded_file($file_tmp_name, $csv_file)) {

				//= 後で削除できるように権限を644に ====
				chmod($csv_file, 0644);
				$msg = $file_name . "をアップロードしました。";
				$file = $csv_file;
				$fp = fopen($file, "r");

				//= 配列に変換する ====
				while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
					$return_array[] = $data;
				}
				fclose($fp);
				//= ファイルの削除 ====
				unlink($csv_file);

				$result = $return_array;
			} else {
				$result = "ファイルをアップロードできません。";
			}
		}
	} else {
		$result = "ファイルが選択されていません。";
	}

	return $result;
}





/**
 * csvデータを処理した後のリダイレクト
 *
 * @param
 * @return
 */
function csv_form_redirect() {
	$csv_data_array = uploaded_csv_to_array('csvfile');

	session_start();
	$_SESSION['csv_data_array'] = $csv_data_array;

	$return_url = "/map-form/?status=address-selection";

	if (check_csv_data_array($csv_data_array)) {
		wp_safe_redirect($return_url);
	}
}


/**
 * csvの配列に緯度と軽度の情報を追加する
 *
 * @param
 * @return
 */
function set_latlng($data) {
	$address_selection_index = $data['address_selection_index'];
	$csv_data_json = str_replace("\\", "", $data['csv_data_json']);
	$csv_data_array = json_decode($csv_data_json);
	$csv_data_array_new = [];

	//= 緯度と軽度のデータを追加 ====
	foreach ($csv_data_array as $i => $csv_data) {
		$address = $csv_data[$address_selection_index];
		$latlng_array = map_get_latlon($address);

		if (!empty($latlng_array)) {
			$latitude = (isset($latlng_array['latitude'])) ? $latlng_array['latitude'] : '';
			$longitude = (isset($latlng_array['longitude'])) ? $latlng_array['longitude'] : '';
			$csv_data['latitude'] = $latitude;
			$csv_data['longitude'] = $longitude;
		}

		$csv_data_array_new[] = $csv_data;
	}

	//= セッションに追加 ====
	session_start();
	$_SESSION['csv_data_array'] = $csv_data_array_new;
}


/**
 * adress indexのデータ送信後のリダイレクト
 *
 * @param
 * @return
 */
function address_selection_redirect($data) {
	set_latlng($data);

	$address_selection_index = $data['address_selection_index'];
	$redirect_url = "/map-form/?status=pin-data-selection";
	$redirect_url .= "&address_selection_index={$address_selection_index}";
	wp_safe_redirect(home_url($redirect_url));
	exit;
}


/**
 * csvデータをlocalstorageに保存する
 *
 * @return
 */
function set_csv_data_json() {

	session_start();
	if (check_csv_data_array($_SESSION['csv_data_array'])) {
		$csv_data_json = json_encode($_SESSION['csv_data_array']);
?>
		<script>
			window.localStorage.setItem('csv_data_json', '<?php echo $csv_data_json ?>')
		</script>
<?php }
	session_destroy();
}
add_action('init', 'set_csv_data_json');
