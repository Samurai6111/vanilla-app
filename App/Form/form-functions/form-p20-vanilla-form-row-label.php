<?php

/**
* フォームのラベル部分を出力するクラス
*
* @param $text ラベルのテキスト
*/
class Vanilla_Form_Row_Label {
	function __construct($text) {
		$this->text = $text;
	}
	public function label() {
?>
		<div class="vanillaForm__label">
			<p class="vanillaForm__labelText">
				<?php echo wp_kses_post($this->text) ?>
			</p>
		</div>
<?php
	}
}


/**
 * class Vanilla_Form_Row_Labelを出力する関数
 *
 * @param $text ラベルのテキスト
 */
function vanilla_form_label($text) {
	$Vanilla_FormRowLabel = new Vanilla_Form_Row_Label($text);
	return [$Vanilla_FormRowLabel, 'label'];
}
