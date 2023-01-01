<?php
/*--------------------------------------------------
/* モジュール
/*------------------------------------------------*/

/**
 * ステップ
 *
 * @param $current
 * @return
 */
function map_ui_steps($current) {
	$steps = [
		'csv挿入',
		'住所データ<br class="-sp-only">選択',
		'ピンデータ<br class="-sp-only">選択',
		'マップ<br class="-sp-only">ページ',
	];
	ui_steps($steps, $current);
}

/**
 * マップフォームのバリデーション
 *
 * @param
 * @return
 */
function map_form_validation() {
	$param = vanilla_sanitize_array($_GET);

	if (isset($param['validation'])) {
		$key = $param['validation'];
		$messages = [
			'wrong_address' => '住所データが正しく選択されていません',
		];
?>
		<br>
		<p class="-color-red">
			<?php echo wp_kses_post($messages[$key]) ?>
		</p>
		<br>
<?php
	}
}
