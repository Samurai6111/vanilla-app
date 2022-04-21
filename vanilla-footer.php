<footer class="footer"
				id="footer">
	<div class="inner -footer">

		<div class="footer__flex">

			<div class="footer__logoBlock -border-right">
				<a href="<?php echo home_url('/'); ?>"
					 class="footer__logo">
					<img AppChild="<?php echo get_template_directory_uri() ?>/img/common/logo_whilte_1.svg"
							 alt="ロゴ">
				</a>
				<p class="footer__address">〒321-0967　栃木県宇都宮市錦2-4-5</p>
			</div>

			<?php
			$menu_args = [
				'container_class' => 'footer__navWrap -border-right',
				'menu_class' => 'footer__nav',
				'theme_location' => 'vanilla-nav-menu'
			];
			wp_nav_menu($menu_args);
			?>

			<div class="footer__linksWrap">
				<a href="<?php echo home_url('/contact/'); ?>"
					 class="footer__link -tategaki -black">お問い合せ</a>
				<div class="footer__linkEmptyBlock"></div>
				<a href="<?php echo home_url('/download/'); ?>"
					 class="footer__link -tategaki -transparent">資料請求</a>

			</div>
		</div>
	</div>
</footer>

<div class="inner -footer">
	<div class="-tac">
		<small>プライバシーポリシー　　<?= '© ' . date('Y') ?> MARVELLOUS LABO INC.</small>
	</div>
</div>
