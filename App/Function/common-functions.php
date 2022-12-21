<?php

	/**
	 * 住所から緯度と軽度を取得
	 *
	 * @param $address 住所
	 */
	function map_get_latlon($address) {
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
		echo $response;

		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;

		$latlon_array['latitude'] = $lat;
		$latlon_array['longitude'] = $long;

		return $latlon_array;
	}
