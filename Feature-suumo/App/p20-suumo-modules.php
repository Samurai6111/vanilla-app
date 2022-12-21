<?php
/*--------------------------------------------------
/* モジュール
/*------------------------------------------------*/

/**
 * ボタン
 *
 * @param $args array
 */
function suumo_button_type1($args) {

	$defaults = [
		'text' => 'ボタン',
		'attr' => 'type="submit"',
		'tag' => 'button',
		'class' => '',
	];

	$args = wp_parse_args($args, $defaults);
?>
	<<?php echo esc_attr($args['tag']) ?> class="suumoButtonType1 <?php echo esc_attr($args['class']) ?>" <?php echo esc_attr($args['attr']) ?>>
	<?php echo esc_attr($args['text']) ?>
	</<?php echo esc_attr($args['tag']) ?>>

	<?php
}

/**
 * ページヘッド
 *
 * @param $text
 */
function suumo_head($text) {
	?>
		<div class="suumoHead">
			<h1 class="suumoHead__title"><?php echo wp_kses_post($text) ?></h1>

			<p class="suumoHead__author">
				Made by <br>
				<span><a href="https://github.com/Samurai6111" target="_blank" rel="noopener">Shota Kawakatsu</a></span>
			</p>
		</div>
	<?php
}

/**
 * フレーム
 *
 * @param $func コールバック
 * @return
 */
function suumo_frame(callable $func) {
	?>
		<div class="suumoFrame" id="suumoFrame">
			<div class="inner -wide">
				<div class="suumoFrameContainer">
					<?php echo $func() ?>
				</div>
			</div>
		</div>
	<?php
}

/**
 * マイページのタイトル
 *
 * @param $text
 */
function suumo_mypage_title($text) {
	?>
		<h3 class="suumoMypageTitle">
			<?php echo wp_kses_post($text) ?>
		</h3>
	<?php
}
