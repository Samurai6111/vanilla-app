<div class="headerWrap">
	<header class="header"
					id="header">
		<div class="inner -header">
			<div class="header__flex">

				<a class="header__logo"
					 href="<?php echo home_url(); ?>">
					<img class="header__logoImg -pc-only"
							 src="<? //php echo get_template_directory_uri()
																											?>/Img/common/icon_logo_black_pc_1.svg"
							 alt="ロゴ">
					<img class="header__logoImg -sp-only"
							 src="<? //php echo get_template_directory_uri()
																											?>/Img/common/icon_logo_black_sp_1.svg"
							 alt="ロゴ">
				</a>


				<?php

				$menu_args = [
					'container_class' => 'header__navWrap -pc',
					'menu_class' => 'header__nav',
					'theme_location' => 'vanilla-nav-menu-pc'
				];
				wp_nav_menu($menu_args);
				?>

				<div class="gnav">
					<div class="gnav__inner">
						<div class="gnav__scroll">
							<?php
							$menu_args = [
								'container_class' => 'gnav__listWrap -sp',
								'menu_class' => 'gnav__list',
								'theme_location' => 'vanilla-nav-menu-pc'
							];
							wp_nav_menu($menu_args);
							?>

							<a href="__TBD__"
								 target="_blank"
								 rel="noopener"
								 class="gnav__corporateSite">
								<img src="<? //php echo get_template_directory_uri()
													?>/Img/common/icon_logo_white_1.svg"
										 alt="ロゴ"
										 class="gnav__corporateSiteImg">
								<span class="gnav__corporateSiteText">コーポレートサイト</span>

							</a>
						</div>
					</div>
				</div>




				<div class="hamburger_wrap">
					<nav class="hamburger hamburger-js js__modal__trigger">
						<span class="hamburger_line -top"></span>
						<span class="hamburger_line -bottom"></span>
					</nav>
				</div>

			</div>
		</div>
	</header>
</div>