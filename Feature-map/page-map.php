<?php

/**
 * Template Name: マップ
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-map/Assets/Css/style.css">

<main class="pageMap -moving-bgc" id="pageMap">
</main>



<script>
	// let ls_csv_json = window.localStorage.getItem('csv_json')
	// if (!ls_csv_json) {
	// 	let csv_json = '<?php echo $csv_json ?>'
	// 	window.localStorage.setItem('csv_json', csv_json)
	// } else {
	// 	let csv_array = JSON.parse(ls_csv_json)
	// 	// console.log(csv_array)

	// }

</script>


<?php get_footer(); ?>
