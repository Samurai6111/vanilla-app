<div class="pagination">
	<?php echo paginate_links(array(
				'format' => 'page/%#%/',
				'current' => max(1, get_query_var('page')),
				'total' => $WP_post->max_num_pages,
				'type' => 'list',
				'mid_size' => '1',
				'prev_text' => '<i class="fas fa-angle-left"></i>',
				'next_text' => '<i class="fas fa-angle-right"></i>',
			));
			wp_reset_postdata();
			?>
</div>