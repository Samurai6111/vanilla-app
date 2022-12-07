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
	 * suumo_url_formの送信処理
	 *
	 * *  @param $data $_POSTを代入
	 */
	function insert_suumo_data($data) {
		global $wpdb, $suumo_table_name;
		$suumo_url = $data['suumo_url'];
		$suumo_data = Self::get_suumo_data_by_url($data);

		if (
			$suumo_url &&
			$suumo_data &&
			!vanilla_suumo_url_exists($suumo_url)
		) {
			$suumo_data['link'] = $suumo_url;
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
			<form action="<?php echo get_permalink(); ?>" class="suumoUrlForm" id="suumoUrlForm" method="POST">

				<?php vanilla_wp_nonce_field('insert_suumo_data') ?>
				<input class="suumoUrlForm__urlInput" type="text" name="suumo_url">
				<p class="-color-red">
					<?php echo esc_html($insert_suumo_data_validation['suumo_url']); ?>
				</p>

				<button type="submit">登録</button>
			</form>


		</div>
<?php

	}
}
