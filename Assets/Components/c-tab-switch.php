<script>
	let current_url = '<?php echo esc_url(get_permalink()); ?>'
let url = new URL(current_url);
let search_params = url.searchParams;
const params = new URLSearchParams(window.location.search)
    //-----------------------------------------
    // タブのリロード時の処理
    //-----------------------------------------
$(function() {
    if (params.has('tab-target')) {
        let tab_target_id = params.get('tab-target')
            // ---------- タブ ----------
        $('.tabSwitch__labelItem').removeClass('-active')
        $('#' + tab_target_id).addClass('-active')
            // ---------- タブコンテンツ ----------
        $('.tabSwitch__content').hide()
        $('.tabSwitch__content[tab-content="' + tab_target_id + '"]').show()
    } else {
        $('.tabSwitch__labelItem#tab1').addClass('-active')
        $('.tabSwitch__content[tab-content="tab1"]').show()
    }
});
//-----------------------------------------
// タブクリック時にパラメータ追加
//-----------------------------------------
function add_tab_parameta(e) {
    let target = $(e.target)
    let tab_id = target.attr('id')
    search_params.set('tab-target', tab_id);
    url.search = search_params.toString();
    let new_url = url.toString();
    window.history.pushState({
        path: new_url
    }, '', new_url);
}
//-----------------------------------------
// タブの切り替え
//-----------------------------------------
if ($('.tabSwitch')) {
    let tabSwitch = $('.tabSwitch')
    let tabItem = $('.tabSwitch__labelItem')
    let tabContent = $('.tabSwitch__content')
    tabSwitch.find('.tabSwitch__labelItem').click(function() {
        tabItem.removeClass('-active')
        $(this).addClass('-active')
        let tabID = $(this).attr('id')
        tabContent.hide()
        $('.tabSwitch__content[tab-content="' + tabID + '"]').show()
    })
    let hash = window.location.hash;
    if (hash) {
        $(hash).trigger('click')
        window.location.hash = ''
    }
}
</script>
