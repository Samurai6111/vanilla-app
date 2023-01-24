<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$data = vanilla_sanitize_array($_POST);

	if (vanilla_is_nonce_verified('data_extraction')) {
		$result = execute_insertion($data);
	}

	if ($result) {
		// wp_safe_redirect(home_url('/data-extraction?result=success'));
		// exit;
	}

}
