const suumo_current_url = window.location;
const query_string = suumo_current_url.search;
const url_param = new URLSearchParams(query_string);
const param = url_param.get('param')

// ---------- データーが挿入された時 ----------
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

// ---------- データが挿入のバリデーションに引っかかった時 ----------
let form_error_text = $('.suumoUrlFormContainer .suumoUrlForm__errorText')
if (form_error_text.length > 0) {
    $('#modalWrap').fadeIn()
}

$('#wpadminbar').hide()


function checkbox_first_turned_checked(e) {
    let target = $(e.target)
    let checkbox = target.parents('tr').find('td:first-child input[type="checkbox"]')
    checkbox.prop('checked', 'true')
}

// input numberの矢印キーの増減を無しにする
$(function() {
    $('input[type=number]').keydown(function(event) {
        switch (event.key) {
            case 'ArrowUp':
            case 'ArrowDown':
                return false;
        }
    });
});