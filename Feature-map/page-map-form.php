<?php

require_once(dirname(__FILE__) . "/c-map-form-execution.php");

/**
 * Template Name: マップフォーム
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-map/Assets/Css/style.css">

<?php require_once(dirname(__FILE__) . "/c-map-header.php") ?>

<main class="pageMap -moving-bgc" id="pageMap">
	<?php ui_frame(function () { ?>
		<?php ui_head('Map') ?>

		<div class="pageMapBody">
			<div class="inner -tight -no-padding">
				<?php
				if (empty($_GET)) {
					//= 初期画面(csvを挿入する画面) ====
					require_once(dirname(__FILE__) . "/c-csv-form.php");
				}
				else {
					//= 変数定義 ====
					$params = vanilla_sanitize_array($_GET);
					$status = $params['status'];

					if ($status === 'address-selection') {
						//= 住所と使うデータのインデックスを決めるフォーム ====
						require_once(dirname(__FILE__) . "/c-address-selection-form.php");
					} elseif ($status === 'pin-data-selection') {
						//= 住所と使うデータのインデックスを決めるフォーム ====
						require_once(dirname(__FILE__) . "/c-pin-data-selection-form.php");

					}

					unset($params['status']);
					$csv_json = json_encode($params);
				}

				?>

			</div>
		</div>
	<?php }) ?>


	<?php get_footer(); ?>
