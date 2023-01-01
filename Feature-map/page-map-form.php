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

		<div class="pageMapform">
			<div class="inner -tight -no-padding">
				<div class="mapFormContainer">

					<h2 class="mapFormContainer__title">マップフォーム</h2>
					<?php
					$params = vanilla_sanitize_array($_GET);
					$status = @$params['status'];
					//= 初期画面(csvを挿入する画面) ====
					if (empty($params)) {
						require_once(dirname(__FILE__) . "/c-csv-form.php");
					}
					//= 住所と使うデータのインデックスを決めるフォーム ====
					elseif ($status === 'address-selection') {
						require_once(dirname(__FILE__) . "/c-address-selection-form.php");
					}
					//= 住所と使うデータのインデックスを決めるフォーム ====
					elseif ($status === 'pin-data-selection') {
						require_once(dirname(__FILE__) . "/c-pin-data-selection-form.php");
					}

					?>

				</div>

			</div>
		</div>
	<?php }) ?>


	<?php get_footer(); ?>
