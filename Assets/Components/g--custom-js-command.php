<?php if (current_user_can('administrator')) { ?>

<script>
// ------------------------
// 「SHIFT + ↑ or ↓」でadmin Barの位置を変える
// ------------------------
<?php if (is_admin()) {
			echo '(function ($) {';
		} else {
			'$(function() {';
		} ?>
$('body').keydown(function(event) {
	if (event.shiftKey) {
		// adminbar 「shift + a」
		if (event.keyCode === 65) {
			$('#wpadminbar').fadeToggle(0)
		}
		// header 「shift + h」
		else if (event.keyCode === 72) {
			$('#header').fadeToggle(0)
		}
		// /wp-adminに遷移 「shift + w」
		else if (event.keyCode === 87) {
			window.location.href = '<?php echo admin_url(); ?>'
		}
		// トップページに遷移 「shift + t」
		else if (event.keyCode === 84) {
			window.location.href = '<?php echo home_url(); ?>'
		}
	}
})
<?php if (is_admin()) {
			echo '})(jQuery)';
		} else {
			'});';
		} ?>
</script>
<?php } ?>