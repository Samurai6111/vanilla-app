<?php
$Suumo_Form = new Suumo_Form();

if (isset($_POST['suumo_id'])) {

	$delete = $Suumo_Form->delete_suumo_data($_POST);
} else {

	$result = $Suumo_Form->insert_suumo_data($_POST);
	echo '<pre>';
	var_dump($result);
	echo '</pre>';
}

/**
 * Template Name: スーモ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<br><br><br><br><br><br><br><br><br>
<main class="pageSuumo" id="pageSuumo">
	<div class="inner">
		<?php

		$suumo_table = new Suumo_Table();
		$suumo_table->echo_suumo_table(); ?>
		<br><br><br><br><br><br><br><br><br>

		<?php
		Suumo_Form::suumo_url_form();


		?>

	</div>
</main>

<script>
	$('#wpadminbar').hide()
	$('#header').hide()
</script>

<?php get_footer();
