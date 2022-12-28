<?php



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
				$fp   = fopen($file, "r");

				//= 配列に変換する ====
				while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
					$return_array[] = $data;
				}
				fclose($fp);
				//= ファイルの削除 ====
				unlink($csv_file);

				$result['csv_data'] = $return_array;
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


function csv_redirect() {
	$csv_data = uploaded_csv_to_array('csvfile');
	$url_param = array_to_url_param($csv_data);
	$return_url = ($url_param) ? "/map-form/?{$url_param}&status=address-selection" : '';

	if ($return_url) {
		wp_safe_redirect($return_url);
	}
}
