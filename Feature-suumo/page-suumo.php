<?php
require_once(get_theme_file_path() . "/Feature-suumo/suumo-form-execution.php");

/**
 * Template Name: suumo
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

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
					<button class="pageSuumo__button js__modal__trigger" type="button">物件情報を登録する</button>
					<a href="<?php echo home_url('/suumo/google-map/'); ?>" target="_blank" rel="noopener" class="-tac">Google Mapで見る</a>
				</div>

			</div>
		</div>
	<?php }) ?>


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
