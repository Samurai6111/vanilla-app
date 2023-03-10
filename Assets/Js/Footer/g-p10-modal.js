(function($) {
    $(".js__modal__trigger").on("click", function() {
        let target_modal = $(this).data('modal-target')
        $(".modalWrap").fadeIn();
        $('.modalWrap').find('.modal__targetContent[data-target-modal="' + target_modal + '"]').show()
        var modalContentsHeight = $(".js__modal__contentHeight").height();
        $(".js__modal__contentWrap").css({
            height: modalContentsHeight,
        });
    });
    $(".modalWrap").on("click", function(e) {
        if (!$(e.target).closest(".modal__content").length) {
            // ターゲット要素の外側をクリックした時の操作

            $(".modalWrap").fadeOut();
            $('.modalWrap').find('.modal__targetContent').hide()

            let form_error_text = $('.suumoUrlFormContainer .suumoUrlForm__errorText')
            if (form_error_text.length > 0) {
                form_error_text.fadeOut().remove()
            }
        } else {
            // ターゲット要素をクリックした時の操作
        }
    });
})(jQuery);