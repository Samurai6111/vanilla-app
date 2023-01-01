<?php map_ui_steps(1) ?>

<form action="<?php echo esc_url(get_permalink()) ?>" class="mapForm vanillaForm" id="mapForm" method="POST">
	<p class="vanillaForm__text">住所データを選択してください</p>

	<?php
	vanilla_wp_nonce_field('address_selection');
	Map_Input_Contents::hidden_input('csv_data_json', '');
	Map_Input_Contents::address_selection();
	 ?>

	<br><br>
	<?php button_type1(['text'=>'送信']) ?>

	<a href="<?php echo home_url("/map-form/"); ?>" class="mapForm__backButton">戻る</a>
</form>

<script>
	let form = $('#mapForm')
	form.find('input[name="csv_data_json"]').val(csv_data_json)
</script>
