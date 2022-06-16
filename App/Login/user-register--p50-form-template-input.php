<section class="formWrap">
	<div class="container">

		<div class="formContainer">
			<section class="form__textWrap <?= '-' . esc_attr(s_GET('form-action')) ?>">
				<?php if (s_GET('form-action') === 'confirm') { ?>
					<p class="form__text -large">以下の内容で送信してよろしいですか？</p>
				<?php } else { ?>
					<p class="form__text">以下の情報を入力し、<br class="-sp-only">確認ボタンをクリックしてください。</p>
				<?php } ?>
			</section>

			<?php Vanilla_Form_Validation::echo_validation_results($validations) ?>

			<form class="vanillaForm -register <?= esc_attr('-' . s_GET('form-action')) ?>" method="POST" action="<?= esc_attr(get_permalink() . '?form-action=confirm') ?>" name="registerForm" id="registerForm">
				<?php wp_nonce_field('user_register_form_nonce_action', 'user_register_form_nonce_field'); ?>

				<ul class="form__list <?= esc_attr('-' . s_GET('form-action')) ?>">
					<?php
					vanilla_form_template_row_item(
						vanilla_form_label('氏名', '-name -required'),
						vanilla_form_input('vanilla_form_input_name', '-col2-max')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('生年月日', '-required -dob'),
						vanilla_form_input('vanilla_form_input_dob', '-cols-with-unit -sp-jcsb')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('性別', '-required -gender'),
						vanilla_form_input('vanilla_form_input_gender', '-cols-with-unit -sp-jcsb')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('職業', '-required -occupation'),
						vanilla_form_input('vanilla_form_input_occupation', '-cols-with-unit')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('メールアドレス', '-required -email'),
						vanilla_form_input('vanilla_form_input_email', '')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('メールアドレス（確認）', '-required -email-confirm'),
						vanilla_form_input('vanilla_form_input_email_confirm', '')
					);

					vanilla_form_template_row_item(
						vanilla_form_label('パスワード', '-required -password'),
						vanilla_form_input('vanilla_form_input_password', '')
					);

					if (s_GET('form-action') !== 'confirm') {
						vanilla_form_template_row_item(
							vanilla_form_label('パスワード（確認）', '-required -password-confirm'),
							vanilla_form_input('vanilla_form_input_password_confirm', ''),
							'-confirm-hidden'
						);
					}
					?>
				</ul>

				<div class="form__buttonWrap">
					<?php
					if (
						!s_GET('form-action') ||
						s_GET('form-action') === 'input'
					) {

						$action_attr = home_url('/register/');
						$button_attr = 'formaction="' . esc_url($action_attr) . '"';
						buttonType1([
							'text' => '入力内容を確認する',
							'attr' => $button_attr,
						]);
					} elseif (s_GET('form-action') === 'confirm') {
						$action_attr = get_permalink() . '?form-action=send';
						$button_attr = 'formaction="' . esc_url($action_attr) . '"';
						buttonType1([
							'text' => '送信する',
							'attr' => $button_attr,
						]);

						$action_attr = get_permalink() . '?form-action=input';
						$button_attr = 'formaction="' . esc_url($action_attr) . '"';
						buttonType1([
							'class' => '-back',
							'text' => '戻る',
							'attr' => $button_attr,
						]);
					}
					?>
				</div>
			</form>

			<form id="registerForm_submit" method="POST" name="registerForm_submit" action="<?= esc_attr(get_permalink() . '?form-action=confirm') ?>">
				<?php if (is_array($s_POST) && !empty($s_POST)) {
					foreach ($s_POST as $key => $value) {
				?>
						<input type="hidden" name="<?= esc_attr($key) ?>" value="<?= esc_attr($value) ?>">
				<?php
					}
				} ?>
			</form>
		</div>
	</div>
</section>

<?php
//--------------------------------------------------
// バリデーションエラーがなかったら送信
//--------------------------------------------------[]
if (
	'POST' === $_SERVER['REQUEST_METHOD'] &&
	!isset($_GET['form-action']) &&
	count($validations) === 0
) {
?>
	<script>
		$('#registerForm_submit').submit()
	</script>
<?php
}


global $current_user;
//if ($current_user->user_login === 'admin') {
?>
<script>
	let registerForm = $('#registerForm')
	$('.-name').click(function() {
		// registerForm.find('*').removeAttr('required')
		registerForm.find('input[name="usermeta_last_name"]').val('たなか')
		registerForm.find('input[name="usermeta_first_name"]').val('花子')
		registerForm.find('select[name="usermeta_dob_year"] option[value="1997"]').attr('selected', 'selected')
		registerForm.find('select[name="usermeta_dob_month"] option[value="12"]').attr('selected', 'selected')
		registerForm.find('select[name="usermeta_dob_date"] option[value="10"]').attr('selected', 'selected')
		registerForm.find('#usermeta_gender_male').attr('checked', 'checked')
		registerForm.find('select[name="usermeta_occupation"] option[value="学生"]').attr('selected', 'selected')
		registerForm.find('input[name="user_email"]').val('test@gmail.com')
		registerForm.find('input[name="user_password"]').val('test')
		registerForm.find('input[name="user_email_confirm"]').val('test@gmail.com')
		registerForm.find('input[name="user_password_confirm"]').val('test')
	})
</script>
<? //php }
?>
