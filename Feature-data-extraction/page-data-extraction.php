<?php
require_once(dirname(__FILE__) . "/data-extract-form-execution.php");


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
				<div class="flex justify-center gap-6 ">
					<input class="border-gray-300 border-2 w-80 p-4 mb-10" type="text" name="q" placeholder="検索キーワード">

					<select name="device" class="border-gray-300 border-2 w-48 text-center p-4 mb-10">
						<option value="mobile">mobile</option>
						<option value="desktop">desktop</option>
						<option value="tablet">tablet</option>
					</select>

				</div>

				<div class="flex justify-center ">
					<button class="w-48 text-center p-4 text-2xl bg-indigo-900 text-white" type="submit">登録</button>
				</div>

				<?php if ($_GET['result'] === "success") { ?>
					<br> <br>
					<p class="text-center underline">
						<a href="https://docs.google.com/spreadsheets/d/14cq8GP8vSOjc-sdNL-Z2RUiRAkLGqATvnexE20KwvsU/edit#gid=0" target="_blank" rel="noopener">
							スプレッドシートを見る
						</a>
					</p>
				<?php } ?>
			</form>
		</div>
	<?php }) ?>
</main>
<?php get_footer();
