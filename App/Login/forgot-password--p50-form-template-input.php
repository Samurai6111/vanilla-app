<form action="<?php echo esc_url(get_permalink()); ?>" method="POST" class="vanillaForm">
	<?php wp_nonce_field('forgot_password_form_nonce_action', 'forgot_password_form_nonce_field'); ?>


	<?php
	Vanilla_Form_Validation::echo_validation_results($validations) ?>

	<ul class="form__list">
		<?php
		vanilla_form_template_row_item(
			vanilla_form_label('メールアドレス', ''),
			vanilla_form_input('vanilla_form_input_forgot_password_email', ''),
			'-login-form'
		);
		?>
	</ul>

	<div class="boxLayout__buttonWrap">
		<?php
		buttonType1([
			'text' => '送信',
			'attr' => 'formaction="' . esc_url(get_permalink()) . '"',
		]);
		?>
	</div>
</form>
