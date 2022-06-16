<?php
require_once(get_theme_file_path() . "/App/Login/login--p20-functions.php");
require_once(get_theme_file_path() . "/App/Login/user-register--p30-excution.php");

/**
 * Template Name: 会員登録
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<main class="pageRegister" id="pageRegister">

	<div class="container">
		<?php cf_breadcrumb([
			[
				'href' => home_url('/register/'),
				'text' => '会員登録',
			]
		]) ?>
		<?php titleType1('会員登録') ?>
	</div>

	<?php require_once(get_theme_file_path() . "/App/Login/user-register--p50-form-template-input.php") ?>
</main>

<?php get_footer();
