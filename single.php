<?php

/**
 * Template Name: 投稿ページテンプレート
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>

<div class="inner">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
  ?>

  <?php the_content() ?>

  <?php  }
  } ?>

</div>
loop

<?php get_footer();