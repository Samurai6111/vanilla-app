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


<?php

function image_json_to_array($row) {
	$row->images = json_decode($row->images);
	return $row;
}

?>

<div id="map"></div>


<?php require_once(dirname(__FILE__) . "/js-page-map.php") ?>
<?php
global $current_user;
$suumo_user_google_api_key = get_user_meta($current_user->ID, 'suumo_user_google_api_key', true);

?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($suumo_user_google_api_key) ?>&callback=initMap" async defer></script>

<!-- <?php require_once(get_theme_file_path() . "/Feature-suumo/c-suumo-modal.php") ?> -->
<!-- <script src="<?php echo get_template_directory_uri(); ?>/Feature-suumo/Assets/Js/page-suumo.js"></script> -->

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
