<?php
/*--------------------------------------------------
/* モジュール
/*------------------------------------------------*/
function map_ui_steps($current) {
	$steps = [
		'csv挿入',
		'住所データ<br class="-sp-only">選択',
		'ピンデータ<br class="-sp-only">選択',
		'マップ<br class="-sp-only">ページ',
	];
	ui_steps($steps, $current);
}
