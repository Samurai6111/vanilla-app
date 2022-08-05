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
			<ul class="">
				<?php
				$args = array(
					'post_type' => 'test',
					'posts_per_page' => -1,
				);
				$array = [];
				$postslist = get_posts($args);
				if ($postslist) {
					foreach ($postslist as $post) {
						setup_postdata($post);
						$array_child = [];

						$fields = get_field_objects();

						if ($fields) {
							foreach ($fields as $key => $values) {
								$array_child[$key] = get_field($key);
							}

							$array[] = $array_child;
						}

					}
				}
				wp_reset_postdata();
				$json = json_encode($array);


				echo '<pre>';
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				var_dump('zxdfkajsd;lfj');
				echo '</pre>';
				echo $json;
				 ?>
			</ul>

		</div>
	</div>
</main>


<?php get_footer();
