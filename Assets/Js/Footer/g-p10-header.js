(function ($) {
	//ここに記述する

let headerBP = 960
let windowWidth = $(window).width();
function is_pc() {
	let windowWidth = $(window).width();
	if (windowWidth > 768) {
		return true;
	} else {
		return false;
	}
}

//-----------------------------------------
// ハンバーガーメニュー
//-----------------------------------------
$(".hamburger-js").click(function () {
	$(this).toggleClass("-active");
	$(".gnav").fadeToggle();
});

//-----------------------------------------
// ホバーでサブメニューを表示
//-----------------------------------------
$('.header__navWrap .menu-item-has-children').hover(
	function () {
		if (windowWidth > headerBP) {
			$(this).find('.sub-menu').fadeIn(300).toggleClass('-active');
		}
	},
	function () {
		if (windowWidth > headerBP) {
			$(this).find('.sub-menu').fadeOut(300).toggleClass('-active');
		}
	}
);
})( jQuery );
