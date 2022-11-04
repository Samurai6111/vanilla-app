(function ($) {
	$(window).on('load scroll', function (event) {
		if (event.type === 'load') {
			//-----------------------------------------
			// アコーディオン
			//-----------------------------------------
			let acd_target = $(".js__accordion__header");
			if (acd_target) {
				acd_target.next().hide();
				acd_target.on("click", function () {
					$(this).toggleClass("-accourdion-header-active");
					$(this)
						.next()
						.css({
							height: "100%",
						})
						.slideToggle();
				});
			}

		}
		else if (event.type === 'scroll') {

			let trigger = 64
			let windowScrollTop = $(window).scrollTop()
			let target = $('#postbox-container-2')
			let targetOffsetTop = target.offset().top;
			let targetPosition = windowScrollTop + trigger;
			let post_sidebar = $('#postbox-container-1')

			if (target.height() > post_sidebar.height()) {

				if (targetPosition > targetOffsetTop) {
					//-----------------------------------------
					// 投稿変種画面の右サイドバーを固定にする
					//-----------------------------------------
					let post_sidebar_offset = post_sidebar.offset()
					let post_sidebar_position_top = windowScrollTop - post_sidebar_offset.top
					let post_sidebar_width = post_sidebar.width()
					post_sidebar.css({
						'position': 'fixed',
						'top': trigger + 'px',
						'left': post_sidebar_offset.left + 'px',
						'width': post_sidebar_width + 'px',
						'max-height': 'calc(100vh - ' + post_sidebar_position_top * -1 + 'px)',
						'overflow-y': 'scroll',
					})
				} else {
					// 範囲外の処理
					post_sidebar.removeAttr('style')
				}
			}

		}
	});
})(jQuery);
