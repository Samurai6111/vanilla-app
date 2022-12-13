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

						<dl class="pageMypageDl">
							<dt>ユーザーID</dt>
							<dd><?php echo wp_kses_post($current_user->user_login) ?></dd>
						</dl>

						<dl class="pageMypageDl">
							<dt>Email</dt>
							<dd><?php echo wp_kses_post($current_user->user_email) ?></dd>
						</dl>

						<dl class="pageMypageDl">
							<dt>パスワード</dt>
							<dd>
								<?php suumo_button_type1([
									'text' => 'パスワードを変更する',
									'attr' => 'type=button onclick=show_password_input(event)',
									'tag' => 'button',
									'class' => '-color-reverse -small',
								]) ?>
							</dd>
						</dl>


						<div class="pageMypageBreak"></div>


						<?php $suumo_user_google_api_key = get_user_meta($user_id, 'suumo_user_google_api_key', true); ?>

						<?php suumo_mypage_title('アプリケーション') ?>

						<dl class="pageMypageDl">
							<dt>APIキー</dt>
							<dd>
								<input class="-reset" type="text" name="suumo_user_google_api_key" size="50" value="<?php echo esc_attr($suumo_user_google_api_key) ?>">
							</dd>
						</dl>


						<div class="pageMypageForm__buttonWrap">
							<?php suumo_button_type1([
								'text' => '保存',
								'attr' => 'type="submit"',
							]) ?>
						</div>
					</form>
				</div>

				<div class="tabSwitch__content" tab-content="tab2">
					<form class="pageMypageForm" action="<?php echo esc_url(get_permalink() . '/?tab-target=tab2'); ?>" method="POST">
						<?php vanilla_wp_nonce_field('suumo_table_customize') ?>
						<input type="hidden" name="user_id" value="<?php echo esc_attr($user_id) ?>">

						<?php suumo_mypage_title('テーブルのカスタマイズ') ?>

						<table class="pageMypageTable -suumo-table-customize" id="suumoTableCustomize">
							<tr>
								<th>カラム名</th>
							</tr>

							<?php Suumo_Mypage_Form::the_suumo_user_table_customs() ?>
						</table>
						<br><br>

						<?php suumo_button_type1([
							'text' => 'カラムを追加する',
							'attr' => 'type=button onclick=add_suumo_table_customize_column(event)',
							'tag' => 'button',
							'class' => '-color-reverse -small',
						]) ?>
						<br><br>

						<div class="pageMypageForm__buttonWrap">
							<?php suumo_button_type1([
								'text' => '保存',
								'attr' => 'type="submit"',
							]) ?>
						</div>
					</form>
				</div>
			</div>

		</div>
	<?php }) ?>
	</mypage>

	<script src="<?php echo get_template_directory_uri(); ?>/Feature-suumo/Assets/Js/page-suumo-mypage.js"></script>
	<?php get_footer();
