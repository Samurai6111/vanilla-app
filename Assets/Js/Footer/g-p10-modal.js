(function ($) {
$(".js__modal__trigger").on("click", function() {
    $(".modalWrap").fadeIn();
    var modalContentsHeight = $(".js__modal__contentHeight").height();
    $(".js__modal__contentWrap").css({
        height: modalContentsHeight,
    });
});
$(".modalWrap").on("click", function(e) {
    if (!$(e.target).closest(".modal__content").length) {
        // ターゲット要素の外側をクリックした時の操作

        $(".modalWrap").fadeOut();
    } else {
        // ターゲット要素をクリックした時の操作
    }
});
})( jQuery );
