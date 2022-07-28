<?php
class Vanilla_Form {

	/**
	* フォームのアイテム
	*
	* @param $label ラベルの関数
	* @param $input インプットの関数
	* @param $class クラス
	*/
	function row_item(callable $label, callable $input, $class = '') {
?>
		<li class="vanillaForm__rowItem <?= esc_attr($class) ?>">
			<?php echo $label() ?>
			<div class="vanillaForm__inputWrap">
				<?php echo $input() ?>
			</div>
		</li>
<?php
	}
}
