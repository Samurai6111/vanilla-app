<?php

/**
 * suumo用のデータベーステーブルを作成
 */
function suumo_create_db_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumo';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	ID bigint(20) NOT NULL AUTO_INCREMENT,
	UNIQUE KEY ID (ID)
) $charset_collate;";

	return $sql;
}

/**
 * suumoのメタデータ用のデータベーステーブルを作成
 */
function suumo_create_db_meta_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumometa';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	meta_id bigint(20) NOT NULL AUTO_INCREMENT,
	UNIQUE KEY meta_id (meta_id)
) $charset_collate;";

	return $sql;
}


function execute_db_creation() {

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta(suumo_create_db_table());
	dbDelta(suumo_create_db_meta_table());
}

add_action('init', 'execute_db_creation');


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
// add_action('init', 'suumo_insert_table_value');



//========================
//メタテーブル
//========================

/**
 * suumoのメタデータ用のデータベーステーブルにカラムを追加する
 */
function suumo_add_meta_table_columns() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'suumometa';
	$wpdb->query("ALTER TABLE {$table_name} ADD suumo_id bigint(20)");
	$wpdb->query("ALTER TABLE {$table_name} ADD meta_key varchar(255) NULL");
	$wpdb->query("ALTER TABLE {$table_name} ADD meta_value varchar(255) NULL");
}
add_action('init', 'suumo_add_meta_table_columns');

function get_suumo_meta($suumo_id, $meta_key) {
	global $wpdb;
	$suumometa_table = $wpdb->prefix . 'suumometa';

	// $sql = "SELECT meta_value
	// FROM `{$suumometa_table}`
	// WHERE `suumo_id` = '{$suumo_id}' AND `meta_key` = '{$meta_key}'";
	$sql = "SELECT meta_value
	FROM `{$suumometa_table}`
	WHERE `suumo_id` = %d AND `meta_key` = %s";
	$query = $wpdb->prepare( $sql, $suumo_id, $meta_key );
	$meta_value = $wpdb->get_row($query);

	return $meta_value;
}

function update_suumo_meta($suumo_id, $meta_key, $meta_value) {
	global $wpdb;
	$suumometa_table = $wpdb->prefix . 'suumometa';

	$sql = "SELECT meta_id
	FROM `{$suumometa_table}`
	WHERE `suumo_id` = %d AND `meta_key` = %s";
	$query = $wpdb->prepare( $sql, $suumo_id, $meta_key );
	$meta_id = $wpdb->get_row($query)->meta_id;

	$wpdb->replace(
		$suumometa_table,
		[
			'meta_id' => $meta_id,
			'suumo_id' => $suumo_id,
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
		],
		[
			'%d',
			'%d',
			'%s',
			'%s',
		]
	);

	return $wpdb->insert_id;
}
