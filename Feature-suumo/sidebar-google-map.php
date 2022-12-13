<div class="sidebarGooglemap__container">
	<button class="sidebarGooglemap__button" id="sidebarGooglemap__button" type="button">
		<span class="sidebarGooglemap__buttonArrow">◀︎</span>
	</button>

	<div class="sidebarGooglemap -custom-scrolbar" id="sidebarGooglemap">

		<ul class="sidebarGooglemap__list">
			<?php
			foreach ($suumo_values_array as $suumo_values) { ?>
				<li class="sidebarGooglemap__item" id="<?php echo esc_attr('sidebarGooglemap__item-' . $suumo_values->ID) ?>" >

					<button class="sidebarGooglemap__mapButton -reset" type="button" onclick="pan_to_map(<?php echo esc_attr($suumo_values->ID) ?>)">
						<img src="<?php echo get_template_directory_uri() . '/Feature-suumo/Image/icon_map_and_pin_navy_1.svg' ?>" alt="">
					</button>

					<figure class="sidebarGooglemap__figure">
						<?php echo $Suumo_Table->format_suumo_value($suumo_values->images, 'images') ?>
					</figure>

					<div class="sidebarGooglemap__desc">
						<table class="sidebarGooglemap__table">
							<?php foreach ($suumo_values as $key => $suumo_value) {
								if (
									$key === 'construction' ||
									$key === 'initial_fee' ||
									$key === 'room_arragement' ||
									$key === 'longitude' ||
									$key === 'latitude' ||
									$key === 'images'
								) {
									continue;
								}
								$label = $Suumo_Table->table_columns[$key];
							?>
								<tr>
									<th>
										<?php echo $label ?>
									</th>
									<td>
										<?php echo $Suumo_Table->format_suumo_value($suumo_value, $key) ?>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>

<script>
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
</script>
