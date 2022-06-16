<?php
$form_action_link = get_permalink()
. '/?user-id=' . s_GET('user-id')
. '&password-reset-key=' . s_GET('password-reset-key');
 ?>
<form action="<?php echo esc_attr($form_action_link); ?>" method="POST" class="vanillaForm">
	<?php wp_nonce_field('reset_password_form_nonce_action', 'reset_password_form_nonce_field'); ?>


	<?php Vanilla_Form_Validation::echo_validation_results($validations) ?>

	<ul class="form__list">
		<?php
		vanilla_form_template_row_item(
			vanilla_form_label('新しいパスワード', ''),
			vanilla_form_input('vanilla_form_input_reset_password', ''),
			'-login-form'
		);
		?>
	</ul>

	<div class="boxLayout__buttonWrap">
		<?php
		buttonType1([
			'text' => '送信',
		]);
		?>
	</div>
</form>
