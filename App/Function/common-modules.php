<?php
/*--------------------------------------------------
/* モジュール
/*------------------------------------------------*/

/**
 * ボタン
 *
 * @param $args array
 */
function button_type1($args) {

	$defaults = [
		'text' => 'ボタン',
		'attr' => 'type="submit"',
		'tag' => 'button',
		'class' => '',
	];

	$args = wp_parse_args($args, $defaults);
?>
	<<?php echo esc_attr($args['tag']) ?> class="buttonType1 <?php echo esc_attr($args['class']) ?>" <?php echo esc_attr($args['attr']) ?>>
	<?php echo esc_attr($args['text']) ?>
	</<?php echo esc_attr($args['tag']) ?>>

	<?php
}


/**
 * サイトマップのカード
 *
 * @param $href リンクのURL
 * @param $title タイトル
 * @param $img 画像
 */
function sitemap_card($href, $title, $img) { ?>
		<a class="sitemapCard" href="<?php echo esc_url($href) ?>">
			<div class="sitemapCard__titleWrap">
				<p class="sitemapCard__title">
					<?php echo wp_kses_post($title) ?>
				</p>
			</div>

			<div class="sitemapCard__thumbnailWrap">
				<figure class="sitemapCard__figure">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/Image/' . $img) ?>" alt="<?php echo esc_attr($title) ?>" class="sitemapCard__img">
				</figure>
			</div>
		</a>
	<?php
}


/**
 * ページヘッド
 *
 * @param $text
 */
function ui_head($text) {
	?>
		<div class="uiHead">
			<h1 class="uiHead__title"><?php echo wp_kses_post($text) ?></h1>


			<p class="uiHead__author">
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
function ui_frame(callable $func) {
	?>
		<div class="uiFrame" id="uiFrame">
			<div class="inner -wide">
				<div class="uiFrameContainer">
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
function title_type1($text) {
	?>
		<h3 class="titleType1">
			<?php echo wp_kses_post($text) ?>
		</h3>
	<?php
}
