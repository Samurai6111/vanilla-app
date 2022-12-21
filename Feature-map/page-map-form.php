<?php

csv_redirect();

/**
 * Template Name: マップフォーム
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-map/Assets/Css/style.css">


<main class="pageMap -moving-bgc" id="pageMap">
	<?php ui_frame(function () { ?>
		<?php ui_head('Map') ?>

		<div class="pageMapBody">
			<div class="inner -tight -no-padding">
				<?php

				if (empty($_GET)) { ?> <form action="<?php echo esc_url(get_permalink()); ?>" enctype="multipart/form-data" method="POST">
						<input type="file" name="csvfile">

						<?php button_type1([]) ?>

					</form>
				<?php

				} else {
					$params = vanilla_sanitize_array($_GET);
					$status = $params['status'];

					if ($status === 'address-selection') {

						require_once(dirname(__FILE__) . "/c-address-selection-form.php");
					}

					unset($params['status']);
					$csv_json = json_encode($params);
				}

				?>

			</div>
		</div>
	<?php }) ?>


	<?php get_footer(); ?>
