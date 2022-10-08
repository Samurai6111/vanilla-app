(function ($) {
	// ---------- アコーディオン ----------
	$(function () {
		let target = $(".js__accordion__header");
		if (target) {
			target.each(function () {
				if ($(this).hasClass('-accourdion-header-active')) {
					$(this).next().show()
				} else {
					$(this).next().hide()
				}

			})

			target.on("click", function () {
				$(this).toggleClass("-accourdion-header-active");

				if ($(this).hasClass('-accourdion-header-active')) {
					$(this)
						.next()
						.slideDown();
				} else {
					$(this)
						.next()
						.slideUp();
				}
			});
		}
	});
})(jQuery);
