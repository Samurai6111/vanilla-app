// ------------------------
// 「SHIFT + ↑ or ↓」でadmin Barの位置を変える
// ------------------------
(function ($) {
	$('body').keydown(function (event) {
		if (event.shiftKey) {
			//↓key
			if (event.keyCode === 40) {
				$('#wpadminbar').css({
					'top': 'auto',
					'bottom': 0,
				});
			}
			//↑key
			else if (event.keyCode === 38) {
				$('#wpadminbar').css({
					'top': 0,
					'bottom': 'auto',
				});
			}
		}
	});
	//ここに記述する
})( jQuery );
