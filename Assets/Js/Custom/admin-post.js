(function($) {
    // let acf_label = $('#acf-studio_post_acf_fields > .acf-fields > .acf-field > .acf-label')

    setTimeout(function() {


        let acf_label = $(".acf-fields.-top > .acf-field > .acf-label")
        let acf_floating_banner_html
        let acf_floating_banner_inner_html

        if (acf_label) {

            acf_floating_banner_html = '<div class="acfFloatingBanner"><div class="acfFloatingBanner__scroll"></div></div>'
            $('body').append(acf_floating_banner_html)

            acf_label.each(function() {
                let label = $(this).find('> label')
                let label_text = label.text()
                let label_id = label.attr('for')

                acf_floating_banner_inner_html =
                    '<a class="acfFloatingBanner__link"' +
                    'href="#' + label_id + '"' +
                    'data-id="' + label_id + '"' +
                    '>' +
                    label_text + '</a>'

                $('.acfFloatingBanner__scroll').append(acf_floating_banner_inner_html)
            })

            $('.acfFloatingBanner__link').on('click', function() {
                let target = $(this)
                let id = target.data('id')
                console.log(id)
                let scroll_target = $('label[for="' + id + '"]').closest('.acf-field')
                console.log(scroll_target)
                let position = scroll_target.offset().top - 60;
                $('html').stop().animate({ scrollTop: position }, 500);
            })
        }
    }, 500);
})(jQuery);
