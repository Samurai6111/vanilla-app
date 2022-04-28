<?php if (current_user_can('administrator')) { ?>
<script>
// ------------------------
// 「SHIFT + ↑ or ↓」でadmin Barの位置を変える
// ------------------------
$(function() {
	$('body').keydown(function(event) {
		if (event.shiftKey) {
			// adminbar
			if (event.keyCode === 65) {
				$('#wpadminbar').fadeToggle(0)
			}
			// header
			else if (event.keyCode === 72) {
				$('#header').fadeToggle(0)
			}
		}
	});
});
</script>
<?php } ?>