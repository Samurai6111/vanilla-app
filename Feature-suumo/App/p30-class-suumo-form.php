<?php

class Suumo_Form {
	function __construct() {
		$this->suumo_selectors = [
			'images' => '#js-view_gallery-navlist > li > a.property_view_thumbnail > img.property_view_thumbnail-img',
			'rent' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-main > div > div.property_view_main-emphasis',
			'management_fee' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-main > div > div.property_view_main-data > div > div.property_data-body',
			'deposit' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-sub > ul > li:nth-child(1) > div > div.property_data-body > span:nth-child(1)',
			'retainer_fee' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(2) > div > div.property_view_detail-body > div > div.property_view_detail-info-sub > ul > li:nth-child(1) > div > div.property_data-body > span:nth-child(3)',
			'room_arragement' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(3) > div.l-property_view_detail-main > div > div.property_view_detail-body > ul > li:nth-child(1) > div > div.property_data-body',
			'initial_fee' => '',
			'construction' => "#contents > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(4)",
			'address' => '#js-view_gallery > div > div.property_view-detail > div:nth-child(3) > div.l-property_view_detail-sub > div:nth-child(2) > div > div.property_view_detail-body > div',
		];
	}



	/**
	 *  テーブルからIDを削除
	 *
	 *  @param $data $_POSTを代入
	 */
	function delete_suumo_data($data) {
		global $wpdb, $suumo_table_name;

		if (!empty($data['ID'])) {
			foreach ($data['ID'] as $suumo_id) {
				$result = $wpdb->delete($suumo_table_name, ['ID' => $suumo_id]);
			}
		} else {
			$result = false;
		}

		return $result;
	}

	/**
	 *  テーブルを丸ごとアップデート
	 *
	 *  @param $data $_POSTを代入
	 */
	function update_table_meta($data) {
		global $wpdb, $suumo_table_name;

		foreach ($data as $key => $value) {
			if (strpos($key, 'suumo_table_meta_') !== false) {
				$pieces = explode("__", $key);
				$suumo_id = $pieces[1];
				$meta_key = $pieces[0];
				update_suumo_meta($suumo_id, $meta_key, $value);
			}
		}

		return true;
	}

	/**
	 *  お気に入りのアップデート
	 *
	 *  @param $data $_POSTを代入
	 */
	function update_favorite($data) {
		global $wpdb, $suumo_table_name;
		if (!empty($data['ID'])) {
			foreach ($data['ID'] as $suumo_id) {
				$is_favarite = get_suumo_meta($suumo_id, 'is_favorite');
				if ($is_favarite === 'is_favorite') {
					update_suumo_meta($suumo_id, 'is_favorite', '');
				} else {
					update_suumo_meta($suumo_id, 'is_favorite', 'is_favorite');
				}
				$result = true;
			}
		} else {
			$result = false;
		}

		return $result;
	}

	// function

