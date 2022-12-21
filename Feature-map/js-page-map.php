<?php
$params = vanilla_sanitize_array($_GET);
if (isset($params['csv_data'])) {
	$csv_data_array = $params['csv_data'];
	unset($csv_data_array[0]);
	$csv_data_json = json_encode($csv_data_array);
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
	* @param
	*/

	function get_param(key) {
		let current_url = '<?php echo esc_url(get_permalink()); ?>'
		let url = new URL(current_url);
		let search_params = url.searchParams;
		return search_params.get(key);
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
		let center = {
			lat: 35.7362707,
			lng: 139.702632
		}

		// 地図の作成
		let center_mapLatLng = new google.maps.LatLng({
			lat: center['lat'],
			lng: center['lng']
		});
		map = new google.maps.Map(target_map, { // #sampleに地図を埋め込む
			center: center_mapLatLng, // 地図の中心を指定
			zoom: 11 // 地図のズームを指定
		});


		// マーカー毎の処理
		console.log(values)
		Object.keys(values).forEach(function (i) {
			let value = values[i]
			console.log(value)
			let id = value['ID']

			// ---------- 緯度経度のデータ作成 ----------
			let latitude = parseFloat(value['latitude'])
			let longitude = parseFloat(value['longitude'])

			if (latitude && longitude) {

				//== マーカーの緯度と経度 ========
				let markerLatLng = new google.maps.LatLng({
					lat: latitude,
					lng: longitude
				});

				//== マーカーをセット ========
				marker[id] = new google.maps.Marker({
					position: markerLatLng,
					map: map,
					animation: google.maps.Animation.DROP
				});

				//== マーカーにクリックイベントを追加 ========
				markerEvent(id);

				//== マーカーの吹き出しの中身 ========
				let infoWindowContent = '<div class="pinInfo">' + value['address'] + '</div>'
				infoWindow[id] = new google.maps.InfoWindow({ // 吹き出しの追加
					content: infoWindowContent // 吹き出しに表示する内容
				});
			}
		})
	}

	/** --------------------------------
	 * googleマップのピンをクリックしたらサイドバーがスクロールする
	 *
	 * @param sidebar_item_id
	 */
	function sidebar_item_scroll(sidebar_item_id) {
		let sidebar_google_map = $('#sidebarGooglemap')
		let sidebar_item = sidebar_google_map.find('.sidebarGooglemap__item')
		let target = $('#' + sidebar_item_id)
		let position_top = target.data('position-top')

		//== スクロール ========
		sidebar_google_map.animate({
			scrollTop: position_top
		}, 500);

		//== クラス付与 ========
		sidebar_item.removeClass('-active')
		setTimeout(function() {
			target.addClass('-active')
		}, 450);

		setTimeout(function() {
			target.removeClass('-active')
		}, 3000);
	}

	// マーカーにクリックイベントを追加
	function markerEvent(id) {
		// ---------- マーカーをクリックしたとき ----------
		marker[id].addListener('click', function() {

			//== サイドバーを該当箇所までスクロール ========
			sidebar_item_scroll('sidebarGooglemap__item-' + id)

			//== mapをzoom + クリックしたピンを中央に ========
			map.setZoom(12);
			map.panTo(marker[id].getPosition());

			//== 吹き出し全て日表示 ========
			for (let key in infoWindow) {
				infoWindow[key].close()
			}

			//== 吹き出し表示 ========
			infoWindow[id].open(map, marker[id])
		});
	}

	/** --------------------------------
	 * サイドバーの物件をクリックしたら、該当のピンにマップを中央寄せする
	 *
	 * @param e element
	 */
	function pan_to_map(id) {

		//== mapをzoom + クリックしたピンを中央に ========
		map.setZoom(12);
		map.panTo(marker[id].getPosition());

		//== 吹き出し全て日表示 ========
		for (let key in infoWindow) {
			infoWindow[key].close()
		}

		//== 吹き出し表示 ========
		infoWindow[id].open(map, marker[id])
	}
</script>
<?php } ?>
