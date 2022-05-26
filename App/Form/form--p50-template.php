<script src="https://yubinbango.github.io/yubinbango/yubinbango.js"
				charset="UTF-8"></script>

<form class="entryForm h-adr <?= esc_attr('-' . s_GET('form-action')) ?>"
			enctype="multipart/form-data"
			method="POST"
			id="entryForm">
	<?php wp_nonce_field('ef__nonce_action', 'ef__nonce_field'); ?>

	<ul class="entryForm__list">
		<?php
		form_template_row_item(
			ef__label('氏名', '-name -required'),
			ef__input('ef__input_name', '-col2-max')
		);

		form_template_row_item(
			ef__label('メールアドレス', '-required -email'),
			ef__input('ef__input_email', '')
		);
		?>

	</ul>


	<div class="entryForm__buttonWrap">
		<p class="entryForm__agreementText">上記内容に問題なければ、<br class="-sp-only">「同意して確認画面へ」ボタンを<br class="-sp-only">押してください。</p>

		<?php if (current_form_action('confirm')) { ?>
		<button class="entryForm__button"
						type="submit"
						formaction="<?= esc_url(form_action_url('send')) ?>">送信する</button>

		<button class="entryForm__button -bg-lightgray"
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
		<button class="entryForm__button"
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
	if ($('.entryForm__checkbox:checked').length > 0) {
		$('.entryForm__checkbox').removeAttr('required')
	} else {
		$('.entryForm__checkbox').attr('required', 'required')
	}
}

$('.entryForm__checkbox').on('change', function() {
	checkbox_require_switch()
})

$(window).on('load', function() {
	checkbox_require_switch()
})
</script>

<?php
global $current_user;
if ($current_user->user_login === 'vanilla-admin') { ?>
<script>
let entryForm = $('#entryForm')
$('.entryForm__label.-name').click(function() {
	// entryForm.find('*').removeAttr('required')
	entryForm.find('input[name="ef__last_name"]').val('山田')
	entryForm.find('input[name="ef__first_name"]').val('太郎')
	entryForm.find('input[name="ef__last_name_kana"]').val('ヤマダ')
	entryForm.find('input[name="ef__first_name_kana"]').val('タロウ')
	entryForm.find('input[name="ef__school_name"]').val('テスト大学')
	entryForm.find('input[name="ef__school_of"]').val('国際経済学部')
	entryForm.find('input[name="ef__department"]').val('マーケティング科')
	entryForm.find('select[name="ef__graduation_year"] option[value="2019"]').attr('selected', 'selected')
	entryForm.find('select[name="ef__graduation_month"] option[value="3"]').attr('selected', 'selected')

	entryForm.find('input[name="ef__post_number"]').val('106-0032')
	entryForm.find('select[name="ef__prefecture"] option[value="東京都"]').attr('selected', 'selected')
	entryForm.find('input[name="ef__town"]').val('港区六本木')

	entryForm.find('select[name="ef__dob_year"] option[value="1997"]').attr('selected', 'selected')
	entryForm.find('select[name="ef__dob_month"] option[value="12"]').attr('selected', 'selected')
	entryForm.find('select[name="ef__dob_date"] option[value="10"]').attr('selected', 'selected')

	entryForm.find('input[name="ef__tel"]').val('00011112222')
	entryForm.find('input[name="ef__email"]').val('s.kawakatsu@roseaupensant.jp')
	entryForm.find('textarea[name="ef__comment"]').val('コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。コメントが入ります。')
	entryForm.find('input[name="ef__opportunities[ef__opportunity_mynavi][]"]').prop('checked', true)
	entryForm.find('input[type="checkbox"][name="ef__opportunities[ef__opportunity_seminar][]"]').prop('checked', true)
	entryForm.find('input[type="text"][name="ef__opportunities[ef__opportunity_seminar][]"]').val('テスト合同かい')
})
</script>
<?php } ?>