<?php
if (is_ready_to_excute()) {
	$s_POST = vanilla_sanitize_array($_POST);

	//--------------------------------------------------
	// 確認ページ
	//--------------------------------------------------
	if (
		!s_GET('form-action') ||
		s_GET('form-action') === 'input'
	) {
		$Vanilla_Form_Validation = new Vanilla_Form_Validation();
		$validations = $Vanilla_Form_Validation->user_register($s_POST);
	}
	//--------------------------------------------------
	// 確認ページ
	//--------------------------------------------------
	elseif (s_GET('form-action') === 'confirm') {
	}
	//--------------------------------------------------
	// 送信処理
	//--------------------------------------------------
	elseif (s_GET('form-action') === 'send') {
		global $post;
		$post_slug = $post->post_name;
		$Vanilla_User_Action = new Vanilla_User_Action();
		$user_id = $Vanilla_User_Action->insert_user($s_POST);
		$Vanilla_User_Action->update_meta($user_id, $s_POST);

		if (!is_wp_error($user_id)) {
			wp_safe_redirect(home_url('/thanks/?type=' . $post_slug));
			exit;
		} else {
			echo 'エラーが発生しました';
			exit;
		}
	}
} else {
	echo '予期せぬエラーが発生しました。';
	exit;
}
