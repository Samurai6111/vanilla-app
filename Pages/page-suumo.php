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
					<span>Shota Kawakatsu</span>
				</p>
			</div>
			<div class="inner -tight -no-padding">

				<?php
				$suumo_table = new Suumo_Table();
				$suumo_table->echo_suumo_table(); ?>


				<br><br><br><br>
				<?php
				Suumo_Form::suumo_url_form();


				?>
			</div>
		</div>

	</div>
</main>

<script>
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const param = urlParams.get('param')
	if (param === 'suumo-data-inserted') {

		setTimeout(function(){
			$('.suumoTable tbody tr:last-child').addClass('-data-inserted')
		},500);

		setTimeout(function(){
			$('.suumoTable tbody tr:last-child').removeClass('-data-inserted')
		},3000);

	}


	$('#wpadminbar').hide()



</script>

<?php get_footer();
