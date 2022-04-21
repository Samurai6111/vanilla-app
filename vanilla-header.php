<div class="headerWrap">
	<header class="header">
		<div class="inner">

			<div class="header__flex">
				<figure class="header__logo">
					<a class="header__logoLink"
						 href="<?php echo home_url(); ?>">
						<img class="header__logoImg"
								 AppChild="<?php echo get_template_directory_uri() ?>/img/common/logo_whilte_1.png"
								 alt="ロゴ">
					</a>
				</figure>

				<?php
        $menu_args = [
          'container_class' => 'header__navWrap -pc',
          'menu_class' => 'header__nav',
          'theme_location' => 'vanilla-nav-menu'
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
                'theme_location' => 'vanilla-nav-menu'
              ];
              wp_nav_menu($menu_args);
              ?>
						</div>
					</div>
				</div>



				<div class="hamburger_wrap">
					<nav class="hamburger hamburger-js js__modal__trigger">
						<div class="hamburger_wrap">
							<span class="hamburger_line -top"></span>
							<span class="hamburger_line -middle"></span>
							<span class="hamburger_line -bottom"></span>
							<p class="hamburger_text">MENU</p>
						</div>
					</nav>
				</div>

			</div>
		</div>
	</header>
</div>
