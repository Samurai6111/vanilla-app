<?php

/**
 * Template Name: index.php
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<main class="pageFront" id="pageFront">
	<div class="pageFront__titleWrap">
		<figure class="pageFront__titleFigure">
			<img src="<?php echo get_template_directory_uri() . '/Image/icon_sitemap_white_1.svg' ?>" alt="サイトマップ" class="pageFront__titleImg">
		</figure>

		<h1 class="pageFront__title">
			SITEMAP<br>
			<span>サイトマップ</span>
		</h1>
	</div>


	<div class="inner">

		<div class="pageFrontContents -custom-scrolbar">

			<ul class="pageFront__posts -level1">
				<li class="pageFront__post">
					<?php sitemap_card(home_url(), 'サイトトップ', 'sitemap_index_1.png') ?>
				</li>

				<li class="pageFront__post">
					<ul class="pageFront__posts -level2">
						<?php //== 親ページ ========
						?>
						<li class="pageFront__post">
							<?php sitemap_card(home_url('/login/'), 'ログイン', 'sitemap_login_1.png') ?>
						</li>

						<?php //== 親ページ ========
						?>
						<li class="pageFront__post">
							<?php sitemap_card(home_url('/suumo/'), '物件一覧', 'sitemap_suuumo_1.png') ?>
							<ul class="pageFront__posts -level3">
								<?php //== 子ページ ========
								?>
								<li class="pageFront__post">
									<?php sitemap_card(home_url('/suumo/google-map/'), '物件 Google Map', 'sitemap_suumo_google_map_1.png') ?>
								</li>
								<li class="pageFront__post">
									<?php sitemap_card(home_url('/suumo/mypage/'), '物件 マイページ', 'sitemap_suumo_mypage_1.png') ?>
								</li>
							</ul>
						</li>

						<?php //== 親ページ ========
						?>
						<li class="pageFront__post">
							<?php sitemap_card(home_url('/suumo/'), '物件一覧', 'sitemap_suuumo_1.png') ?>
							<ul class="pageFront__posts -level3">
								<?php //== 子ページ ========
								?>
								<li class="pageFront__post">
									<?php sitemap_card(home_url('/suumo/google-map/'), '物件 Google Map', 'sitemap_suumo_google_map_1.png') ?>
								</li>
								<li class="pageFront__post">
									<?php sitemap_card(home_url('/suumo/mypage/'), '物件 マイページ', 'sitemap_suumo_mypage_1.png') ?>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>

	</div>
</main>




<?php get_footer(); ?>
