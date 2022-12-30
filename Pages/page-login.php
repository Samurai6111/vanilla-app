<?php

/**
 * Template Name: ログインページ
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<?php require_once(get_theme_file_path() . "/vanilla-header.php") ?>

<main class="pageLogin" id="pageLogin">
	<div class="inner">
		<div class="pageLoginForm__container">
			<?php echo do_shortcode('[wpmem_form login]') ?>
		</div>
	</div>
</main>

<script>
	let login_redirect_url = '<?php echo $_GET['login_redirect_url'] ?>'
	if (login_redirect_url) {
		$('input[name="login_redirect_url"]').val(login_redirect_url)
	}
</script>


<?php get_footer(); ?>
