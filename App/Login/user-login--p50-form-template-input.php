<form action="<?php echo esc_url(get_permalink()); ?>" method="POST" class="vanillaForm">
	<?php wp_nonce_field('user_login_form_nonce_action', 'user_login_form_nonce_field'); ?>

	<?php Vanilla_Form_Validation::echo_validation_results($validations) ?>

	<ul class="form__list">
		<?php
		vanilla_form_template_row_item(
			vanilla_form_label('メールアドレス', ''),
			vanilla_form_input('vanilla_form_input_login_email', ''),
			'-login-form'
		);
		vanilla_form_template_row_item(
			vanilla_form_label('パスワード', ''),
			vanilla_form_input('vanilla_form_input_login_password', ''),
			'-login-form'
		);
		?>
	</ul>

	<div class="form__forgotPassword">
		<?php
		linkType1([
			'href' => home_url('/forgot-password/'),
			'text' => 'パスワードを忘れた方',
		])
		?>
	</div>

	<div class="boxLayout__buttonWrap">
		<?php
		buttonType1([
			'text' => 'ログイン',
			'attr' => 'formaction="' . esc_url(get_permalink()) . '"',
		]);
		?>
	</div>
</form>
