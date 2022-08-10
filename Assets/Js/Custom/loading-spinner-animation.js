// /Js_/Header/g--p10-ajax-common.js
function loading_spinner_animation() {
	// ---------- domを定義 ----------
	html =
		'<div id="ajaxLoading">'
		+ '<div class="ajaxLoading__spinnerWrap">'
		+ '<span class="ajaxLoading__spinner"></span>'
		+ '</div>'
	+ '</div>'

	// ---------- domを設置 ----------
	$('body').prepend(html)

	$("#ajaxLoading").fadeIn(300);
}

function hide_ajax_loading_spinner() {
	setTimeout(function(){
		$("#ajaxLoading").fadeOut(300);
	},500);
}
