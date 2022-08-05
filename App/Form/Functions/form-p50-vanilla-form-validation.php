<?php

/**
* フォームのバリデーションのクラス
*/
class Vanilla_Form_Validation {

	/**
	* バリデーションの結果を出力
	*
	* @param array $validations バリデーションの配列
	*/
	static function echo_validation_results($validations) {

		if (
			'POST' === $_SERVER['REQUEST_METHOD'] &&
			$validations &&
			count($validations) > 0
		) { ?>
			<div class="vanillaFormValidation -login">
				<ul class="vanillaFormValidation__list">
					<li class="vanillaFormValidation__item -color-red">
						入力に誤りがあります。下記の項目をご確認ください。
					</li>

					<?php foreach ($validations as $validation_key => $validation_value) { ?>
						<li class="vanillaFormValidation__item -color-red">
							・<?= esc_html($validation_value) ?>
						</li>
					<?php } ?>
				</ul>
			</div>
<?php } else {
			return false;
		}
	}

	/**
	 * お問合せフォームのバリデーション
	 *
	 * @param array $key $_POSTのkeyの配列
	 * @return array バリデーションの配列
	 */
	function contact_form($array) {

		$validations_strings = [
			'family_name' => '名字',
			'first_name' => '名前',
			'email' => 'メールアドレス',
			'email_confirm' => 'メールアドレス（確認）',
			'tel' => 'お電話番号',
			'notes' => 'お問い合せ内容',
			'privacy_policy_confirm' => '上記内容に同意する',
		];

		$validations = [];

		$array_diff_key = array_diff_key($validations_strings, $array);
		$array_no_value = array_map(function($value) { return ''; }, $array_diff_key);
		$array_merged = array_merge($array, $array_no_value);

		foreach ($array_merged as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}

			if (
				$array['email'] !== $array['email_confirm']
			) {
				$validations['email_confirm'] = 'メールアドレスが一致していません。';
			}
		}

		return $validations;
	}
}
