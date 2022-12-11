// ページ内とページ内からのアンカーリンク
let headerHeight = ($('.header').outerHeight()) ? $('.header').outerHeight() + 20 : 20;
let urlHash = location.hash;
if (urlHash) {
    $('body,html').stop().scrollTop(0);
    setTimeout(function() {
        let target = $(urlHash);
        let position = target.offset().top - headerHeight;
        $('body,html').stop().animate({ scrollTop: position }, 500);
    }, 100);
}
$('a[href^="#"]').click(function() {
    let href = $(this).attr("href");
    let target = $(href);
    let position = target.offset().top - headerHeight;
    $('body,html').stop().animate({ scrollTop: position }, 500);
});