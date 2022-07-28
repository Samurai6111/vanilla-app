<?php
$email_signature =
	"----------------------------------------------------------------\n"
	. "署名が入ります\n"
	. "----------------------------------------------------------------\n";

$client_email = 'example@gmail.com';
$domain_email =  'info@' . $_SERVER['HTTP_HOST'];

$form_submission_key_array = [
	'company_name' => [
		'name' => 'イベント名',
	],
	'full_name' => [
		'name' => 'お名前',
	],
	'email' => [
		'name' => 'メールアドレス',
	],
	'tel' => [
		'name' => 'お電話番号',
	],
	'address' => [
		'name' => 'ご住所',
	],
	'notes' => [
		'name' => 'お問い合わせ内容',
	],
];


/**
 * $_GETの「form-action」が「confirm」になっているかの条件分岐
 * エントリーフォームページで使用
 */
function current_form_action($action) {
	$s_GET = vanilla_sanitize_array($_GET);
	if (isset($s_GET['form-action'])) {
		if ($s_GET['form-action'] === $action) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * フォームの送信先
 */
function form_action_url($action = '') {
	$form_action_url =
		get_the_permalink();

	if ($action) {
		$form_action_url .=
			'?form-action='
			. $action;
	}
	$form_action_url .= '#form';

	return $form_action_url;
}


/**
 * nonceのinputを出力する関数
 *
 * @param $key 任意の文字列
 */
function vanilla_wp_nonce_field($key) {
	return wp_nonce_field($key . '_action', $key . '_field');
}

/**
 * noceのverficationの関数
 *
 * @param $key 任意の文字列
 */
function vanilla_is_nonce_verified($key) {
	$nonce = isset($_POST[$key . '_field']) ? $_POST[$key . '_field'] : null;
	$is_verified = $nonce && wp_verify_nonce($nonce, $key . '_action');

	if ($is_verified) {
		return true;
	} else {
		return false;
	}
}

/**
 * フォームアクションの分岐
 *
 * @param $key
 */
function vanilla_is_current_form_action($key) {
	if (s_GET('form-action') === $key) {
		return true;
	} else {
		return false;
	}
}

/**
 * 配列のキーを指定して値がなかったらからの文字列を返す
 *
 * @param $
 */
function vanilla_array($array, $key) {
	if (isset($array[$key])) {
		return $array[$key];
	} else {
		return '';
	}
}

/**
* バリデーションがOKだった時に送信するフォーム
*
* @param $s_POST
* @param $validations
*/
function vanilla_the_hidden_form($s_POST, $validations) {
?>
	<form id="vanillaHiddenForm" method="POST" name="vanillaHiddenForm" action="<?php echo esc_url(form_action_url('confirm')); ?>">
		<?php if (is_array($s_POST) && !empty($s_POST)) {
			foreach ($s_POST as $key => $value) {
		?>
				<input type="hidden" name="<?= esc_attr($key) ?>" value="<?= esc_attr($value) ?>">
		<?php
			}
		} ?>
	</form>
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
			$('#vanillaHiddenForm').submit()
		</script>
<?php
	}
}
