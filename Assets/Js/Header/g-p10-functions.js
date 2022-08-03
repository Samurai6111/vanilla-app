// /Js_/Header/g--p10-ajax-common.js
function show_ajax_loading_spinner() {
	// ---------- domを定義 ----------
	html =
		'<div id="overlay">'
		+ '<div class="cv-spinner">'
		+ '<span class="spinner"></span>'
		+ '</div>'
	+ '</div>'

	// ---------- domを設置 ----------
	$('body').prepend(html)

	$(document).ajaxSend(function() {
    $("#overlay").fadeIn(300);
  });
}

function hide_ajax_loading_spinner() {
	setTimeout(function(){
		$("#overlay").fadeOut(300);
	},500);
}
