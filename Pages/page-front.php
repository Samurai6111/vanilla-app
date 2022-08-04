<?php

/**
 * Template Name: トップページ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<main class="pageFront" id="pageFront">
	<div class="inner">
		<div class="inner">

			<?php
			$args = array(
				'post_type' => 'test',
				'posts_per_page' => 6,
			);
			$array = [];
			$WP_post = new WP_Query($args);
			if ($WP_post->have_posts()) {
				while ($WP_post->have_posts()) {
					$array_child = [];


					echo '<pre>';
					var_dump(get_field_objects());
					echo '</pre>';
				}
			}
			wp_reset_postdata();
			?>

		</div>
	</div>
</main>


<?php get_footer();
