// ---------- ハンバーガーメニュー ----------
$(".hamburger-js").hover(
    function() {
        if (!$(".hamburger-js").hasClass("hamburger-js-active")) {
            $(this).find(".hamburger_text").text("CLICK");
            $(".line-top, .line-bottom").css({
                transform: "translateX(calc(-50% + 4px))",
            });
            $(".line-middle").css({ transform: "translateX(calc(-50% - 4px))" });
        }
    },
    function() {
        if (!$(".hamburger-js").hasClass("hamburger-js-active")) {
            $(this).find(".hamburger_text").text("MENU");
            $(".line-top, .line-bottom").css({ transform: "translateX(-50%)" });
            $(".line-middle").css({ transform: "translateX(-50%)" });
        }
    }
);
$(".hamburger-js").click(function() {
    $(this).toggleClass("hamburger-js-active");
    $(".gnav").fadeToggle();
    if ($(".hamburger-js").hasClass("hamburger-js-active")) {
        $(this).find(".hamburger_text").text("CLOSE");
    } else {
        $(this).find(".hamburger_text").text("MENU");
    }
});