<script src="https://yubinbango.github.io/yubinbango/yubinbango.js"
				charset="UTF-8"></script>

<form class="form h-adr <?= esc_attr('-' . s_GET('form-action')) ?>"
			enctype="multipart/form-data"
			method="POST"
			id="form">
	<?php wp_nonce_field('ef__nonce_action', 'ef__nonce_field'); ?>

	<ul class="form__list">
		<?php
		vanilla_form_template_row_item(
			vanilla_form_label('氏名', '-name -required'),
			vanilla_form_input('vanilla_form_input_name', '-col2-max')
		);

		vanilla_form_template_row_item(
			vanilla_form_label('メールアドレス', '-required -email'),
			vanilla_form_input('vanilla_form_input_email', '')
		);
		?>

	</ul>


	<div class="form__buttonWrap">
		<p class="form__agreementText">上記内容に問題なければ、<br class="-sp-only">「同意して確認画面へ」ボタンを<br class="-sp-only">押してください。</p>

		<?php if (current_form_action('confirm')) { ?>
		<button class="form__button"
						type="submit"
						formaction="<?= esc_url(form_action_url('send')) ?>">送信する</button>

		<button class="form__button -bg-lightgray"
						type="submit"
						formaction="<?= esc_url(s_POST('_wp_http_referer')) ?>">修正する</button>

		<?php } else {
			$ef_action_url = home_url('/entry/?type=' . s_GET('type')
				. '&form-action=confirm');
			if (s_GET('event-id') && s_GET('category')) {
				$ef_action_url .= '&event-id=' . s_GET('event-id')
					. '&category=' . s_GET('category');
			} elseif (s_GET('event-id') && !s_GET('category')) {
				$ef_action_url .= '&event-id=' . s_GET('event-id');
			}
		?>
		<button class="form__button"
						type="submit"
						formaction="<?= esc_url($ef_action_url) ?>">同意して確認画面へ</button>
		<?php } ?>
	</div>
</form>


<script>
//-----------------------------------------
// チェックボックスの必須
//-----------------------------------------
function checkbox_require_switch() {
	if ($('.form__checkbox:checked').length > 0) {
		$('.form__checkbox').removeAttr('required')
	} else {
		$('.form__checkbox').attr('required', 'required')
	}
}

$('.form__checkbox').on('change', function() {
	checkbox_require_switch()
})

$(window).on('load', function() {
	checkbox_require_switch()
})
</script>

<?php
global $current_user;
if ($current_user->user_login === 'admin') { ?>
<script>
let form = $('#form')
$('.form__label.-name').click(function() {
	// form.find('*').removeAttr('required')
	form.find('input[name="register_last_name"]').val('山田')
	form.find('input[name="register_first_name"]').val('太郎')
	form.find('input[name="register_last_name_kana"]').val('ヤマダ')
	form.find('input[name="register_first_name_kana"]').val('タロウ')
	form.find('input[name="ef__school_name"]').val('テスト大学')
	form.find('input[name="ef__school_of"]').val('国際経済学部')
	form.find('input[name="ef__department"]').val('マーケティング科')
	form.find('select[name="ef__graduation_year"] option[value="2019"]').attr('selected', 'selected')
	form.find('select[name="ef__graduation_month"] option[value="3"]').attr('selected', 'selected')

	form.find('input[name="ef__post_number"]').val('106-0032')
	form.find('select[name="ef__prefecture"] option[value="東京都"]').attr('selected', 'selected')
	form.find('input[name="ef__town"]').val('港区六本木')

	form.find('select[name="register_dob_year"] option[value="1997"]').attr('selected', 'selected')
	form.find('select[name="register_dob_month"] option[value="12"]').attr('selected', 'selected')
	form.find('select[name="register_dob_date"] option[value="10"]').attr('selected', 'selected')

	form.find('input[name="ef__tel"]').val('00011112222')
	form.find('input[name="register_email"]').val('s.kawakatsu@roseaupensant.jp')
	form.find('textarea[name="ef__comment"]').val('コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。')
	form.find('input[name="ef__opportunities[ef__opportunity_mynavi][]"]').prop('checked', true)
	form.find('input[type="checkbox"][name="ef__opportunities[ef__opportunity_seminar][]"]').prop('checked', true)
	form.find('input[type="text"][name="ef__opportunities[ef__opportunity_seminar][]"]').val('テスト合同かい')
})
</script>
<?php } ?>
