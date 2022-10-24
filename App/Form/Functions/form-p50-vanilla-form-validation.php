<?php

/**
 * フォームのバリデーションのクラス
 */
class Vanilla_Form_Validation {

	/**
	* カタカナかどうかを判定する 下記対応文字列
	* ------------------------------------
	* ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺヽヾヿㇰㇱㇲㇳㇴㇵㇶㇷㇸㇹㇺㇻㇼㇽㇾㇿ㋐㋑㋒㋓㋔㋕㋖㋗㋘㋙㋚㋛㋜㋝㋞㋟㋠㋡㋢㋣㋤㋥㋦㋧㋨㋩㋪㋫㋬㋭㋮㋯㋰㋱㋲㋳㋴㋵㋶㋷㋸㋹㋺㋻㋼㋽㋾㌀㌁㌂㌃㌄㌅㌆㌇㌈㌉㌊㌋㌌㌍㌎㌏㌐㌑㌒㌓㌔㌕㌖㌗㌘㌙㌚㌛㌜㌝㌞㌟㌠㌡㌢㌣㌤㌥㌦㌧㌨㌩㌪㌫㌬㌭㌮㌯㌰㌱㌲㌳㌴㌵㌶㌷㌸㌹㌺㌻㌼㌽㌾㌿㍀㍁㍂㍃㍄㍅㍆㍇㍈㍉㍊㍋㍌㍍㍎㍏㍐㍑㍒㍓㍔㍕㍖㍗ｦｧｨｩｪｫｬｭｮｯｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝ𛀀𛅤𛅥𛅦𛅧
	* ------------------------------------
	* @param $str 文字列
	* @return boolean
	*/
	function check_katakana(string $str) {
		return preg_match("/\A\p{Katakana}+\z/u", $str);
	}

	/**
	 * バリデーションに引っかかった時のクラスを出力する
	 */
	static function error_class() {
		global $validations;
		if ($validations && !empty($validations)) {
			$error_class = '-error';
		} else {
			$error_class = '';
		}

		return $error_class;
	}

	/**
	 * バリデーションの結果を単体で取得
	 *
	 * @param array $key バリデーションのキー
	 */
	static function get_validation_result($key) {
		global $validations;

		if (
			'POST' === $_SERVER['REQUEST_METHOD'] &&
			$validations &&
			count($validations) > 0
		) {
			return $validations[$key];
		 } else {
			return false;
		}
	}

	/**
	 * バリデーションの結果を単体で出力
	 *
	 * @param array $key バリデーションのキー
	 */
	static function echo_validation_result($key) {
		global $validations;

		$validation_result = self::get_validation_result($key);

		if ($validation_result) { ?>
			<div class="vanillaForm__inputError">
				<p class="vanillaForm__inputErrorText">
					<?php echo esc_html($validations[$key]) ?>
				</p>
			</div>
		<?php } else {
			return false;
		}
	}

	/**
	 * バリデーションの結果をまとめて出力
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
	 * ログインフォームのバリデーション
	 *
	 * @param array $key $_POSTのkeyの配列
	 * @return array バリデーションの配列
	 */
	function login_form($array) {

		$validations_strings = [
			'user_login' => 'ログインID',
			'user_password' => 'パスワード',
		];

		$validations = [];

		$array_diff_key = array_diff_key($validations_strings, $array);
		$array_no_value = array_map(function ($value) {
			return '';
		}, $array_diff_key);
		$array_merged = array_merge($array, $array_no_value);

		foreach ($array_merged as $key => $value) {
			if (
				!$value &&
				isset($validations_strings[$key])
			) {
				$validations[$key] = $validations_strings[$key] . 'を入力してください。';
			}
		}

		return $validations;
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
		$array_no_value = array_map(function ($value) {
			return '';
		}, $array_diff_key);
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
