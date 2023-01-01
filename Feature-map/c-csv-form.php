<?php map_ui_steps(0) ?>

<form action="<?php echo esc_url(get_permalink()) ?>" class="mapForm" id="mapForm" method="POST" enctype="multipart/form-data">
	<p class="vanillaForm__text">CSVデータを添付してください</p>

	<?php vanilla_wp_nonce_field('csv_form') ?>

	<input type="file" name="csvfile" accept=".csv">

	<br><br>
	<?php button_type1(['text'=>'送信']) ?>
</form>
