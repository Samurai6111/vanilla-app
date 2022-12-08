<?php

class Suumo_Form {
	function __construct() {
	}



	/**
	 *  テーブルからIDを削除
	 *
	 *  @param $data $_POSTを代入
	 */
	function delete_suumo_data($data) {
		global $wpdb, $suumo_table_name;
		$suumo_id = $data['ID'];

		if (
			$data['suumo_table_form_action']  === 'delete'
			&& $suumo_id
		) {
			$result = $wpdb->delete($suumo_table_name, ['ID' => $suumo_id]);
		} else {
			$result = false;
		}

		return $result;
	}

	/**
	 *  URLから物件情報を取得する
	 *
	 *  @param $data $_POSTを代入
	 */
	function get_suumo_data_by_url(array $data) {
		// ---------- 例外処理 ----------
		if (!$data || empty($data)) {
			return false;
		}

		global $suumo_xpath_array;
		$suumo_url = $data['suumo_url'];
		$suumo_url_type = 'suumo_surroundings';
		$suumo_data_array = [];

		// ---------- URLからスクレイピング ----------
		$dom = new DOMDocument('1.0', 'UTF-8');
		$html = @file_get_contents($suumo_url);
		@$dom->loadHTML($html);
		$xpath = new DOMXpath($dom);
		foreach ($suumo_xpath_array[$suumo_url_type] as $key => $xpath_query) {
			$suumo_data = $xpath->query($xpath_query)->item(0)->nodeValue;
			if (
				$key === 'rent' ||
				$key === 'management_fee' ||
				$key === 'deposit' ||
				$key === 'retainer_fee'
			) {
				$suumo_data = vanilla_format_yen_to_int($suumo_data);
			} else {
				$suumo_data = ($suumo_data) ? sanitize_text_field($suumo_data) : '-';
			}

			// if ($suumo_data) {
			// ---------- 値を配列に入れる ----------
			$suumo_data_array[$key] = $suumo_data;

			// ---------- 初期費用だけ最後に計算 ----------
			$initial_fee = vanilla_get_approximate_initial_fee(
				$suumo_data_array['rent'],
				$suumo_data_array['management_fee'],
				$suumo_data_array['deposit'],
				$suumo_data_array['retainer_fee']
			);
			$suumo_data_array['initial_fee'] = (int)$initial_fee;
		}

		return $suumo_data_array;
	}

	/**
	 * 住所から緯度と軽度を取得
	 *
	 * @param $address 住所
	 */
	function get_lat_long_by_address($address) {
		$latlon_array = array();
		$google_maps_key = 'AIzaSyAYPh_8YfpapP_jLOagZApdWeLDyL88DWM'; // Remember to have a valid API key
		$region = 'DK';
		$url =    'https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&region=' . $region . '&key=' . $google_maps_key;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);

		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;

		$latlon_array['latitude'] = $lat;
		$latlon_array['longitude'] = $long;

		return $latlon_array;
	}


	/**
	 * suumo_url_formの送信処理
	 *
	 * *  @param $data $_POSTを代入
	 */
	function insert_suumo_data($data) {
		global $wpdb, $suumo_table_name;
		$suumo_url = $data['suumo_url'];
		$suumo_data = Self::get_suumo_data_by_url($data);
		$lad_lng = self::get_lat_long_by_address($suumo_data['address']);

		if (
			$suumo_url &&
			$suumo_data &&
			!vanilla_suumo_url_exists($suumo_url)
		) {
			$suumo_data['link'] = $suumo_url;
			$suumo_data['longitude'] = $lad_lng['longitude'];
			$suumo_data['latitude'] = $lad_lng['latitude'];
			$result = $wpdb->insert(
				$suumo_table_name,
				$suumo_data,
				[
					'%d',
					'%d',
					'%d',
					'%d',
					'%d',
					'%s',
					'%s',
					'%s',
					'%s',
					'%f',
					'%f',
				]
			);

			return $result;
		} else {

			return false;
		}
	}

	/**
	 * URL入力用のフォーム
	 */
	static function suumo_url_form() {
		global $insert_suumo_data_validation;
?>

		<div class="suumoUrlFormContainer">
			<h2 class="suumoUrlForm__title">物件URL入力フォーム</h2>

			<form action="<?php echo get_permalink(); ?>" class="suumoUrlForm" id="suumoUrlForm" method="POST">

				<?php vanilla_wp_nonce_field('insert_suumo_data') ?>
				<input class="suumoUrlForm__urlInput" type="text" name="suumo_url" placeholder="物件のURLを入力してください">

				<?php if (!empty($insert_suumo_data_validation)) { ?>
					<p class="suumoUrlForm__errorText -color-red">
						<?php echo esc_html($insert_suumo_data_validation['suumo_url']); ?>
					</p>
				<?php } ?>

				<div class="suumoUrlForm__buttonWrap">
					<button class="pageSuumo__button" type="submit">登録</button>
				</div>
			</form>

			<form action="<?php echo get_permalink(); ?>" class="suumoUrlForm -cancel" id="suumoUrlForm" method="POST">
				<?php vanilla_wp_nonce_field('insert_suumo_data_cancel') ?>
				<div class="suumoUrlForm__buttonWrap">
					<button class="-reset" type="submit">入力のキャンセル</button>
				</div>
			</form>


		</div>
<?php

	}
}
