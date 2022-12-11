<?php

require_once(dirname(__FILE__) . "/suumo-mypage-form-execution.php");

/**
 * Template Name: suumo マイページ
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */

get_header(); ?>

<?php require_once(dirname(__FILE__) . "/header-suumo.php") ?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/Feature-suumo/Assets/Css/style.css">

<main class="pageMypage -moving-bgc" id="pageMypage">
	<?php suumo_frame(function () {
		global $current_user;
		$user_id = $current_user->ID;
		$suumo_user_google_api_key = get_user_meta($user_id, 'suumo_user_google_api_key', true);
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
					<form class="pageMypageForm" action="<?php echo esc_url(get_permalink()); ?>" method="POST">
						<?php vanilla_wp_nonce_field('suumo_mypage_user_info') ?>
						<input type="hidden" name="user_id" value="<?php echo esc_attr($user_id) ?>">

						<?php suumo_mypage_title('ユーザー基本情報') ?>
						<table class="pageMypageTable">
							<tr>
								<th>ユーザーID</th>
								<td><?php echo wp_kses_post($current_user->user_login) ?></td>
							</tr>
							<tr>
								<th>ユーザーEmail</th>
								<td><?php echo wp_kses_post($current_user->user_email) ?></td>
							</tr>
						</table>

						<div class="pageMypageBreak"></div>

						<?php suumo_mypage_title('アプリケーション') ?>
						<table class="pageMypageTable">
							<tr>
								<th>APIキー</th>
								<td>
									<input class="-reset" type="text" name="suumo_user_google_api_key" size="50" value="<?php echo esc_attr($suumo_user_google_api_key) ?>">
								</td>
							</tr>
						</table>


						<div class="pageMypageForm__buttonWrap">
							<?php suumo_button_type1([
								'text' => '保存',
								'attr' => 'type="submit"',
							]) ?>
						</div>
					</form>
				</div>


				<div class="tabSwitch__content" tab-content="tab2">
					タブ2のコンテンツ
				</div>
			</div>

		</div>
	<?php }) ?>
	</mypage>
	<?php get_footer();
