/** --------------------------------
 * パスワードのinputタグを表示させる
 *
 * @param e element
 */
function show_password_input(e) {
    let target = $(e.target)
    let html = '<input class="-reset" type="password" name="user_pass" size="50" value="">'
    target.parent().append(html)
    target.hide()
}

/** --------------------------------
 * テーブルをカスタマイズするカラムを増やす
 *
 * @param e element
 */

function add_suumo_table_customize_column(e) {
    let html =
        '<tr>' +
        '<td>' +
        '<div class="pageMypageTable__tdHasButton">' +
        '<input class="-reset" type="text" name="suumo_table_custom_lables[]" size="50" value="">' +
        '<button class="suumoButtonType1 -color-reverse -small" type="button" onclick="remove_suumo_table_custom_column(event)">×</button>' +
        '</div>' +
        '</td>' +
        '</tr>'
    $('#suumoTableCustomize').append(html)

}