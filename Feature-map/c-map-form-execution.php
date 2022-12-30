<?php
if (
	'POST' === $_SERVER['REQUEST_METHOD']
) {
	$s_POST = vanilla_sanitize_array($_POST);

	//== csvデータの送信 ========
	if (vanilla_is_nonce_verified('csv_form')) {
		csv_form_redirect();
	}
	//== adress_indexのデータ送信 ========
	elseif (vanilla_is_nonce_verified('address_selection')) {
		address_selection_redirect($s_POST);
	}
}
