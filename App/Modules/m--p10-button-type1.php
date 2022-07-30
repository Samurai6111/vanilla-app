<?php
function button_type1($args) {
	//--------------------------------------------------
	// 初期値
	//--------------------------------------------------
	$args_init = [
		'text' => 'もっと見る',
		'class' => '',
		'img' => get_template_directory_uri() . "/src/images/common/icon_arrow_right_white_1.svg",
		'attr' => '',
		'tag' => 'button',
	];

	//--------------------------------------------------
	// 変数の変更
	//--------------------------------------------------
	foreach ($args_init as $key => $value) {
		$args_value = (!isset($args[$key])) ? $value : $args[$key];
		$args[$key] = $args_value;
	}
?>
	<<?= esc_attr($args['tag']) ?> class="buttonType1 <?= esc_attr($args['class']) ?>" <?= $args['attr'] ?>>
		<p class="buttonType1__text">
			<?= wp_kses_post($args['text']) ?>
		</p>

		<figure class="buttonType1__figure">
			<img class="buttonType1__img" src="<?= esc_attr($args['img']) ?>" alt="<?= esc_attr($args['text']) ?>">
		</figure>
	</<?= esc_attr($args['tag']) ?>>
<?php
}
