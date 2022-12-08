<?php
// $Suumo_Form = new Suumo_Form();
require_once(get_theme_file_path() . "/App/Suumo/suumo-form-execution.php");


// if (isset($_POST['suumo_id'])) {

// 	$delete = $Suumo_Form->delete_suumo_data($_POST);
// } else {

// 	$result = $Suumo_Form->insert_suumo_data($_POST);
// 	echo '<pre>';
// 	var_dump($result);
// 	echo '</pre>';
// }

/**
 * Template Name: スーモ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<main class="pageSuumo" id="pageSuumo" style="background-image:url(<?php echo get_template_directory_uri() ?>/Image/Page/Suumo/img_suumo_mv_1.jpg);">
	<div class="inner -wide">
		<div class="pageSuumoContainer">
			<div class="pageSuumoHead">
				<h1 class="pageSuumoHead__title">SUUMO Info Generator</h1>

				<p class="pageSuumoHead__author">
					Made by <br>
					<span><a href="https://github.com/Samurai6111" target="_blank" rel="noopener">Shota Kawakatsu</a></span>
				</p>
			</div>

			<div class="pageSuumoBody">
				<div class="inner -tight -no-padding">
					<div class="pageSuumo__tableWrap">
						<?php
						$suumo_table = new Suumo_Table();
						$suumo_table->echo_suumo_table(); ?>
					</div>

					<div class="pageSuumo__buttonWrap js__modal__trigger">
						<button class="pageSuumo__button" type="button">物件情報を登録する</button>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="modalWrap" id="modalWrap">
		<div class="modal__scroll js__modal__scroll">
			<div class="modal__contentWrap ">
				<div class="js__modal__contentHeight">
					<div class="modal__content js__modal__content">
						<?php Suumo_Form::suumo_url_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	const current_url = window.location;
	const query_string = current_url.search;
	const url_param = new URLSearchParams(query_string);
	const param = url_param.get('param')

	// ---------- データーが挿入された時 ----------
	if (param === 'suumo-data-inserted') {

		setTimeout(function() {
			$('.suumoTable tbody tr:last-child').addClass('-data-inserted')
		}, 500);

		setTimeout(function() {
			$('.suumoTable tbody tr:last-child').removeClass('-data-inserted')

			current_url.search = '';
			const newUrl = url_param.toString();
			window.hsitory.pushState({
				path: new_url
			}, '', new_url)
		}, 3000);
	}

	// ---------- データが挿入のバリデーションに引っかかった時 ----------
	let form_error_text = $('.suumoUrlFormContainer .suumoUrlForm__errorText')
	if (form_error_text.length > 0) {
		$('#modalWrap').fadeIn()
	}


	$('#wpadminbar').hide()
</script>

<?php get_footer();
