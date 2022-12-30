<style>
	.modalWrap,
	.modalWrap .modal__contentWrap .modal__targetContent {
		display: block;
	}
</style>
<div class="modalWrap" id="modalWrap">
	<div class="modal__scroll js__modal__scroll">
		<div class="modal__contentWrap ">
			<div class="js__modal__contentHeight">
				<div class="modal__content js__modal__content">
					<div class="modal__targetContent">
						<div class="mapFormContainer">
							<h2 class="mapForm__title">物件URL入力フォーム</h2>

							<form action="<?php echo esc_url(get_permalink()) ?>" class="mapForm vanillaForm" id="mapForm" method="POST">

								<?php vanilla_wp_nonce_field('address_selection') ?>

								<ul class="vanillaForm__rowList">
									<?php
									$vanilla_form = new Vanilla_Form();

									Map_Input_Contents::hidden_input('csv_data_json', '');

									$vanilla_form->row_item(
										vanilla_form_label('住所'),
										vanilla_form_input('Map_Input_Contents::address_selection'),
										'-input-vertical -input-flex-aic'
									);
									?>
								</ul>

								<?php if (!empty($insert_suumo_data_validation)) { ?>
									<p class="mapForm__errorText -color-red">
										<?php echo esc_html($insert_suumo_data_validation['suumo_url']); ?>
									</p>
								<?php } else { ?>
									<br>
								<?php } ?>

								<div class="mapForm__buttonWrap">
									<button class="buttonType1" type="submit">登録</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	let form = $('#mapForm')
	form.find('input[name="csv_data_json"]').val(csv_data_json)
</script>
