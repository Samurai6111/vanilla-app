<?php Vanilla_Form_Validation::echo_validation_results($validations) ?>

<form class="vanillaForm <?= esc_attr('-' . s_GET('form-action')) ?>" id="vanillaForm" enctype="multipart/form-data" method="POST" id="form">

	<?php vanilla_wp_nonce_field('contact_form') ?>

	<ul class="vanillaForm__rowList">
		<?php
		$vanilla_form = new Vanilla_Form();

		$vanilla_form->row_item(
			vanilla_form_label('会社名'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::company_name'),
			'-input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('お名前'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::name'),
			'-required -gap-10 -input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('メールアドレス'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::email'),
			'-required -input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('メールアドレス確認用'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::email_confirm'),
			'-required -input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('お電話番号'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::tel'),
			'-required -input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('ご住所'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::address'),
			'-input-width-full'
		);

		$vanilla_form->row_item(
			vanilla_form_label('お問い合わせ内容'),
			vanilla_form_input('Vanilla_Form_Row_Input_Contents::notes'),
			'-required -input-width-full'
		);
		?>
	</ul>

	<article class="vanillaFormPrivacy">
		<h3 class="vanillaFormPrivacy__title">個人情報の取り扱いについて</h3>
		<p class="vanillaFormPrivacy__text">
			お問い合わせいただいた内容は、弊社で管理し、お問い合わせへのご回答・資料送付・メール配信などのフォローアップ、当社の製品、サービスに関するご案内以外の目的には使用いたしません。また、ご登録者の許諾なく第３者に開示することはありません。弊社の個人情報の取り扱いはこちらでご確認できます。フォーム送信後、ご登録のメールアドレス宛にフォーム入力内容の確認メールをお送りいたします。メールをご確認いただき、入力内容に誤りがありましたらメール記載の弊社窓口までお問い合わせください。
		</p>
	</article>

	<div class="vanillaForm__privacyCheckboxWrap">
		<?php Vanilla_Form_Row_Input_Contents::privacy_policy_confirm() ?>
	</div>

	<div class="vanillaForm__buttonWrap">
		<?php vanilla_form_buttons() ?>
	</div>
</form>



<?php



echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>
<script>
	let form = $('#vanillaForm')
	form.click(function() {
		// form.find('*').removeAttr('required')
		// form.find('input[name="company_name"]').val('株式会社test')
		// form.find('input[name="family_name"]').val('山田')
		// form.find('input[name="first_name"]').val('太郎')
		// form.find('input[name="email"]').val('s.kawakatsu@roseaupensant.jp')
		// form.find('input[name="email_confirm"]').val('s.kawakatsu@roseaupensant.jp')
		// form.find('input[name="tel"]').val('000-0000-0000')
		// form.find('input[name="address"]').val('東京都○○○○○○○○○○○○○○1-1-1○○○○ビル101号室')
		// form.find('textarea[name="notes"]').val('テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります')
	})
</script>
