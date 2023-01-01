<div class="sidebarGooglemap__container">
	<button class="sidebarGooglemap__button" id="sidebarGooglemap__button" type="button">
		<span class="sidebarGooglemap__buttonArrow">◀︎</span>
	</button>

	<div class="sidebarGooglemap -custom-scrolbar" id="sidebarGooglemap">

		<form action="<?php echo esc_url(home_url("/map/")) ?>" class="mapForm vanillaForm" id="mapForm" method="GET">
			<p class="vanillaForm__text">ピンデータを選択してください</p>

			<?php
			Map_Input_Contents::hidden_input('status', 'show-result');
			Map_Input_Contents::pin_data_selection();
			?>

			<br><br><br>
			<?php button_type1(['text' => '送信']) ?>
		</form>


		<ul class="sidebarGooglemap__list">
			<li class="sidebarGooglemap__item"></li>

		</ul>
	</div>
</div>

<!-- <script>
	$('#sidebarGooglemap__button').on('click', function() {
		$(this).toggleClass('-closed')
		$('.sidebarGooglemap__container').toggleClass('-closed')
	})

	function set_sidebar_item_position() {
		let sidebar_google_map = $('#sidebarGooglemap')
		let item = sidebar_google_map.find('.sidebarGooglemap__item')

		item.each(function() {
			let position_top = $(this).position().top
			$(this).data('position-top', position_top)
		})
	}
	set_sidebar_item_position()

	new Swiper('.suumotable__swiper', {
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
</script> -->
