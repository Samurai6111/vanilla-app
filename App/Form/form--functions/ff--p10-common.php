<?php
$email_signature =
	"----------------------------------------------------------------\n"
	. "署名が入ります\n"
	. "----------------------------------------------------------------\n";

$client_email = 's.kawakatsu@roseaupensant.jp';
$domain_email =  'info@' . $_SERVER['HTTP_HOST'];

$ef__input_key_array = [
	'ef__event_name' => 'イベント名',
	'ef__event_date' => '日時',
	'ef__last_name' => '氏名（姓）',
	'ef__first_name' => '氏名（名）',
	'ef__full_name' => '氏名',
	'ef__last_name_kana' => 'フリガナ（姓）',
	'ef__first_name_kana' => 'フリガナ（名）',
	'ef__full_name_kana' => 'フリガナ',
	'ef__school_name' => '学校名',
	'ef__school_of' => '学部',
	'ef__department' => '学科',
	'ef__full_department' => '学部・学科',
	'ef__graduation_year' => '卒業年',
	'ef__graduation_month' => '卒業月',
	'ef__graduation_ym' => '卒業年月日',
	'ef__post_number' => '郵便番号',
	'ef__prefecture' => '都道府県',
	'ef__town' => '市区町村・建物名',
	'ef__full_address' => '住所',
	'ef__dob_year' => '生年月日（年）',
	'ef__dob_month' => '生年月日（月）',
	'ef__dob_date' => '生年月日（日）',
	'ef__dob' => '生年月日',
	'ef__tel' => '電話番号',
	'ef__email' => 'メールアドレス',
	'ef__comment' => 'コメント',
	'ef__opportunities' => 'サイト訪問のきっかけ',
	'ef__file_cv' => '履歴書',
];

$ef__mail_key_array = [
	'ef__event_name' => [
		'name' => 'イベント名',
	],
	'ef__event_date' => [
		'name' => '日時',
	],
	'ef__full_name' => [
		'name' => '氏名',
	],
	'ef__full_name_kana' => [
		'name' => 'フリガナ',
	],
	'ef__school_name' => [
		'name' => '学校名',
	],
	'ef__full_department' => [
		'name' => '学部・学科',
	],
	'ef__graduation_ym' => [
		'name' => '卒業年月日',
	],
	'ef__post_number' => [
		'name' => '郵便番号',
	],
	'ef__full_address' => [
		'name' => '住所',
	],
	'ef__dob' => [
		'name' => '生年月日',
	],
	'ef__tel' => [
		'name' => '電話番号',
	],
	'ef__email' => [
		'name' => 'メールアドレス',
	],
	'ef__comment' => [
		'name' => 'コメント',
	],
	'ef__opportunities' => [
		'name' => 'サイト訪問のきっかけ',
	],
];

$ef__opportunities_keys = [
	"ef__opportunity_mynavi" => "マイナビサイト",
	"ef__opportunity_rikunavi" => "リクナビサイト",
	"ef__opportunity_fukushigoto" => "フクシゴトサイト",
	"ef__opportunity_hp" => "ホームページ",
	"ef__opportunity_seminar" => "合同説明会",
	"ef__opportunity_seminar_detail" => "合同説明会のテキスト",
	"ef__opportunity_schoolRecreuitment" => "学校の求人",
	"ef__opportunity_fukuross" => "FUKUROSS",
	"ef__opportunity_hw" => "ハローワーク(学生センター)",
	"ef__opportunity_indeed" => "indeed",
	"ef__opportunity_jobPost" => "求人票",
	"ef__opportunity_introduce" => "紹介",
	"ef__opportunity_introduce_detail" => "紹介の詳細",
	"ef__opportunity_other" => "その他",
	"ef__opportunity_other_detail" => "その他の詳細",
];

$ef__branch_variable_array = [
	'recruitment' => [
		'jaTitle' => 'エントリーフォーム',
		'email_subject' => 'エントリーフォームのお申し込みを承りました',
	],
	'event' => [
		'jaTitle' => 'イベント参加のお申込み',
		'email_subject' => 'イベント参加のお申し込みを承りました',
	],
	'intern' => [
		'jaTitle' => 'インターンシップのお申込み',
		'email_subject' => 'インターンシップのお申し込みを承りました',
	],
];

$prefectures = [
	'1' => '北海道',
	'2' => '青森県',
	'3' => '岩手県',
	'4' => '宮城県',
	'5' => '秋田県',
	'6' => '山形県',
	'7' => '福島県',
	'8' => '茨城県',
	'9' => '栃木県',
	'10' => '群馬県',
	'11' => '埼玉県',
	'12' => '千葉県',
	'13' => '東京都',
	'14' => '神奈川県',
	'15' => '新潟県',
	'16' => '富山県',
	'17' => '石川県',
	'18' => '福井県',
	'19' => '山梨県',
	'20' => '長野県',
	'21' => '岐阜県',
	'22' => '静岡県',
	'23' => '愛知県',
	'24' => '三重県',
	'25' => '滋賀県',
	'26' => '京都府',
	'27' => '大阪府',
	'28' => '兵庫県',
	'29' => '奈良県',
	'30' => '和歌山県',
	'31' => '鳥取県',
	'32' => '島根県',
	'33' => '岡山県',
	'34' => '広島県',
	'35' => '山口県',
	'36' => '徳島県',
	'37' => '香川県',
	'38' => '愛媛県',
	'39' => '高知県',
	'40' => '福岡県',
	'41' => '佐賀県',
	'42' => '長崎県',
	'43' => '熊本県',
	'44' => '大分県',
	'45' => '宮崎県',
	'46' => '鹿児島県',
	'47' => '沖縄県'
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
 * 配列のキーが存在していればその値を出力、
 * しなければfalseを返す関数
 *
 * @param $key キー
 * @param $array 配列
 */
function has_array_key($key, $array) {
	if (array_key_exists($key, $array)) {
		return $array[$key];
	} else {
		false;
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
	$form_action_url .= '#entryForm';

	return $form_action_url;
}

function form_template_row_item(callable $label, callable $input) {
?>
	<li class="entryForm__item">
		<?= $label() ?>
		<?= $input() ?>
	</li>
<?php
}
