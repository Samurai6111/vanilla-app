<?php

/**
 * Template Name: suumo google map
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

<?php

function image_json_to_array($row) {
	$row->images = json_decode($row->images);
	return $row;
}

$Suumo_Table = new Suumo_Table();
$suumo_values_array = $Suumo_Table->get_table_values();
$suumo_values_array_modified = array_map('image_json_to_array', $Suumo_Table->get_table_values());
$suumo_values_json = json_encode($suumo_values_array_modified);
?>

<div class="pageGooglemap">
	<aside class="pageGooglemapSidebar" id="pageGooglemapSidebar">
		<?php require_once(get_theme_file_path() . "/Feature-suumo/sidebar-google-map.php") ?>
	</aside>

	<div id="map"></div>
</div>

<script>
	var map;
	var marker = [];
	var infoWindow = [];

	/**
	 * テーブルから物件情報を取得する
	 */
	function get_suumo_values() {
		let suumo_values_json = '<?php echo $suumo_values_json ?>'
		console.log(suumo_values_json)
		let suumo_values_array = JSON.parse(suumo_values_json)

		return suumo_values_array
	}

	function initMap() {
		// ---------- 変数 ----------
		let geocoder = new google.maps.Geocoder();
		let suumo_values = get_suumo_values()
		let target = document.getElementById('map')
		let center = {
			lat: 35.7362707,
			lng: 139.702632
		}

		// 地図の作成
		let center_mapLatLng = new google.maps.LatLng({
			lat: center['lat'],
			lng: center['lng']
		});
		map = new google.maps.Map(target, { // #sampleに地図を埋め込む
			center: center_mapLatLng, // 地図の中心を指定
			zoom: 13 // 地図のズームを指定
		});


		// マーカー毎の処理
		for (let i = 0; i < suumo_values.length; i++) {
			let suumo_value = suumo_values[i]

			// ---------- 緯度経度のデータ作成 ----------
			let latitude = parseFloat(suumo_value['latitude'])
			let longitude = parseFloat(suumo_value['longitude'])

			if (latitude && longitude) {
				let markerLatLng = new google.maps.LatLng({
					lat: latitude,
					lng: longitude
				});

				console.log(google.maps.Marker)

				marker[i] = new google.maps.Marker({
					position: markerLatLng,
					map: map,
					animation: google.maps.Animation.DROP
				});

				console.log(suumo_value['rent'])
				let infoWindowContent =
					'<div class="pinInfo">' +
					'<table>' +
					'<tr><td>URL</td><td>' +
					'<a href="' + suumo_value['link'] + '" target="_blank" rel="noopener">掲載サイトへ</a>' +
					'</td></tr>' +
					'<tr><td>家賃</td><td>' + suumo_value['rent'] + '</td></tr>' +
					'<tr><td>管理費</td><td>' + suumo_value['management_fee'] + '</td></tr>' +
					'<tr><td>敷金</td><td>' + suumo_value['deposit'] + '</td></tr>' +
					'<tr><td>礼金</td><td>' + suumo_value['retainer_fee'] + '</td></tr>' +
					'<tr><td>間取り</td><td>' + suumo_value['room_arragement'] + '</td></tr>' +
					'<tr><td>初期費用(概算)</td><td>' + suumo_value['initial_fee'] + '</td></tr>' +
					'<tr><td>構造</td><td>' + suumo_value['construction'] + '</td></tr>' +
					'<tr><td>住所</td><td>' + suumo_value['address'] + '</td></tr>' +
					'</table>' +
					'</div>'
				// infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
				// 	content: infoWindowContent // 吹き出しに表示する内容
				// });

				markerEvent(i, 'sidebarGooglemap__item-' + suumo_value['ID']); // マーカーにクリックイベントを追加
			}
		}
	}

	function sidebar_item_scroll(sidebar_item_id) {
		let sidebar_google_map = $('#sidebarGooglemap')
		let target = $('#' + sidebar_item_id)
		let position_top = target.data('position-top')



			//== スクロール ========
			sidebar_google_map.animate({
				scrollTop: position_top
			}, 500);

			//== クラス付与 ========
			setTimeout(function(){
				target.addClass('-active')
			},200);

			setTimeout(function(){
				target.removeClass('-active')
			},1200);
	}

	// マーカーにクリックイベントを追加
	function markerEvent(i, sidebar_item_id) {
		marker[i].addListener('click', function() { // マーカーをクリックしたとき
			sidebar_item_scroll(sidebar_item_id)
		});
	}
</script>
<?php
global $current_user;
$suumo_user_google_api_key = get_user_meta($current_user->ID, 'suumo_user_google_api_key', true);
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($suumo_user_google_api_key) ?>&callback=initMap" async defer></script>


<?php get_footer();
