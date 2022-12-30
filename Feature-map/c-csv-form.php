<form class="pageMapform__csvForm" action="<?php echo esc_url(get_permalink()); ?>" enctype="multipart/form-data" method="POST">
	<?php vanilla_wp_nonce_field('csv_form') ?>

	<input type="file" name="csvfile">
	<?php button_type1([]) ?>
</form>
