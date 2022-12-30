<?php

/**
 * Template Name: マップ
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-map/Assets/Css/style.css">

<main class="pageMap -moving-bgc" id="pageMap">

	<style>
		#map {
			width: 100vw;
			height: 100vh;
		}

		.pinInfo * {
			word-break: keep-all;
			white-space: nowrap;
		}
	</style>

	<div id="mapWrap">
		<div id="map"></div>

		<button class="map__centerCurrentLocation" id="centerCurrentLocation" type="button" onclick="center_current_location()">
			<img src="<?php echo get_template_directory_uri() . '/Feature-map/Images/icon_compass_1.svg' ?>" alt="">
		</button>

	</div>



	<?php

	$google_maps_key = get_option('vanilla_app_google_api_key');
	?>
	<script src="<?php echo get_template_directory_uri(); ?>/Feature-map/Assets/Js/common.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/Feature-map/Assets/Js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($google_maps_key) ?>&callback=initMap" async defer></script>
	<script>

		//== 現在地をセンターにする ========
		function center_current_location() {
		navigator.geolocation.getCurrentPosition(
			//= success ====
			function (position) {
				let center_current_location = new google.maps.LatLng({
					lat: position.coords.latitude,
					lng: position.coords.longitude
				});
				map.panTo(center_current_location)
			},
			//= fail ====
			function () { });
	}
	</script>

	<!-- <?php require_once(get_theme_file_path() . "/Feature-suumo/c-suumo-modal.php") ?> -->
	<!-- <script src="<?php echo get_template_directory_uri(); ?>/Feature-suumo/Assets/Js/page-suumo.js"></script> -->

</main>





<script>
	// let ls_csv_json = window.localStorage.getItem('csv_json')
	// if (!ls_csv_json) {
	// 	let csv_json = '<?php echo $csv_json ?>'
	// 	window.localStorage.setItem('csv_json', csv_json)
	// } else {
	// 	let csv_array = JSON.parse(ls_csv_json)
	// 	// console.log(csv_array)

	// }
</script>


<?php get_footer(); ?>
