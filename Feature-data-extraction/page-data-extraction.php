<?php
// require_once(dirname(__FILE__) . "/data-extract-form-execution.php");

$API_KEY = get_option('vanilla_google_custom_search_api_key');
$cx = "検索エンジンID";

$client = new Google\Client();
$client->setApplicationName("AppName");
$client->setDeveloperKey($API_KEY);
$service = new Google\Service\CustomSearchAPI($client);

$param = array(
    'q'                     =>   '猫',
    'searchType'     => 'image',
    'cx'                    => $cx,
    'num'                => '10',
);

$results = $service->cse->listCse($param);

print_r($results);

/**
 * Template Name: データ抽出
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<style>
	input {
		display: inline-block;
		width: 100%;
	}
</style>

<main>
	<?php ui_frame(function () { ?>
		<?php ui_head('Data Extraction') ?>
		<div class="suumoUrlFormContainer">
			<h2 class="suumoUrlForm__title"></h2>

			<form action="<?php echo get_permalink(); ?>" class="suumoUrlForm" id="suumoUrlForm" method="POST">

				<?php vanilla_wp_nonce_field('data_extraction') ?>
				<input class="suumoUrlForm__urlInput" type="text" name="url" value="https://docs.emmet.io/cheat-sheet/">

				<div class="suumoUrlForm__buttonWrap">
					<button class="pageSuumo__button" type="submit">登録</button>
				</div>
			</form>
		</div>


	<?php }) ?>
</main>
<?php get_footer();
