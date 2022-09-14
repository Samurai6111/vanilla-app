<?php

use Carbon\Carbon;

class Vanilla_Form_Row_Input {
	function __construct(callable $input_template, $class = '') {
		$this->input_template = $input_template;
		$this->class = $class;
		$this->event_id = (s_GET('event-id')) ? s_GET('event-id') : '';
		$user_id = get_current_user_id();
		$this->Vanilla_User = new Vanilla_User($user_id);
	}


	/**
	 * テキスト,メール、telなどのベーシックなinputタグ
	 *
	 * @param string $type inputのタイプ text, email, numberのいずれか
	 * @param array $args inputのargument
	 */
	function basic_input($type, $args = []) {
		//--------------------------------------------------
		// 初期値
		//--------------------------------------------------
		$args_init = [
			'name' => '',
			'placeholder' => '',
			'value' => '',
			'attr' => '',
		];
		//--------------------------------------------------
		// 変数の変更
		//--------------------------------------------------
		foreach ($args_init as $key => $value) {
			$args_value = (!isset($args[$key])) ? $value : $args[$key];
			$args[$key] = $args_value;
		}

		$name = $args['name'];
		$value = isset($_POST[$name]) ? sanitize_text_field($_POST[$name]) : $args['value'];
?>
		<input type="<?php echo esc_attr($type) ?>" placeholder="<?php echo esc_attr($args['placeholder']) ?>" name="<?php echo esc_attr($args['name']) ?>" value="<?php echo esc_attr($value) ?>" <?php echo esc_attr($args['attr']) ?>>

		<?php
		//--------------------------------------------------
		// エラーを表示
		//--------------------------------------------------
		Vanilla_Form_Validation::echo_validation_result($name);

		?>

		<?php
		//--------------------------------------------------
		// 確認画面
		//--------------------------------------------------
		if (vanilla_is_current_form_action('confirm')) { ?>
			<div class="vanillaForm__output">
				<?php echo esc_html($value) ?>
			</div>
		<?php } ?>
	<?php
	}


	/**
	 * テキストのinput
	 *
	 * @param array $args inputのargument
	 */
	static function text($args = []) {
		return self::basic_input('text', $args);
	}


	/**
	 * メールのinput
	 *
	 * @param array $args inputのargument
	 */
	static function email($args = []) {
		return self::basic_input('email', $args);
	}


	/**
	 * 数字のinput
	 *
	 * @param array $args inputのargument
	 */
	static function number($args = []) {
		return self::basic_input('number', $args);
	}



	/**
	 * ラジオボタンとチェックボックスなどのinputタグ
	 *
	 * @param string $type inputのタイプ radio, checkboxのいずれか
	 * @param array $args inputのargument
	 */
	function radio_and_checkbox($type = 'radio', $args = []) {
		//--------------------------------------------------
		// 初期値
		//--------------------------------------------------
		$args_init = [
			'name' => '',
			'placeholder' => '',
			'value' => '',
			'text' => '',
			'id' => '',
			'attr' => '',
		];
		//--------------------------------------------------
		// 変数の変更
		//--------------------------------------------------
		foreach ($args_init as $key => $value) {
			$args_value = (!isset($args[$key])) ? $value : $args[$key];
			$args[$key] = $args_value;
		}
		$name = $args['name'];

		if ($type === 'radio') {

			$checked = isset($_POST[$name]) ? 'checked' : '';
		} elseif ($type === 'checkbox') {

			if (
				'POST' === $_SERVER['REQUEST_METHOD'] &&
				in_array($args['value'], $_POST[$name])
			) {
				$checked = 'checked';
			} else {
				$checked = '';
			}
			$name = $name . '[]';
		}

		$value = $args['value'];
	?>

		<input id="<?php echo esc_attr($args['id']) ?>" <?php echo esc_attr($args['attr']) ?> type="<?php echo esc_attr($type) ?>" placeholder="<?php echo esc_attr($args['placeholder']) ?>" name="<?php echo esc_attr($name) ?>" value="<?php echo esc_attr($value) ?>" <?php echo esc_attr($checked) ?>>


		<label for="<?php echo esc_attr($args['id']) ?>" class="vanillaForm__inputLabel">
			<?php echo wp_kses_post($args['text']) ?>
		</label>


		<?php
		//--------------------------------------------------
		// 確認画面
		//--------------------------------------------------
		if (vanilla_is_current_form_action('confirm')) { ?>
			<div class="vanillaForm__output">
				<?php echo esc_html($value) ?>
			</div>
		<?php } ?>
	<?php
	}


