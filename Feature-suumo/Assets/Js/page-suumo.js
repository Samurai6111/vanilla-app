//========================
// URL周りの処理
//========================
const suumo_current_url = window.location;
const query_string = suumo_current_url.search;
const url_param = new URLSearchParams(query_string);
const param = url_param.get('param')

//== データーが挿入された時 ========
if (param === 'suumo-data-inserted') {

    setTimeout(function() {
        $('.suumoTable tbody tr:last-child').addClass('-data-inserted')
    }, 500);

    setTimeout(function() {
        $('.suumoTable tbody tr:last-child').removeClass('-data-inserted')

        suumo_current_url.search = '';
        const newUrl = url_param.toString();
        window.hsitory.pushState({
            path: new_url
        }, '', new_url)
    }, 3000);
}

//== データが挿入のバリデーションに引っかかった時の処理 ========
let form_error_text = $('.suumoUrlFormContainer .suumoUrlForm__errorText')
if (form_error_text.length > 0) {
    $('#modalWrap').fadeIn()
    $('.modalWrap .modal__targetContent[data-target-modal="suumo__form"]').show()
}



/** --------------------------------
 * suumotableの入力欄を操作したらそのデータのチェックボックスがチェック状態になる
 *
 * @param
 */
function checkbox_first_turned_checked(e) {
    let target = $(e.target)
    let checkbox = target.parents('tr').find('td:first-child input[type="checkbox"]')
    checkbox.prop('checked', 'true')
}


//== input numberの矢印キーの増減を無しにする ========
$(function() {
    $('input[type=number]').keydown(function(event) {
        switch (event.key) {
            case 'ArrowUp':
            case 'ArrowDown':
                return false;
        }
    });
});

//== モーダルが表示されたときにinputにfocusを当てる ========
$('.pageSuumo__button.js__modal__trigger').on('click', function() {
    setTimeout(function() {
        $('input.suumoUrlForm__urlInput').focus()
    }, 300);
})


//========================
//スライダー
//========================
const swiper = new Swiper('.suumotable__swiper', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

/** --------------------------------
 * suumotableの虫眼鏡をクリックした時にモーダルの中にスライダーを移す
 *
 * @param e
 */
$('.suumotable__swiperMagnifiy.js__modal__trigger').on('click', function() {
    let target = $(this)
    let target_modal = target.data('modal-target')
    let slider_wrap = target.parent()
    slider_wrap.clone().appendTo($('.modalWrap .modal__targetContent[data-target-modal="' + target_modal + '"]'))

    new Swiper('.suumotable__swiper', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

})

$(".modalWrap").on("click", function(e) {
    if (!$(e.target).closest(".modal__content").length) {
        // ターゲット要素の外側をクリックした時の操作
        $(".modalWrap").fadeOut();
        $('.modalWrap .modal__targetContent[data-target-modal="suumotable__swiper"] > *').remove()
    }

});