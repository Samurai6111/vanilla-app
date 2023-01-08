//=============================================
//
// cellの塗りつぶしに関する処理
//
//=============================================
/** --------------------------------
* cellをクリック状態でマウスオーバーした時に塗りつぶし
*
* @param e
*/
function mouse_over_fill(e) {
	//= クリックしている時 ====
	if (e.buttons == 1 || e.buttons == 3) {
		let count_to_add = $('.pixelartColor__input:checked').val()
		$(this).attr('data-contribution-count', count_to_add)
	}
}

/** --------------------------------
* cellをクリックした時に塗りつぶし
*
* @param e
*/
function mouse_click_fill(e) {
	let count_to_add = $('.pixelartColor__input:checked').val()
	$(this).attr('data-contribution-count', count_to_add)
}

/** --------------------------------
* 塗りつぶし実行
*/
function fill_excute() {
	let cells = $('.pixelartTable__cell')
	cells.each(function () {
		let cell = $(this)[0]
		cell.addEventListener("mouseover", mouse_over_fill);
		cell.addEventListener("click", mouse_click_fill);
	})
}

//===================================
// 塗りつぶし実行
//===================================
setTimeout(function () { fill_excute() }, 100);


/** --------------------------------
* ピクセルアートのテーブルを初期状態に戻す
*
* @param
*/
function reset_pixel_art_table(e) {
	let cells = $('.pixelartTable__cell')

	cells.each(function () {
		$(this).attr('data-contribution-count', 0)
	})
}

/** --------------------------------
* ピクセルアートのテーブルをlocalStorageに保存する
*
* @param
*/
function save_pixel_art_table(e) {
	let container = $('#pixelartTableContainer')
	let html = container.html()

	window.localStorage.setItem('pixel_table_elements', html)

	alert('保存されました')
}


/** --------------------------------
* localStorageからピクセルアートのテーブルをページに挿入する
*/
function insert_pixel_art_table() {
	let pixel_table_elements = window.localStorage.getItem('pixel_table_elements')

	if (pixel_table_elements) {
		$('#pixelartTableContainer').empty()
		$('#pixelartTableContainer').html(pixel_table_elements)
	}
}

//===================================
// 実行
//===================================
$(window).on('load', function () {
	// insert_pixel_art_table()
});

function git_command(date_command) {
	return 'git commit --allow-empty -m "COMMIT" --date="' + date_command + '" ' + "\n"

}

/** --------------------------------
* git commandを生成する
*
* @param
*/
function generate_git_command() {
	let cells = $('.pixelartTable__cell')
	let git_commands = ''

	cells.each(function () {
		let count = $(this).attr('data-contribution-count')
		let date_command =  $(this).attr('data-date-command')
		for (let i = 0; i < count; i++) {
			let git_command_string = git_command(date_command)
			git_commands += git_command_string
		}
	})

	$('textarea').val(git_commands)

}
