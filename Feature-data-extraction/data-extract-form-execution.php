<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$data = vanilla_sanitize_array($_POST);

	if (vanilla_is_nonce_verified('data_extraction')) {
		$data_array = execute_data_extraction($data['url']);
	}

	// if ($result) {
		// $param = ($param) ? "?param=" . $param : '';
		// wp_safe_redirect(home_url('/suumo/' . $param));
		// exit;
	// }

}
