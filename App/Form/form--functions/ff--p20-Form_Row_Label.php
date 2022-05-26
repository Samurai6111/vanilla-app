<?php

/**
 * エントリーフォームのラベル部分のクラス
 *
 * @param $
 */
class Form_Row_Label {
	function __construct($text, $class) {
		$this->text = $text;
		$this->class = $class;
	}
	public function label() {
?>
<div class="entryForm__label <?= esc_attr($this->class) ?>">
	<p class="entryForm__labelText"><?= esc_attr($this->text) ?></p>
</div>
<?php
	}
}


/**
 * EntryFormRowLabelをベースにentryFormRow（）のcallbackとなる配列を出力する関数
 *
 * @param $text　テキスト
 * @param $class　該当のクラス
 */
function ef__label($text, $class) {
	$Entry_FormRowLabel = new Form_Row_Label($text, $class);
	return [$Entry_FormRowLabel, 'label'];
}