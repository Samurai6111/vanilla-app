<?php

/**
 * Template Name: suumo マイページ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

<mypage class="pageMypage -moving-bgc" id="pageMypage">
	<?php suumo_frame(function () {
	  global $current_user;
		 ?>
		<?php suumo_head('Mypage') ?>
		<div class="tabSwitch">
			<div class="tabSwitch__labels">
				<div class="tabSwitch__labelItem -active" id="tab1" onclick="add_tab_parameta(event)">
					<p class="tabSwitch__labelText">
						ユーザー
					</p>
				</div>

				<div class="tabSwitch__labelItem" id="tab2" onclick="add_tab_parameta(event)">
					<p class="tabSwitch__labelText">
						カスタマイズ
					</p>
				</div>
			</div>

			<div class="tabSwitch__contents">
				<div class="tabSwitch__content" tab-content="tab1">
					<?php suumo_mypage_title('ユーザー基本情報') ?>
					<table class="pageMypageTable">
						<tr>
							<th>ユーザーID</th>
							<td><?php echo wp_kses_post($current_user->user_login) ?></td>
						</tr>
						<tr>
							<th>ユーザーID</th>
							<td><?php echo wp_kses_post($current_user->user_login) ?></td>
						</tr>
					</table>

					<div class="pageMypageBreak"></div>

					<?php suumo_mypage_title('アプリケーション') ?>
					<table class="pageMypageTable">
						<tr>
							<th>APIキー</th>
							<td><?php echo wp_kses_post($current_user->user_login) ?></td>
						</tr>
					</table>
				</div>

				<div class="tabSwitch__content" tab-content="tab2">
					タブ2のコンテンツ
				</div>
			</div>

		</div>

	<?php }) ?>
	</div>

</mypage>
<?php get_footer();
