SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID
 					FROM wp_posts  INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id )
 					WHERE 1=1  AND ( wp_postmeta.meta_key = 'meta_value_test')
					AND (
						(
							wp_posts.post_type = 'post' AND
							 (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'acf-disabled' OR wp_posts.post_status = 'private')
							 )
							)
 					GROUP BY wp_posts.ID
 					ORDER BY wp_postmeta.meta_value+0 DESC
 					LIMIT 0, 6
