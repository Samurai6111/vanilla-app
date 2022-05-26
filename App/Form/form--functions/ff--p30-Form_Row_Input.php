
<?php

use Carbon\Carbon;

class Form_Row_Input {
	function __construct($input_template, $class = '') {
		$this->input_template = $input_template;
		$this->class = $class;
		$this->event_id = (s_GET('event-id')) ? s_GET('event-id') : '';
	}

	//--------------------------------------------------
	// イベント名 ＊自動入力
	//--------------------------------------------------
	private function ef__event_name() {
		if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__event_name')) ?>
			</p>

			<input type="hidden" name="ef__event_name" value="<?= esc_attr(s_POST('ef__event_name')) ?>">

		<?php } else {
			$event_term_name = get_the_terms($this->event_id, 'event_taxonomy')[0];
			if (!$event_term_name) {
				wp_safe_redirect(home_url('/event/'));
				exit;
			}
		?>
			<p class="entryForm__output">
				<?= esc_html($event_term_name->name) ?>
			</p>

			<input type="hidden" name="ef__event_name" value="<?= esc_attr($event_term_name->name) ?>">
		<?php } ?>

		<?php }

	//--------------------------------------------------
	// 日時（イベント日時） ＊自動入力
	//--------------------------------------------------
	private function ef__event_time() {
		if (current_form_action('confirm')) {
		?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__event_date')) ?>
			</p>
			<input type="hidden" name="ef__event_date" value="<?= esc_attr(s_POST('ef__event_date')) ?>">

		<?php } else {
			$Post = new Post($this->event_id);
			$event_date = $Post->event__date();
			$event_term_name = get_the_terms($this->event_id, 'event_taxonomy')[0];
			if (!$event_term_name) {
				wp_safe_redirect(home_url('/event/?category=intern'));
				exit;
			}
		?>
			<p class="entryForm__output">
				<?= esc_html($event_date) ?>
			</p>
			<input type="hidden" name="ef__event_date" value="<?= esc_attr($event_date) ?>">
		<?php } ?>
		<?php }


	//--------------------------------------------------
	// 名前 *必須
	//--------------------------------------------------
	private function ef__input_name() {
		if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__last_name') . ' ' . s_POST('ef__first_name')) ?>
			</p>

			<input type="hidden" name="ef__last_name" value="<?= esc_attr(s_POST('ef__last_name')) ?>">

			<input type="hidden" name="ef__first_name" value="<?= esc_attr(s_POST('ef__first_name')) ?>">

		<?php } else { ?>
			<input type="text" class="-reset" name="ef__last_name" required value="<?= esc_attr(s_POST('ef__last_name')) ?>" placeholder="姓（全角）">

			<input type="text" class="-reset" name="ef__first_name" required value="<?= esc_attr(s_POST('ef__first_name')) ?>" placeholder="名（全角）">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// フリガナ *必須
	//--------------------------------------------------
	private function ef__input_name_kana() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__last_name_kana') . ' ' . s_POST('ef__first_name_kana')) ?>
			</p>

			<input type="hidden" name="ef__last_name_kana" value="<?= esc_attr(s_POST('ef__last_name_kana')) ?>">

			<input type="hidden" name="ef__first_name_kana" value="<?= esc_attr(s_POST('ef__first_name_kana')) ?>">

		<?php } else { ?>
			<input type="text" class="-reset" name="ef__last_name_kana" required value="<?= esc_attr(s_POST('ef__last_name_kana')) ?>" placeholder="フリガナ（姓）">

			<input type="text" class="-reset" name="ef__first_name_kana" required value="<?= esc_attr(s_POST('ef__first_name_kana')) ?>" placeholder="フリガナ（名）">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 学校名 *必須
	//--------------------------------------------------
	private function ef__input_school() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__school_name')) ?>
			</p>

			<input type="hidden" name="ef__school_name" value="<?= esc_attr(s_POST('ef__school_name')) ?>">

		<?php } else { ?>
			<input type="text" class="-reset" name="ef__school_name" required value="<?= esc_attr(s_POST('ef__school_name')) ?>" placeholder="学校名">

		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 学部・学科
	//--------------------------------------------------
	private function ef__input_full_department() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__school_of') . ' ' . s_POST('ef__department')) ?>
			</p>

			<input type="hidden" name="ef__school_of" value="<?= esc_attr(s_POST('ef__school_of')) ?>">

			<input type="hidden" name="ef__department" value="<?= esc_attr(s_POST('ef__department')) ?>">

		<?php } else { ?>
			<input type="text" class="-reset" name="ef__school_of" value="<?= esc_attr(s_POST('ef__school_of')) ?>" placeholder="学部">

			<input type="text" class="-reset" name="ef__department" value="<?= esc_attr(s_POST('ef__department')) ?>" placeholder="学科">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 卒業年月日 *必須
	//--------------------------------------------------
	private function ef__input_graduation_ym() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__graduation_year') . '年 ' . s_POST('ef__graduation_month') . '月') ?>
			</p>

			<input type="hidden" name="ef__graduation_year" value="<?= esc_attr(s_POST('ef__graduation_year')) ?>年">

			<input type="hidden" name="ef__graduation_month" value="<?= esc_attr(s_POST('ef__graduation_month')) ?>月">

		<?php } else { ?>
			<div class="entryForm__inputUnitWrap">
				<div class="entryForm__selectWrap">
					<select name="ef__graduation_year" required>
						<option value="" selected disabled>----</option>
						<?php
						$year_max = Carbon::today()->year + 3;
						$year = $year_max;


						while (2012 < $year) {
							--$year;
							$selected = ($year === (int)s_POST('ef__graduation_year')) ? 'selected' : '';
						?>

							<option value="<?= esc_attr($year) ?>" <?= esc_attr($selected) ?>><?= esc_html($year) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="entryForm__inputUnit">年</span>
			</div>

			<div class="entryForm__inputUnitWrap">
				<div class="entryForm__selectWrap">
					<select name="ef__graduation_month" required>
						<option value="" selected disabled>----</option>
						<?php
						$month = 0;
						while ($month < 12) {
							++$month;
							$selected = ($month === (int)s_POST('ef__graduation_month')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($month) ?>" <?= esc_attr($selected) ?>><?= esc_html($month) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="entryForm__inputUnit">月</span>
			</div>
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 住所
	//--------------------------------------------------
	private function ef__input_full_address() { ?>
		<?php if (current_form_action('confirm')) { ?>

			<div class="entryForm__inputItemBox">
				<div class="entryForm__inputItems">
					<p class="entryForm__output">
						〒<?= esc_html(s_POST('ef__post_number')); ?>
					</p>

					<input type="hidden" name="ef__post_number" value="<?= esc_attr(s_POST('ef__post_number')) ?>">
				</div>
			</div>

			<div class="entryForm__inputItemBox">
				<div class="entryForm__inputItems">
					<p class="entryForm__output">
						<?= esc_html(s_POST('ef__prefecture')); ?>
					</p>

					<input type="hidden" name="ef__prefecture" value="<?= esc_attr(s_POST('ef__prefecture')) ?>">
				</div>
			</div>

			<div class="entryForm__inputItemBox">
				<div class="entryForm__inputItems">
					<p class="entryForm__output">
						<?= esc_html(s_POST('ef__town')); ?>
					</p>

					<input type="hidden" name="ef__town" value="<?= esc_attr(s_POST('ef__town')) ?>">
				</div>
			</div>

		<?php } else { ?>

			<span class="p-country-name" style="display:none;">Japan</span>

			<div class="entryForm__inputItemBox">
				<p class="entryForm__inputItemLabel">
					郵便番号
				</p>

				<div class="entryForm__inputItems">
					<input type="text" inputmode="numeric" class="p-postal-code -postNumber" value="<?= esc_attr(s_POST('ef__post_number')) ?>" name="ef__post_number" placeholder="郵便番号">
				</div>
			</div>

			<div class="entryForm__inputItemBox">
				<p class="entryForm__inputItemLabel">
					都道府県
				</p>

				<div class="entryForm__inputItems">
					<div class="entryForm__selectWrap -prefecture">
						<select name="ef__prefecture" class="p-region" id="ef__prefecture">
							<option value="" selected disabled>----</option>
							<?php
							global $prefectures;
							foreach ($prefectures as $prefecture) {
								$selected = ($prefecture === s_POST('ef__prefecture')) ? 'selected' : '';
							?>
								<option value="<?= esc_attr($prefecture) ?>" <?= esc_attr($selected) ?>><?= esc_html($prefecture) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>

			<div class="entryForm__inputItemBox">
				<p class="entryForm__inputItemLabel">
					市区町村・建物名
				</p>

				<div class="entryForm__inputItems">
					<input type="text" class="p-locality p-street-address p-extended-address" name="ef__town" value="<?= esc_attr(s_POST('ef__town')) ?>" placeholder="例：世田谷区駒沢1-4-15　真井ビル5階">
				</div>
			</div>



		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 生年月日 *必須
	//--------------------------------------------------
	private function ef__input_dob() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<?php
			$ef__dob_output =
				s_POST('ef__dob_year') . '年 '
				. s_POST('ef__dob_month') . '月 '
				. s_POST('ef__dob_date') . '日';

			?>
			<p class="entryForm__output">
				<?= esc_html($ef__dob_output); ?>
			</p>

			<input type="hidden" name="ef__dob_year" value="<?= esc_attr(s_POST('ef__dob_year')) ?>年">

			<input type="hidden" name="ef__dob_month" value="<?= esc_attr(s_POST('ef__dob_month')) ?>月">

			<input type="hidden" name="ef__dob_date" value="<?= esc_attr(s_POST('ef__dob_date')) ?>日">

		<?php } else { ?>
			<div class="entryForm__inputUnitWrap">
				<div class="entryForm__selectWrap">
					<select name="ef__dob_year" required>
						<option value="" selected disabled>----</option>

						<?php
						$year_max = Carbon::today()->year - 16;
						$year = $year_max;
						while (1972 < $year) {
							--$year;
							$selected = ($year === (int)s_POST('ef__dob_year')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($year) ?>" <?= esc_attr($selected) ?>><?= esc_html($year) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="entryForm__inputUnit">年</span>
			</div>

			<div class="entryForm__inputUnitWrap">
				<div class="entryForm__selectWrap">
					<select name="ef__dob_month" required>
						<option value="" selected disabled>----</option>

						<?php
						$month = 0;
						while ($month < 12) {
							++$month;
							$selected = ($month === (int)s_POST('ef__dob_month')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($month) ?>" <?= esc_attr($selected) ?>><?= esc_html($month) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="entryForm__inputUnit">月</span>
			</div>

			<div class="entryForm__inputUnitWrap">
				<div class="entryForm__selectWrap">
					<select name="ef__dob_date" required>
						<option value="" selected disabled>----</option>

						<?php
						$date = 0;
						while ($date < 31) {
							++$date;
							$selected = ($date === (int)s_POST('ef__dob_date')) ? 'selected' : '';
						?>
							<option value="<?= esc_attr($date) ?>" <?= esc_attr($selected) ?>><?= esc_html($date) ?></option>
						<?php } ?>
					</select>
				</div>

				<span class="entryForm__inputUnit">日</span>
			</div>


		<?php } ?>
	<?php }


	//--------------------------------------------------
	// 電話番号
	//--------------------------------------------------
	private function ef__input_tel() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__tel')) ?>
			</p>

			<input type="hidden" name="ef__tel" value="<?= esc_attr(s_POST('ef__tel')) ?>">

		<?php } else { ?>
			<input type="tel" class="-reset" name="ef__tel" value="<?= esc_attr(s_POST('ef__tel')) ?>" placeholder="例）090000000（半角数字）">
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// メールアドレス *必須
	//--------------------------------------------------
	private function ef__input_email() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__email')) ?>
			</p>

			<input type="hidden" name="ef__email" value="<?= esc_attr(s_POST('ef__email')) ?>">

		<?php } else { ?>
			<input type="email" class="-reset" name="ef__email" value="<?= esc_attr(s_POST('ef__email')) ?>" placeholder="例）abcd@houyukai.jp（半角英数字）" required>
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// コメント
	//--------------------------------------------------
	private function ef__input_commnet() { ?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_html(s_POST('ef__comment')) ?>
			</p>

			<input type="hidden" name="ef__comment" value="<?= esc_attr(s_POST('ef__comment')) ?>">

		<?php } else { ?>

			<textarea name="ef__comment" cols="30" rows="10"><?= esc_attr(s_POST('ef__comment')) ?></textarea>
		<?php } ?>
	<?php }


	//--------------------------------------------------
	// サイト訪問きっかけ
	//--------------------------------------------------
	private function ef__input_opportunities() {
		global $ef__opportunities_keys; ?>
		<?php if (current_form_action('confirm')) { ?>

			<?php
			$ef__opportunities = s_POST('ef__opportunities');

			foreach ($ef__opportunities as $key => $array) {
				if (count($array) >= 2) {
					$output = $array[0] . '（' . $array[1] . '）';
				} else {
					$output = $array[0];
				}
			?>
				<p class="entryForm__output">
					<?= esc_html($output) ?>
				</p>

				<input type="hidden" name="ef__opportunities[<?= esc_attr($key) ?>][]" value="<?= esc_attr($output) ?>">

			<?php } ?>

		<?php } else { ?>

			<div class="entryForm__checkboxesWrap">

				<?php
				foreach ($ef__opportunities_keys as $oppotunity_key => $oppotunity_name) {
					$oppotunity_key_detail = $oppotunity_key . '_detail';
					if (strpos($oppotunity_key, 'detail') !== false) {
						continue;
					}

					if (array_key_exists($oppotunity_key_detail, $ef__opportunities_keys)) {
						$detail = '-detail';
					} else {
						$detail = '';
					}

					if (
						isset(s_POST('ef__opportunities')[$oppotunity_key]) &&
						s_POST('ef__opportunities')[$oppotunity_key][0]
					) {
						$checked = 'checked';
						$detail_value = get_string_inbetween(s_POST('ef__opportunities')[$oppotunity_key][0], '（', '）');
					} else {
						$checked = '';
						$detail_value = '';
					}


				?>
					<div class="entryForm__checkboxWrap <?= esc_attr($detail) ?>">
						<input type="checkbox" class="entryForm__checkbox" name="ef__opportunities[<?= esc_attr($oppotunity_key) ?>][]" value="<?= esc_attr($oppotunity_name) ?>" id="<?= esc_attr($oppotunity_key) ?>" required <?= esc_attr($checked) ?>>

						<label class="entryForm__checkboxLabel" for="<?= esc_attr($oppotunity_key) ?>"><?= esc_html($oppotunity_name) ?></label>

						<?php if (array_key_exists($oppotunity_key_detail, $ef__opportunities_keys)) { ?>

							<input type="text" name="ef__opportunities[<?= esc_attr($oppotunity_key) ?>][]" value="<?= esc_attr($detail_value) ?>">

						<?php } ?>
					</div>
				<?php } ?>
			</div>


		<?php } ?>
	<?php }

	//--------------------------------------------------
	// ファイル
	//--------------------------------------------------
	private function ef__input_file() {
	?>
		<?php if (current_form_action('confirm')) { ?>
			<p class="entryForm__output">
				<?= esc_attr(s_POST('ef__file_name')) ?></p>

			<input type="hidden" name="ef__file_name" value="<?= esc_attr(s_POST('ef__file_name')) ?>">

			<input type="hidden" name="ef__file_link" value="<?= esc_attr(s_POST('ef__file_link')) ?>">


		<?php } else { ?>
			<?php if (s_POST('ef__file_name')) { ?>
				<p class="entryForm__output">選択されたファイル :
					<?= esc_attr(s_POST('ef__file_name')) ?></p>

				<input type="hidden" name="ef__file_name" value="<?= esc_attr(s_POST('ef__file_name')) ?>">

				<input type="hidden" name="ef__file_link" value="<?= esc_attr(s_POST('ef__file_link')) ?>">

				<div>
					<p class="entryForm__inputLabel">ファイル形式 : pdf</p>
					<input type="file" id="ef__file_cv" class="-reset" name="ef__file_cv" accept=".pdf">
				</div>

				<script>
					$('#ef__file_cv').change(function() {
						$(this).prev().prevAll().remove();
					})
				</script>

			<?php } else { ?>
				<p class="entryForm__inputLabel">ファイル形式 : pdf</p>
				<input type="file" class="-reset" required name="ef__file_cv" accept=".pdf">
			<?php } ?>
		<?php } ?>
	<?php }


	//--------------------------------------------------
	//
	//--------------------------------------------------
	private function input_wrap($ef__input_content) { ?>
		<div class="entryForm__inputWrap <?= esc_attr($this->class) ?>">
			<?php $ef__input_content(); ?>
		</div>
<?php }


	//--------------------------------------------------
	//
	//--------------------------------------------------
	public function ef__input() {
		$this->input_wrap([$this, $this->input_template]);
	}
}

/**
 * EntryFormRowInputをベースにentryFormRow（）のcallbackとなる配列を出力する関数
 *
 * @param $text　テキスト
 * @param $class　該当のクラス
 */
function ef__input($input_template, $class) {
	$Entry_FormRowInput = new Form_Row_Input($input_template, $class);
	return [$Entry_FormRowInput, 'ef__input'];
}
