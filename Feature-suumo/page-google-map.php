<?php

/**
 * Template Name: suumo google map
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

<?php

function image_json_to_array($row) {
	$row->images = json_decode($row->images);
	return $row;
}

$Suumo_Table = new Suumo_Table();
$suumo_values_array = $Suumo_Table->get_table_values();
$suumo_values_array_modified = array_map('image_json_to_array', $Suumo_Table->get_table_values());
$suumo_values_json = json_encode($suumo_values_array_modified);
?>

<div class="pageGooglemap">
	<aside class="pageGooglemapSidebar" id="pageGooglemapSidebar">
		<?php require_once(get_theme_file_path() . "/Feature-suumo/sidebar-google-map.php") ?>
	</aside>

	<div id="map"></div>
</div>


<?php require_once(get_theme_file_path() . "/Feature-suumo/js-page-google-map.php") ?>
<?php
global $current_user;
$suumo_user_google_api_key = get_user_meta($current_user->ID, 'suumo_user_google_api_key', true);
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($suumo_user_google_api_key) ?>&callback=initMap" async defer></script>

<?php require_once(get_theme_file_path() . "/Feature-suumo/c-suumo-modal.php") ?>
<script src="<?php echo get_template_directory_uri(); ?>/Feature-suumo/Assets/Js/page-suumo.js"></script>


<?php get_footer();
