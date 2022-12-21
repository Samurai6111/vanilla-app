<?php
	$params = vanilla_sanitize_array($_GET);
if (isset($params['csv_data'])) {
	//= csvデータ ====
	$label_array = $params['csv_data'][0];
	$label_json = json_encode($label_array);

	//= csvデータ ====
	$csv_data_array = $params['csv_data'];
	unset($csv_data_array[0]);
	$csv_data_json = json_encode($csv_data_array);

	//= pinデータ ====
	$pin_data_selection_index_array = $params['pin_data_selection_index_array'];
	$pin_data_index_json = json_encode($pin_data_selection_index_array);
?>

<script>
	var map;
	var marker = [];
	var infoWindow = [];

	/**
	 * テーブルから物件情報を取得する
	 */
	function csv_values() {
		let values_json = '<?php echo $csv_data_json ?>'
		let values_array = JSON.parse(values_json)

		return values_array
	}

	/** --------------------------------
	* URLのパラメータの値を取得する
	*
	* @param key
	*/
	function get_param(key) {
		let current_url = '<?php echo esc_url(get_permalink()); ?>'
		let url = new URL(current_url);
		let search_params = url.searchParams;
		return search_params.get(key);
	}

	/** --------------------------------
	* ピンでーたの配列
	*
	* @param
	*/
	function get_pin_contents(value) {
		//== csvデータ ========
		let pin_data_index_json = '<?php echo $pin_data_index_json ?>'
		let pin_data_index_array = JSON.parse(pin_data_index_json)

		//== ラベル ========
		let label_json = '<?php echo $label_json ?>'
		let label_array = JSON.parse(label_json)

		let html = '<table>'
		pin_data_index_array.forEach(index => {
			html += '<tr>' +
			'<th>' + label_array[index] + '</th>' +
			'<td>' + value[index] + '</td>' +
			'</tr>'
		});
		html += '</table>'

		return html
	}

	//== 対象のDOM ========
	let target_map = document.getElementById('map')

	/** --------------------------------
	 * initMap
	 */
	function initMap() {

		// ---------- 変数 ----------
		let geocoder = new google.maps.Geocoder();
		let values = csv_values()
		let center = values[1]

		// 地図の作成
		let center_mapLatLng = new google.maps.LatLng({
			lat: parseFloat(center['latitude']),
			lng: parseFloat(center['longitude'])
		});
		map = new google.maps.Map(target_map, { // #sampleに地図を埋め込む
			center: center_mapLatLng, // 地図の中心を指定
			zoom: 11 // 地図のズームを指定
		});


		// マーカー毎の処理
		Object.keys(values).forEach(function (i) {
			let value = values[i]

			//== 緯度経度のデータ取得 ========
			let latitude = parseFloat(value['latitude'])
			let longitude = parseFloat(value['longitude'])

			if (latitude && longitude) {

				//== マーカーの緯度と経度 ========
				let markerLatLng = new google.maps.LatLng({
					lat: latitude,
					lng: longitude
				});

				//== マーカーをセット ========
				marker[i] = new google.maps.Marker({
					position: markerLatLng,
					map: map,
					animation: google.maps.Animation.DROP
				});

				//== マーカーにクリックイベントを追加 ========
				markerEvent(i);

				//== マーカーの吹き出しの中身 ========
				let pin_contents = get_pin_contents(value);
				let infoWindowContent = '<div class="pinInfo">' + pin_contents + '</div>'
				infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
					content: infoWindowContent // 吹き出しに表示する内容
				});
			}
		})
	}

	// /** --------------------------------
	//  * googleマップのピンをクリックしたらサイドバーがスクロールする
	//  *
	//  * @param sidebar_item_id
	//  */
	// function sidebar_item_scroll(sidebar_item_id) {
	// 	let sidebar_google_map = $('#sidebarGooglemap')
	// 	let sidebar_item = sidebar_google_map.find('.sidebarGooglemap__item')
	// 	let target = $('#' + sidebar_item_id)
	// 	let position_top = target.data('position-top')

	// 	//== スクロール ========
	// 	sidebar_google_map.animate({
	// 		scrollTop: position_top
	// 	}, 500);

	// 	//== クラス付与 ========
	// 	sidebar_item.removeClass('-active')
	// 	setTimeout(function() {
	// 		target.addClass('-active')
	// 	}, 450);

	// 	setTimeout(function() {
	// 		target.removeClass('-active')
	// 	}, 3000);
	// }

	// マーカーにクリックイベントを追加
	function markerEvent(i) {
		// ---------- マーカーをクリックしたとき ----------
		marker[i].addListener('click', function() {

			// //== サイドバーを該当箇所までスクロール ========
			// sidebar_item_scroll('sidebarGooglemap__item-' + id)

			//== mapをzoom + クリックしたピンを中央に ========
			map.setZoom(12);
			map.panTo(marker[i].getPosition());

			//== 吹き出し全て非表示 ========
			for (let key in infoWindow) {
				infoWindow[key].close()
			}

			//== 吹き出し表示 ========
			infoWindow[i].open(map, marker[i])
		});
	}

	/** --------------------------------
	 * サイドバーの物件をクリックしたら、該当のピンにマップを中央寄せする
	 *
	 * @param e element
	 */
	function pan_to_map(i) {

		//== mapをzoom + クリックしたピンを中央に ========
		// console.log(map)
		map.setZoom(12);
		map.panTo(marker[i].getPosition());

		//== 吹き出し全て日表示 ========
		for (let key in infoWindow) {
			infoWindow[key].close()
		}

		//== 吹き出し表示 ========
		infoWindow[i].open(map, marker[i])
	}
</script>
<?php } ?>
