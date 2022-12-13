<?php
require_once(get_theme_file_path() . "/Feature-suumo/suumo-form-execution.php");

/**
 * Template Name: suumo
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

<?php

?>





<main class="pageSuumo -moving-bgc" id="pageSuumo">
	<?php suumo_frame(function () { ?>
		<?php suumo_head('Property Info Generator') ?>

		<div class="pageSuumoBody">
			<div class="inner -tight -no-padding">
				<div class="pageSuumo__tableWrap">
					<?php
					$suumo_table = new Suumo_Table();
					$suumo_table->echo_suumo_table(); ?>
				</div>

				<div class="pageSuumo__buttonWrap">
					<button class="pageSuumo__button js__modal__trigger" data-modal-target="suumo__form" type="button">物件情報を登録する</button>
					<a href="<?php echo home_url('/suumo/google-map/'); ?>" target="_blank" rel="noopener" class="-tac">Google Mapで見る</a>
				</div>

			</div>
		</div>
	<?php }) ?>





<?php require_once(get_theme_file_path() . "/Feature-suumo/c-suumo-modal.php") ?>

<script src="<?php echo get_template_directory_uri(); ?>/Feature-suumo/Assets/Js/page-suumo.js"></script>
<?php get_footer();
