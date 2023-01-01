<?php map_ui_steps(2) ?>

<form action="<?php echo esc_url(home_url("/map/")) ?>" class="mapForm vanillaForm" id="mapForm" method="GET">
	<p class="vanillaForm__text">ピンデータを選択してください</p>

	<?php
	Map_Input_Contents::hidden_input('status', 'show-result');
	Map_Input_Contents::param_hidden_input($params, 'address_selection_index');
	Map_Input_Contents::pin_data_selection();
	?>

	<br><br><br>
	<?php button_type1(['text'=>'送信']) ?>

	<a href="<?php echo home_url("/map-form/?status=address-selection"); ?>" class="mapForm__backButton">戻る</a>
</form>
