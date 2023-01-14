<?php

use Carbon\Carbon;
/*--------------------------------------------------
/* モジュール
/*------------------------------------------------*/

/**
 * 日付選択のフォーム
 *
 * @param
 * @return
 */
function the_pixel_set_date_form() {
	$param = vanilla_sanitize_array($_GET);
	$today = new Carbon('today');
	$y = $today->copy()->year;
	$stop = $today->copy()->subYears('30')->year;
	$target_date_GET = @$param['target-date'];$pieces = $target_year = @explode("-", $target_date_GET)[0];
?>
	<div class="pixelartdateFormContainer">
		<p class="pixelartdateForm__text -tac">
			年を選択してください
		</p>

		<form action="" method="GET" class="pixelartdateForm" id="pixelartdateForm">

			<div class="ulSelectWrap">
				<select name="target-date" class="pixelartdateForm__select" id="pixelartdateForm__select">
				<?php
				$y = $y + 1;
					while ($y >= $stop) {
					--$y;

					$selected = ($target_year == $y) ? 'selected' : '';
					 ?>
						<option value="<?php echo esc_attr($y) ?>" <?php echo esc_attr($selected) ?>>
							<?php echo esc_html($y) ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</form>
	</div>

	<script>

		$('#pixelartdateForm__select').on('change', function() {
			$('#pixelartdateForm').submit()

		})

	</script>
<?php

}

/**
 * 塗りつぶしのカラーパレット
 *
 * @param
 * @return
 */
function the_pixel_art_colors() {
	$colors = [
		'#161b22', // 0 contibution
		'#0d4429', // 1 contibution
		'#016d31', // 2 contibution
		'#26a641', // 3 contibution
		'#39d353', // 4 contibution
	];
?>
	<div class="pixelartColorsContainer">
		<p class="pixelartColors__text">
			色を選択してください
		</p>

		<div class="pixelartColors">
			<?php
			$i = -1;
			foreach ($colors as $color) {
				++$i;

				$checked = ($i === 1) ? 'checked' : '';
			?>
				<input type="radio" name="fill_color" class="pixelartColor__input" id="<?php echo esc_attr($i) ?>" <?php echo esc_attr($checked) ?> value="<?php echo esc_attr($i) ?>">
				<label class="pixelartColor__label" style="background-color:<?php echo esc_attr($color) ?>;" for="<?php echo esc_attr($i) ?>"></label>

			<?php } ?>
		</div>
	</div>
<?php

}

/**
 * ピクセルアートのテーブル
 */
function the_pixel_art_table() {
	$start_date = get_pixel_art_start_date();
	$week = $start_date->copy()->dayOfWeek + 1;
	$end_date = $start_date->copy()->endOfYear();
	$days = $start_date->diffInDays($end_date) + 1;
	$start_grid = $start_date->copy()->subDays($week);
?>

	<section class="pixelartTableContainer -hide-scrollbar" id="pixelartTableContainer">
		<div class="pixelartTable" id="pixelartTable">
			<?php
			$i = 0;
			while ($i < $days) {
				++$i;
				$date = $start_grid->copy()->addDays($i);
				$formatted_date = format_git_command_date($date);
				$hidden_class = ($start_date->year !== $date->year) ? '-hidden' : '';
			?>
				<?php echo ($i === 1 || $i % 7 === 1) ? '<div class="pixelartTable__row">' : '' ?>

				<div class="pixelartTable__cell <?php echo $hidden_class ?>" data-contribution-count="0" data-date-command="<?php echo $formatted_date ?>" data-date="<?php echo $date->copy()->format('Y/m/d') ?>">
				</div>

				<?php echo ($i % 7 === 0) ? '</div>' : '' ?>
			<?php } ?>
		</div>
	</section>
<?php
}
