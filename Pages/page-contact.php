<?php require_once(get_theme_file_path() . "/App/Form/Executions/contact-form-execution.php") ?>

<?php

/**
 * Template Name: お問い合わせ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<main class="pageContact" id="pageContact">
	<div class="inner">

		<br><br><br><br><br>
		<br><br><br><br><br>

		<?php require_once(get_theme_file_path() . "/App/Form/Templates/contact-form-template.php") ?>
	</div>


	<script src="<?php echo get_template_directory_uri(); ?>/Assets/Js/Custom/loading-spinner-animation.js"></script>

	<?php if (!isset($_GET['favorite-post'])) {
	?>
		<script>
			$(function() {
				loading_spinner_animation()
			});
		</script>
	<?php } ?>

</main>

<?php get_footer();
