<?php

class Vanilla_Form_Media {
	/**
	 * wpにmedhia uploadしてそのidを返す関数
	 *
	 * @param $name inputのtype=fileのname属性
	 */
	function media_upload($name) {
		global $new_post;

		if (isset($_FILES[$name])) {
			if (!function_exists('wp_generate_attachment_metadata')) {
				include_once(ABSPATH . "wp-admin" . '/includes/image.php');
				include_once(ABSPATH . "wp-admin" . '/includes/file.php');
				include_once(ABSPATH . "wp-admin" . '/includes/media.php');
			}

			foreach ($_FILES as $file => $array) {
				// ---------- エラーの時 ----------
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
					// wp_safe_redirect(get_permalink());
					echo 'ファイル送信中にエラーが発生しました。';
					exit;
				}

				// ---------- アップロード実行 ----------
				$attachment_id = media_handle_upload($file, $new_post);

				// ---------- メタ追加 ----------
				update_post_meta($attachment_id, 'temoprary_upload', 'true');

				return $attachment_id;
			}
		}
	}
}
