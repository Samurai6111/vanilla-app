<?php

class Vanilla_Form_Row_Input_Contents {

	//--------------------------------------------------
	// 会社名
	//--------------------------------------------------
	function company_name() {
?>
		<div class="vanillaForm__inputs">
			<?php Vanilla_Form_Row_Input::text(
				[
					'name' => 'company_name',
				],
				'-class'
			); ?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('例）○○○○株式会社') ?>
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
					],
				);

				Vanilla_Form_Row_Input::caption('例）山田');
				?>
			</div>

			<div class="vanillaForm__input">
				<?php
				Vanilla_Form_Row_Input::text(
					[
						'name' => 'first_name',
					],
				);

				Vanilla_Form_Row_Input::caption('例）太郎');
				?>
			</div>
		</div>
	<?php
	}

	//--------------------------------------------------
	// メールアドレス
	//--------------------------------------------------
	function email() {
	?>
		<div class="vanillaForm__inputs">

			<?php
			Vanilla_Form_Row_Input::email(
				[
					'name' => 'email',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('例）xxxx@hutec.jp'); ?>
	<?php
	}

	//--------------------------------------------------
	// メールアドレス 確認
	//--------------------------------------------------
	function email_confirm() {
	?>
		<div class="vanillaForm__inputs">

			<?php
			Vanilla_Form_Row_Input::email(
				[
					'name' => 'email_confirm',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('例）xxxx@hutec.jp'); ?>
	<?php
	}

	//--------------------------------------------------
	// お電話番号
	//--------------------------------------------------
	function tel() {
	?>
		<div class="vanillaForm__inputs">
			<?php
			Vanilla_Form_Row_Input::text(
				[
					'name' => 'tel',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('例）00-0000-0000　※半角で入力してください'); ?>
	<?php
	}

	//--------------------------------------------------
	// ご住所
	//--------------------------------------------------
	function address() {
	?>
		<div class="vanillaForm__inputs">
			<?php
			Vanilla_Form_Row_Input::text(
				[
					'name' => 'address',
				],
			);
			?>
		</div>
		<?php Vanilla_Form_Row_Input::caption('例）東京都○○○○○○○○○○○○○○1-1-1○○○○ビル101号室'); ?>
	<?php
	}

	//--------------------------------------------------
	// お問い合わせ内容
	//--------------------------------------------------
	function notes() {
		?>
			<div class="vanillaForm__inputs">
				<?php
				Vanilla_Form_Row_Input::textarea(
					[
						'name' => 'notes',
					]
				)
				?>
			</div>
		<?php
		}

	//--------------------------------------------------
	// プライバシーポリシー 同意
	//--------------------------------------------------
	static function privacy_policy_confirm() {
	?>
		<div class="vanillaForm__inputs">
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
