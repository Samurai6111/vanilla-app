<?php
$email_signature =
	"----------------------------------------------------------------\n"
	. "署名が入ります\n"
	. "----------------------------------------------------------------\n";

$client_email = 's.kawakatsu@roseaupensant.jp';
$domain_email =  'info@' . $_SERVER['HTTP_HOST'];

$user_occumations = [
"disabled" => "クリエイティブ職",
"value" => "企画営業/プロデューサー",
"value" => "ディレクター",
"value" => "プランナー",
"value" => "クリエイティブディレクター/アートディレクター",
"value" => "デザイナー",
"value" => "UI/UXデザイナー",
"value" => "イラストレーター",
"value" => "ライター/コピーライター",
"value" => "フロントエンジニア",
"value" => "バックエンドエンジニア",
"value" => "その他",
"disabled" => "その他職種",
"value" => "営業",
"value" => "マーケティング/企画/PR",
"value" => "経営企画/管理/人事/採用/広報",
"value" => "販売/サービス職",
"value" => "医療系",
"value" => "専門職（金融/不動産/コンサルティング/監査法人 等）",
"value" => "技術職（機械/電気/建設/建築/食品/化学/素材/化粧品 等）",
"value" => "公務員/教員/農林水産関連職",
"value" => "その他",
"disabled" => "学生",
"value" => "小学生/中学生/高校生",
"value" => "専門学校生",
"value" => "大学生（クリエイティブ系）",
"value" => "大学生（その他学部）",
"value" => "大学院生（クリエイティブ系）",
"value" => "大学院生（その他学部）",
"value" => "その他",
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
		home_url('/entry/')
		. '?type='
		. s_GET('type');

	if ($action) {
		$form_action_url .=
			'&form-action='
			. $action;
	}
	$form_action_url .= '#form';

	return $form_action_url;
}

function vanilla_form_template_row_item(callable $label, callable $input, $class = '') {
?>
	<li class="form__item <?= esc_attr($class) ?>">
		<?= $label() ?>
		<?= $input() ?>
	</li>
<?php
}


/**
* フォームの送信処理を実行するかどうか関数
*/
function is_ready_to_excute() {
	//--------------------------------------------------
	// フォームが送信された時
	//--------------------------------------------------
	if ('POST' === $_SERVER['REQUEST_METHOD']){
		$nonce = isset($_POST['user_register_form_nonce_field']) ? $_POST['user_register_form_nonce_field'] : null;
		$is_verified = $nonce && wp_verify_nonce($nonce, 'user_register_form_nonce_action');

		//--------------------------------------------------
		// nonceを通過した時
		//--------------------------------------------------
		if ($is_verified) {
			return true;
		} else {
			return false;
		}
	}
	//--------------------------------------------------
	// フォームを送信しないで確認ページに遷移してきた時
	//--------------------------------------------------
	elseif (
		'POST' !== $_SERVER['REQUEST_METHOD'] &&
		s_GET('form-action') === 'confirm'
		) {
		return false;
	}
	//--------------------------------------------------
	// それ以外
	//--------------------------------------------------
	else {

		return true;
	}
}
