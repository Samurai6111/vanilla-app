<?php

/**
 * Template Name: ピクセルアート
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<?php require_once(dirname(__FILE__) . "/c-pixel-art-header.php") ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-pixel-art/Assets/Css/style.css">

<main class="pagePixelart -moving-bgc" id="pagePixelart">
	<?php ui_frame(function () { ?>
		<?php ui_head('Pixel Art') ?>

		<?php the_pixel_art_colors() ?>
		<?php the_pixel_art_table() ?>

		<div class="pagePixelart__buttonWrap">
			<?php button_type1([
				'attr' => 'type=button onclick=reset_pixel_art_table(event)',
				'text' => 'リセット'
			]) ?>
			<?php button_type1([
				'attr' => 'type=button onclick=save_pixel_art_table(event)',
				'text' => '保存する'
			]) ?>
			<?php button_type1([
				'attr' => 'type=button onclick=generate_git_command(event)',
				'text' => 'git コマンド生成'
			]) ?>
		</div>
	<?php }) ?>

	<div class="pagePixelart__textAreaWrap">
		<textarea name="" id="" cols="30" rows="10"></textarea>
	</div>
</main>


<script src="<?php echo get_template_directory_uri(); ?>/Feature-pixel-art/Assets/Js/pixel-art.js"></script>

<?php get_footer(); ?>
