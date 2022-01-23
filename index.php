<?php

/**
 * Template Name: 投稿アーカイブテンプレート
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<ul>
  <?php
  $args = array(
    'post_type' => 'post',
    'paged' => get_query_var('page'),
    'order' => 'DESC',
    'posts_per_page' => 6,
  );
  $WP_post = new WP_Query($args);
  if ($WP_post->have_posts()) {
    while ($WP_post->have_posts()) {
      $WP_post->the_post(); ?>
  <li>
    <a href="<?php echo get_permalink(); ?>">
      <?php if (has_post_thumbnail()) { ?>
      <figure style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>)"></figure>
      <?php } ?>
    </a>
  </li>
  <?php }
  }
  wp_reset_postdata();
  ?>
</ul>




<?php get_footer(); ?>