	/**
	 *  URLから物件情報を取得する
	 *
	 *  @param $data $_POSTを代入
	 */
	function get_suumo_data_by_url($suumo_url) {

		//= ファイル読み込み ====
		require_once(get_theme_file_path() . "/External-library/phpQuery-onefile.php");

		$suumo_data_array = [];

		$html = file_get_contents($suumo_url);
		$html_document = phpQuery::newDocument($html);


		foreach ($this->suumo_selectors as $key => $suumo_selector) {

			if ($suumo_selector) {

				$suumo_dom = $html_document->find($suumo_selector);

				//= 画像をjsonで取得 ====
				if ($key === 'images') {
					$img_src_array = [];
					for ($i = 0; $i < count($suumo_dom); $i++) {
						$img_src = $html_document->find("{$suumo_selector}:eq({$i})")->attr("data-src");
						$img_src_array[] = $img_src;
					}
					$suumo_data = json_encode($img_src_array, JSON_UNESCAPED_UNICODE);
				}
				//= 家賃,管理費,敷金,礼金を取得 ====
				elseif (
					$key === 'rent' ||
					$key === 'management_fee' ||
					$key === 'deposit' ||
					$key === 'retainer_fee'
				) {
					$suumo_data = vanilla_format_yen_to_int($suumo_dom->text());
				}
				//= それ以外 ====
				else {
					$suumo_data = ($suumo_dom->text()) ? sanitize_text_field($suumo_dom->text()) : '-';
				}
			}

			//= 上記データを全て$suumo_data_arrayに格納 ====
			$suumo_data_array[$key] = $suumo_data;

			//= 初期費用だけ最後に計算 ====
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
		global $current_user;

		$google_maps_key = get_user_meta($current_user->ID, 'suumo_user_google_api_key', true);
		$latlon_array = array();
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
	 * suumoのdbへinsertとreplaceする際に必要なデータを取得する関数
	 *
	 * @param
	 * @return
	 */
	function suumo_data_sql_prepare($suumo_url) {
		global $current_user;

		$suumo_data = Self::get_suumo_data_by_url($suumo_url);
		$lad_lng = self::get_lat_long_by_address($suumo_data['address']);


		if (
			$suumo_url &&
			$suumo_data
		) {
			$suumo_data_to_insert = [
				'images' => [
					'value' => $suumo_data['images'],
					'format' => '%s',
				],
				'link' => [
					'value' => $suumo_url,
					'format' => '%s',
				],
				'rent' => [
					'value' => $suumo_data['rent'],
					'format' => '%d',
				],
				'management_fee' => [
					'value' => $suumo_data['management_fee'],
					'format' => '%d',
				],
				'deposit' => [
					'value' => $suumo_data['deposit'],
					'format' => '%d',
				],
				'retainer_fee' => [
					'value' => $suumo_data['retainer_fee'],
					'format' => '%d',
				],
				'room_arragement' => [
					'value' => $suumo_data['room_arragement'],
					'format' => '%s',
				],
				'initial_fee' => [
					'value' => $suumo_data['initial_fee'],
					'format' => '%d',
				],
				'address' => [
					'value' => $suumo_data['address'],
					'format' => '%s',
				],
				'longitude' => [
					'value' => $lad_lng['longitude'],
					'format' => '%s',
				],
				'latitude' => [
					'value' => $lad_lng['latitude'],
					'format' => '%s',
				],
				'user_id' => [
					'value' => $current_user->ID,
					'format' => '%d',
				],
			];

			$suumo_values = array_map(function ($data) {
				return $data['value'];
			}, $suumo_data_to_insert);
			$suumo_formats = array_column($suumo_data_to_insert, 'format');

			$return = [
				'suumo_values' => $suumo_values,
				'suumo_formats' => $suumo_formats,
			];

			return $return;
		} else {

			return false;
		}
	}

	/**
	 * suumo_url_formの送信処理
	 *
	 * *  @param $data $_POSTを代入
	 */
	function insert_suumo_data($suumo_url) {
		global $wpdb, $suumo_table_name;
		$sql_prepared_data = Self::suumo_data_sql_prepare($suumo_url);

		if (
			!vanilla_suumo_url_exists($suumo_url) &&
			$sql_prepared_data &&
			!empty($sql_prepared_data)
		) {
			$result = $wpdb->insert(
				$suumo_table_name,
				$sql_prepared_data['suumo_values'],
				$sql_prepared_data['suumo_formats']
			);
		} else {
			$result = false;
		}

		return $result;
	}

	/**
	 * スクレイピングのアップデート
	 */
	function replace_suumo_data() {
		global $wpdb, $suumo_table_name;
		$sql = "SELECT link,address FROM {$suumo_table_name}";
		$suumo_data_array = $wpdb->get_results($sql, ARRAY_A);

		$i = 0;
		foreach ($suumo_data_array as $suumo_data) {
			++$i;
			$suumo_data['suumo_url'] = $suumo_data['link'];
			$sql_prepared_data = @Self::suumo_data_sql_prepare($suumo_data);

			if (!$sql_prepared_data && !empty($sql_prepared_data)) {

				$result = $wpdb->replace(
					$suumo_table_name,
					$sql_prepared_data['suumo_values'],
					$sql_prepared_data['suumo_formats']
				);
			}
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
				<?php } else { ?>
					<br>'
				<?php } ?>
				<br><br>

				<div class="suumoUrlForm__buttonWrap">
					<button class="pageSuumo__button" type="submit">登録</button>
				</div>
			</form>

			<form action="<?php echo get_permalink(); ?>" class="suumoUrlForm -cancel" id="suumoUrlForm" method="POST">
				<?php vanilla_wp_nonce_field('insert_suumo_data_cancel') ?>
				<br>
				<div class="suumoUrlForm__buttonWrap">
					<button class="-reset" type="submit">入力のキャンセル</button>
				</div>
			</form>


		</div>
<?php

	}
}
