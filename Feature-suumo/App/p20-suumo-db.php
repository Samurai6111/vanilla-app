<?php

/**
* suumo用のデータベーステーブルを作成
*/
function suumo_create_db_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumo';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	ID mediumint(9) NOT NULL AUTO_INCREMENT,
	UNIQUE KEY ID (ID)
) $charset_collate;";

	require(ABSPATH . 'wp-admin/includes/upgrade.php');
	$result = dbDelta($sql);
}
add_action('init', 'suumo_create_db_table');

?>


<?php

/**
* suumo用のデータベーステーブルにカラムを追加する
*/
function suumo_add_table_columns() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumo';
	$wpdb->query("ALTER TABLE {$table_name} ADD link varchar(255)");
	$wpdb->query("ALTER TABLE {$table_name} ADD rent bigint(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD management_fee bigint(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD deposit bigint(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD retainer_fee bigint(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD room_arragement varchar(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD initial_fee bigint(20) DEFAULT 0");
	$wpdb->query("ALTER TABLE {$table_name} ADD construction varchar(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD address varchar(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD longitude float(50)");
	$wpdb->query("ALTER TABLE {$table_name} ADD latitude float(50)");
}
add_action('init', 'suumo_add_table_columns');

/**
* suumo用のデータベーステーブルにカラムを削除する
*/
function suumo_drop_table_columns() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumo';
	$wpdb->query("ALTER TABLE {$table_name} DROP longitude ");
	$wpdb->query("ALTER TABLE {$table_name} DROP latitude ");
}
// add_action('init', 'suumo_drop_table_columns');

/**
* テストの値を入れる
*/
function suumo_insert_table_value() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumo';

	$wpdb->insert(
		$table_name,
		array(
			'ID' => 1,
			'link' => 'https://suumo.jp/chintai/jnc_000078576101/kankyo/?bc=100306429966',
			'rent' => '120000',
			'management_fee' => '5000',
			'deposit' => '120000',
			'retainer_fee' => '120000',
			'room_arragement' => '3LDK',
			'initial_fee' => '0',
			'construction' => '鉄骨',
			'address' => '東京都北区浮間５',
		),
		array(
			'%d',
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%s',
			'%d',
			'%s',
			'%s',
		)
	);
}
add_action('init', 'suumo_insert_table_value');