	/**
	 * ラジオボタンのinput
	 *
	 * @param array $args inputのargument
	 */
	static function radio($args = []) {
		return self::radio_and_checkbox('radio', $args);
	}


	/**
	 * チェックボックスのinput
	 *
	 * @param array $args inputのargument
	 */
	static function checkbox($args = []) {
		return self::radio_and_checkbox('checkbox', $args);
	}


	/**
	 * テキストエリア
	 *
	 * @param array $args inputのargument
	 */
	static function textarea($args = []) {
		//--------------------------------------------------
		// 初期値
		//--------------------------------------------------
		$args_init = [
			'name' => '',
			'value' => '',
		];
		//--------------------------------------------------
		// 変数の変更
		//--------------------------------------------------
		foreach ($args_init as $key => $value) {
			$args_value = (!isset($args[$key])) ? $value : $args[$key];
			$args[$key] = $args_value;
		}

		$name = $args['name'];
		$value = isset($_POST[$name]) ? sanitize_text_field($_POST[$name]) : $args['value'];
	?>

		<textarea name="<?php echo esc_attr($args['name']) ?>" cols="30" rows="10"><?php echo esc_html($value) ?></textarea>

		<?php
		//--------------------------------------------------
		// 確認画面
		//--------------------------------------------------
		if (vanilla_is_current_form_action('confirm')) { ?>
			<div class="vanillaForm__output">
				<?php echo esc_html($value) ?>
			</div>
		<?php } ?>
	<?php
	}


	/**
	 * セレクトボックス
	 *
	 * @param array $args inputのargument
	 */
	static function selectbox($args = []) {
		//--------------------------------------------------
		// 配列の例
		//--------------------------------------------------
		$example = [
			'name' => '',
			'values' => [
				'value' => 'text',
			],
		];


		$name = $args['name'];
		$values = $args['values'];
	?>
		<select name="<?php echo esc_attr($name) ?>">
			<?php
			foreach ($values as $value => $text) {
				$selected = (s_post($name) == $value) ? 'selected' : '';
			?>
				<option value="<?php echo esc_attr($value) ?>" <?php echo esc_attr($selected) ?>>
					<?php echo esc_html($text) ?>
				</option>

			<?php } ?>
		</select>

		<?php
		//--------------------------------------------------
		// 確認画面
		//--------------------------------------------------
		if (vanilla_is_current_form_action('confirm')) { ?>
			<div class="vanillaForm__output">
				<?php echo esc_html(s_post($name)) ?>
			</div>
		<?php } ?>
	<?php
	}

	/**
	 * inputの下のキャプション
	 *
	 * @param $text
	 */
	static function caption($text) {
	?>
		<?php if (!vanilla_is_current_form_action('confirm')) { ?>
			<span class="vanillaForm__inputCaption">
				<?php echo wp_kses_post($text) ?>
			</span>
		<?php } ?>
	<?php
	}
}


/**
 * formRowInputをベースにformRow（）のcallbackとなる配列を出力する関数
 *
 * @param $input_template
 */
function vanilla_form_input($input) {
	return $input;
}

/**
 * formの確認ボタンや送信ボタンなどのボタン系を出力する関数
 */
function vanilla_form_buttons() {
	//--------------------------------------------------
	// 確認ページ
	//--------------------------------------------------
	if (current_form_action('confirm')) {

		button_type1([
			'text' => '修正する',
			'class' => '-bg-lightgray -color-black',
			'img' => 'none',
			'attr' => 'formaction="' . esc_url(form_action_url('input')) . '" type="submit"',
		]);

		button_type1([
			'text' => '送信する',
			'class' => '-bg-beige -color-black',
			'img' => 'none',
			'attr' => 'formaction="' . esc_url(form_action_url('send')) . '" type="submit"',
		]);
	}

	//--------------------------------------------------
	// 入力ページ
	//--------------------------------------------------
	else {

		button_type1([
			'text' => '内容を確認',
			'class' => '-bg-beige -color-black -large',
			'img' => 'none',
			'attr' => 'formaction="' . esc_url(form_action_url()) . '" type="submit"',
		]);

		button_type1([
			'text' => '内容をクリア',
			'class' => '-bg-lightgray  -color-black -clear-inputs',
			'img' => 'none',
			'attr' => 'onclick="clear_form_inputs(event)" type="button"',
		]);
	} ?>
<?php
}
