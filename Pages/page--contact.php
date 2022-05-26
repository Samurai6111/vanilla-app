<?php
require_once(get_theme_file_path() . "/App/Form/App--form.php");

/**
 * Template Name: お問合せ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>
<style>
.pageContact {
	padding: 80px 0;
}
</style>

<main class="pageContact"
			id="pageContact">
	<div class="inner">
		<?php require_once(get_theme_file_path() . "/App/Form/form--p50-template.php") ?>
	</div>
</main>


<?php get_footer();