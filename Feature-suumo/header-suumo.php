<!-- <header class="headerSuumo">
	<figure class="headerSuumo__logoWrap">
		<img src="" alt="" class="headerSuumo__logo">
	</figure>

</header> -->
<?php
if (!is_user_logged_in()) {
	wp_safe_redirect('/login/?login_redirect_url=' . esc_url(get_permalink()));

	exit;
} else {
	require_once(get_theme_file_path() . "/Assets/Components/c-hamburger.php");
	require_once(dirname(__FILE__) . "/c-suumo-gnav.php");
}
?>
