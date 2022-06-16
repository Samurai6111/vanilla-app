<?php
/**
 * エントリーフォームのラベル部分のクラス
 */
class Vanilla_Form_Row_Label {
	function __construct($text, $class) {
		$this->text = $text;
		$this->class = $class;
	}
	public function label() {
?>
<div class="form__label <?= esc_attr($this->class) ?>">
	<p class="form__labelText"><?= esc_attr($this->text) ?></p>
</div>
<?php
	}
}


/**
 * formRowLabelをベースにformRow（）のcallbackとなる配列を出力する関数
 *
 * @param $text　テキスト
 * @param $class　該当のクラス
 */
function vanilla_form_label($text, $class) {
	$Vanilla_FormRowLabel = new Vanilla_Form_Row_Label($text, $class);
	return [$Vanilla_FormRowLabel, 'label'];
}
