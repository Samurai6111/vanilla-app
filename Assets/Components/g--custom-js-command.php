<?php if (current_user_can('administrator')) { ?>

<script>
// ------------------------
// 「SHIFT + ↑ or ↓」でadmin Barの位置を変える
// ------------------------
<?php echo (is_admin()) ? '(function ($) {' : '$(function() {'; ?>
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
			window.location.href = '<?php echo admin_url("/theme-editor.php"); ?>'
		}
		// トップページに遷移 「shift + f」
		else if (event.keyCode === 70) {
			window.location.href = '<?php echo home_url(); ?>'
		}
	}
})
<?php echo (is_admin()) ? '})(jQuery)' : '});'; ?>
</script>
<?php } ?>