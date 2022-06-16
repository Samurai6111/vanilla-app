<?php

use Carbon\Carbon;

class Vanilla_Form_Row_Input {
	function __construct($input_template, $class = '') {
		$this->input_template = $input_template;
		$this->class = $class;
		$this->event_id = (s_GET('event-id')) ? s_GET('event-id') : '';
		$user_id = get_current_user_id();
		$this->Vanilla_User = new Vanilla_User($user_id);
	}

	//--------------------------------------------------
	// 名前 (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_name() {
		if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('usermeta_last_name') . ' ' . s_POST('usermeta_first_name')) ?>
			</p>

			<input type="hidden" name="usermeta_last_name" value="<?= esc_attr(s_POST('usermeta_last_name')) ?>">

			<input type="hidden" name="usermeta_first_name" value="<?= esc_attr(s_POST('usermeta_first_name')) ?>">

		<?php } else {

		?>
			<input type="text" class="-reset" name="usermeta_last_name" value="<?= esc_attr($this->Vanilla_User->meta('usermeta_last_name')) ?>" placeholder="姓（全角）">

			<input type="text" class="-reset" name="usermeta_first_name" value="<?= esc_attr($this->Vanilla_User->meta('usermeta_first_name')) ?>" placeholder="名（全角）">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 生年月日 (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_dob() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<?php
			$user_dob_output =
				s_POST('usermeta_dob_year') . '年 '
				. s_POST('usermeta_dob_month') . '月 '
				. s_POST('usermeta_dob_date') . '日';
			?>

			<p class="form__output">
				<?= esc_html($user_dob_output); ?>
			</p>

			<input type="hidden" name="usermeta_dob_year" value="<?= esc_attr(s_POST('usermeta_dob_year')) ?>">
			<input type="hidden" name="usermeta_dob_month" value="<?= esc_attr(s_POST('usermeta_dob_month')) ?>">
			<input type="hidden" name="usermeta_dob_date" value="<?= esc_attr(s_POST('usermeta_dob_date')) ?>">

		<?php } else { ?>

			<div class="form__inputUnitWrap -dob -year">
				<div class="form__selectWrap">
					<select class="form__inputSelect" name="usermeta_dob_year">
						<option value="" selected disabled>----</option>

						<?php
						$year_max = Carbon::today()->year - 16;
						$year = $year_max;
						while (1972 < $year) {
							--$year;
							$selected = ($year === (int)$this->Vanilla_User->meta('usermeta_dob_year')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($year) ?>" <?= esc_attr($selected) ?>><?= esc_html($year) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="form__inputUnit">年</span>
			</div>

			<div class="form__inputUnitWrap -dob -month">
				<div class="form__selectWrap">
					<select class="form__inputSelect" name="usermeta_dob_month">
						<option value="" selected disabled>----</option>

						<?php
						$month = 0;
						while ($month < 12) {
							++$month;
							$selected = ($month === (int)$this->Vanilla_User->meta('usermeta_dob_month')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($month) ?>" <?= esc_attr($selected) ?>><?= esc_html($month) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="form__inputUnit">月</span>
			</div>

			<div class="form__inputUnitWrap -dob -date">
				<div class="form__selectWrap">
					<select class="form__inputSelect" name="usermeta_dob_date">
						<option value="" selected disabled>----</option>

						<?php
						$date = 0;
						while ($date < 31) {
							++$date;
							$selected = ($date === (int)$this->Vanilla_User->meta('usermeta_dob_date')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($date) ?>" <?= esc_attr($selected) ?>><?= esc_html($date) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="form__inputUnit">日</span>
			</div>


		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 性別
	//--------------------------------------------------
	private function vanilla_form_input_gender() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('usermeta_gender')) ?>
			</p>

			<input type="hidden" name="usermeta_gender" value="<?= esc_attr($this->Vanilla_User->meta('usermeta_gender')) ?>">

		<?php } else { ?>
			<?php

			if ($this->Vanilla_User->meta('usermeta_gender') === '女性') {
				$checked_female = 'checked';
			} elseif ($this->Vanilla_User->meta('usermeta_gender') === '男性') {
				$checked_male = 'checked';
			} elseif ($this->Vanilla_User->meta('usermeta_gender') === '回答しない')
				$checked_other = 'checked';
			?>
			<div class="form__inputUnitWrap">
				<input type="radio" class="form__inputRadio" id="usermeta_gender_male" name="usermeta_gender" value="女性" <?= esc_attr($checked_female) ?>>

				<label class="form__inputUnit" for="usermeta_gender_male">女性</label>
			</div>

			<div class="form__inputUnitWrap">
				<input type="radio" class="form__inputRadio" id="usermeta_gender_female" name="usermeta_gender" value="男性" <?= esc_attr($checked_male) ?>>

				<label class="form__inputUnit" for="usermeta_gender_female">男性</label>
			</div>

			<div class="form__inputUnitWrap">
				<input type="radio" class="form__inputRadio" id="usermeta_gender_other" name="usermeta_gender" value="回答しない" <?= esc_attr($checked_other) ?>>

				<label class="form__inputUnit" for="usermeta_gender_other">回答しない</label>
			</div>


		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 職業 (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_occupation() {
		global $user_occumations;
	?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('usermeta_occupation')) ?>
			</p>

			<input type="hidden" name="usermeta_occupation" value="<?= esc_attr($this->Vanilla_User->meta('usermeta_occupation')) ?>">

		<?php } else { ?>

			<div class="form__selectWrap">
				<select class="form__inputSelect -occupation" name="usermeta_occupation">
					<option value="" selected disabled>----</option>

					<?php foreach ($user_occumations as $occumation) {
						$selected = ($this->Vanilla_User->meta('usermeta_occupation') === $occumation) ? 'selected' : '';
					?>
						<option value="<?= esc_attr($occumation) ?>" <?= esc_attr($selected) ?>>
							<?= esc_html($occumation) ?>
						</option>
					<?php } ?>
				</select>
			</div>
		<?php } ?>
	<?php }

	//--------------------------------------------------
	// メールアドレス (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_email() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('user_email')) ?>
			</p>

			<input type="hidden" name="user_email" value="<?= esc_attr(s_POST('user_email')) ?>">

		<?php } else { ?>

			<input type="email" class="-reset" name="user_email" value="<?= esc_attr($this->Vanilla_User->get_user('user_email')) ?>" placeholder="">
		<?php } ?>
	<?php }

	//--------------------------------------------------
	// メールアドレス確認 (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_email_confirm() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('user_email_confirm')) ?>
			</p>
		<?php } else { ?>
			<input type="email" class="-reset" name="user_email_confirm" placeholder="">
		<?php } ?>
	<?php }

	//--------------------------------------------------
	// パスワード (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_password() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?php
				$password = s_POST('user_password');
				$length = mb_strlen($password, 'UTF-8');
				echo str_repeat('*', $length) . PHP_EOL;
				?>

			</p>

			<input type="hidden" name="user_password" value="<?= esc_attr(s_POST('user_password')) ?>">

		<?php } else { ?>
			<input type="password" class="-reset" name="user_password" value="<?= esc_attr(s_POST('user_password')) ?>">
		<?php } ?>
	<?php }

	//--------------------------------------------------
	// パスワード (会員登録/会員情報変更フォーム)
	//--------------------------------------------------
	private function vanilla_form_input_password_confirm() { ?>
		<?php if (s_GET('form-action') === 'confirm') { ?>
			<p class="form__output">
				<?= esc_html(s_POST('user_password_confirm')) ?>
			</p>
		<?php } else { ?>
			<input type="password" class="-reset" name="user_password_confirm">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// メールアドレス （ログインフォーム）
	//--------------------------------------------------
	private function vanilla_form_input_login_email() { ?>
		<input type="email" class="-reset" name="login_email" value="<?= esc_attr(s_POST('login_email')) ?>">
	<?php }


	//--------------------------------------------------
	// パスアード （ログインフォーム）
	//--------------------------------------------------
	private function vanilla_form_input_login_password() { ?>
		<input type="password" class="-reset" name="login_password" value="<?= esc_attr(s_POST('login_password')) ?>">
	<?php }


	//--------------------------------------------------
	// メールアドレス （パスワードを忘れた方へ）
	//--------------------------------------------------
	private function vanilla_form_input_forgot_password_email() { ?>
		<input type="email" class="-reset" name="forgot_password_email" value="<?= esc_attr(s_POST('forgot_password_email')) ?>">
	<?php }


	//--------------------------------------------------
	// パスワード (パスワードリセット)
	//--------------------------------------------------
	private function vanilla_form_input_reset_password() { ?>
		<input type="hidden" name="user_id" value="<?= esc_attr(s_GET('user-id')) ?>">
		<input type="password" class="-reset" name="reset_password" value="<?= esc_attr(s_POST('reset_password')) ?>">
	<?php }



	//--------------------------------------------------
	//
	//--------------------------------------------------
	private function input_wrap($vanilla_form_input_content) { ?>
		<div class="form__inputWrap <?= esc_attr($this->class) ?>">
			<?php $vanilla_form_input_content(); ?>
		</div>
<?php }


	//--------------------------------------------------
	//
	//--------------------------------------------------
	public function vanilla_form_input() {
		$this->input_wrap([$this, $this->input_template]);
	}
}

/**
 * formRowInputをベースにformRow（）のcallbackとなる配列を出力する関数
 *
 * @param $text　テキスト
 * @param $class　該当のクラス
 */
function vanilla_form_input($input_template, $class) {
	$Vanilla_FormRowInput = new Vanilla_Form_Row_Input($input_template, $class);
	return [$Vanilla_FormRowInput, 'vanilla_form_input'];
}
