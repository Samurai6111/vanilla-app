<?php

class Vanilla_Form_Row_Input_Contents {

	//--------------------------------------------------
	// ユーザーログイン
	//--------------------------------------------------
	function user_login() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php Vanilla_Form_Row_Input::text(
					[
						'name' => 'user_login',
					],
					'-user-login'
				); ?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// ユーザーパスワード
	//--------------------------------------------------
	function user_password() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php Vanilla_Form_Row_Input::password(
					[
						'name' => 'user_password',
					],
					'-user-password'
				); ?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// 会社名
	//--------------------------------------------------
	function company_name() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'company_name',
						'placeholder' => '株式会社○○○○、○○○○協会',
					]
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// お名前
	//--------------------------------------------------
	function name() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'family_name',
						'placeholder' => '山田',
					]
				);
				?>
			</div>

			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'first_name',
						'placeholder' => '太郎',
					]
				)
				?>
			</div>
		</div>

		<?php if (vanilla_is_current_form_action('confirm')) {
			$family_name = s_POST('family_name');
			$first_name = s_POST('first_name');
			$full_name = $family_name . $first_name;
		?>
			<input type="hidden" name="full_name" value="<?php echo esc_attr($full_name) ?>">
		<?php } ?>
	<?php
	}

	//--------------------------------------------------
	// お名前（カナ）
	//--------------------------------------------------
	function name_kana() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'family_name_kana',
						'placeholder' => 'ヤマダ',
					]
				);
				?>
			</div>

			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'first_name_kana',
						'placeholder' => 'タロウ',
					]
				)
				?>
			</div>
		</div>

		<?php if (vanilla_is_current_form_action('confirm')) {
			$family_name_kana = s_POST('family_name_kana');
			$first_name_kana = s_POST('first_name_kana');
			$full_name_kana = $family_name_kana . $first_name_kana;
		?>
			<input type="hidden" name="full_name_kana" value="<?php echo esc_attr($full_name_kana) ?>">
		<?php } ?>
	<?php
	}

	//--------------------------------------------------
	// メールアドレス
	//--------------------------------------------------
	function email() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::email(
					[
						'name' => 'email',
						'placeholder' => 'info-hkjcca@docon.jp',
					],
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// メールアドレス 確認
	//--------------------------------------------------
	function email_confirm() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::email(
					[
						'name' => 'email_confirm',
						'placeholder' => 'info-hkjcca@docon.jp',
					],
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// お電話番号
	//--------------------------------------------------
	function tel() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'tel',
						'placeholder' => '011-801-1596',
					],
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// ご住所
	//--------------------------------------------------
	function address() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'address',
					],
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// お問い合わせ内容
	//--------------------------------------------------
	function notes() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::textarea(
					[
						'name' => 'notes',
						'placeholder' => 'お問合せ内容をご記載ください。',
					]
				)
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// プライバシーポリシー 同意
	//--------------------------------------------------
	static function privacy_policy_confirm() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::radio(
					[
						'name' => 'privacy_policy_confirm',
						'value' => 'confirmed',
						'text' => '上記内容に同意する',
						'id' => 'privacy_policy_confirm',
					],
				);
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// ラジオボタン
	//--------------------------------------------------
	function radio() {
	?>
		<div class="vanillaForm__inputs">
			<?php
			Vanilla_Form_Row_Input::radio(
				[
					'name' => 'radio',
					'value' => 'test3',
					'text' => '選択肢1',
					'id' => 'radio1',
				],
			);
			Vanilla_Form_Row_Input::radio(
				[
					'name' => 'radio',
					'value' => 'test6',
					'text' => '選択肢2',
					'id' => 'radio2',
				],
			);
			Vanilla_Form_Row_Input::radio(
				[
					'name' => 'radio',
					'value' => 'test6',
					'text' => '選択肢3',
					'id' => 'radio3',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('ラジオボタンのキャプション') ?>
	<?php
	}

	//--------------------------------------------------
	// チェックボックス
	//--------------------------------------------------
	function checkbox() {
	?>
		<div class="vanillaForm__inputs">
			<?php
			Vanilla_Form_Row_Input::checkbox(
				[
					'name' => 'checkbox',
					'value' => 'test3',
					'text' => '選択肢1',
					'id' => 'checkbox1',
				],
			);
			Vanilla_Form_Row_Input::checkbox(
				[
					'name' => 'checkbox',
					'value' => 'test4',
					'text' => '選択肢2',
					'id' => 'checkbox2',
				],
			);
			Vanilla_Form_Row_Input::checkbox(
				[
					'name' => 'checkbox',
					'value' => 'test5',
					'text' => '選択肢3',
					'id' => 'checkbox3',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('チェックボックスのキャプション') ?>
	<?php
	}

	//--------------------------------------------------
	// セレクトボックス
	//--------------------------------------------------
	function selectbox() {
	?>
		<div class="vanillaForm__inputs">
			<?php
			Vanilla_Form_Row_Input::selectbox(
				[
					'name' => 'selectbox',
					'values' => [
						'key1' => 'value1',
						'key2' => 'value2',
						'key3' => 'value3',
						'key4' => 'value4',
						'key5' => 'value5',
						'key6' => 'value6',
					],
				]
			)
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('セレクトボックスのキャプション') ?>
	<?php
	}

	//--------------------------------------------------
	// 生年月日
	//--------------------------------------------------
	function date_of_birth() {
	?>
		<div class="vanillaForm__inputs">
			<div class="vanillaForm__inputsWithUnit">
				<?php
				Vanilla_Form_Row_Input::selectbox(
					[
						'name' => 'dob_year',
						'values' => [
							'1991' => '1991',
							'1992' => '1992',
							'1993' => '1993',
							'1994' => '1994',
							'1995' => '1995',
							'1996' => '1996',
						],
					]
				)
				?>
				<span class="vanillaForm__inputsUnit">
					年
				</span>
			</div>

			<div class="vanillaForm__inputsWithUnit">
				<?php
				Vanilla_Form_Row_Input::selectbox(
					[
						'name' => 'dob_month',
						'values' => [
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6',
						],
					]
				)
				?>
				<span class="vanillaForm__inputsUnit">
					月
				</span>
			</div>

			<div class="vanillaForm__inputsWithUnit">
				<?php
				Vanilla_Form_Row_Input::selectbox(
					[
						'name' => 'dob_date',
						'values' => [
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6',
						],
					]
				)
				?>
				<span class="vanillaForm__inputsUnit">
					日
				</span>
			</div>
		</div>
		<?php Vanilla_Form_Row_Input::caption('セレクトボックスのキャプション') ?>
<?php
	}
}
