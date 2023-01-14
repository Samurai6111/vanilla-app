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

		<?php the_pixel_set_date_form() ?>
		<?php the_pixel_art_colors() ?>

		<p class="pixelart__currentDate -tac" id="pixelartCurrentDate"></p>
		<br>

		<?php the_pixel_art_table() ?>

		<div class="pagePixelart__buttonWrap">
			<?php button_type1([
				'attr' => 'type=button onclick=reset_pixel_art_table(event)',
				'text' => 'リセット',
				'class' => '-color-reverse -reset-command',
			]) ?>
			<?php button_type1([
				'attr' => 'type=button onclick=save_pixel_art_table(event)',
				'text' => '保存する',
				'class' => '-save-command'
			]) ?>
		</div>
		<br><br><br><br>

		<div class="pagePixelart__buttonWrap">
			<?php button_type1([
				'attr' => 'type=button onclick=generate_git_command(event)',
				'text' => 'git コマンド生成',
				'class' => '-show-command'
			]) ?>
		</div>
		<br><br>

		<div class="pagePixelart__textAreaWrap">
			<figre class="pagePixelart__textAreaFigure">
				<img id="pagePixelart__textAreaCopy" src="<?php echo get_template_directory_uri() . "/Feature-pixel-art/images/icon_copy_lightgray.svg" ?>" alt="" onclick="copy_git_command()">
			</figre>

			<textarea class="pagePixelart__textarea" id="pagePixelart__textarea" cols="30" rows="10"></textarea>
		</div>
	<?php }) ?>


</main>


<script src="<?php echo get_template_directory_uri(); ?>/Feature-pixel-art/Assets/Js/pixel-art.js"></script>

<?php get_footer(); ?>
