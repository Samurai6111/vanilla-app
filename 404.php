<?php
/**
* Template 404 pages (Not Found)
* @package WordPress
*/

get_header(); ?>
<link rel="stylesheet"
      href="<?php echo get_template_directory_uri() ?>/asset/css/404.css">

<section class="notFound">
  <div class="inner">
    <h2 class="notFound_title"
        title="404 NotFound">お探しのページは<br class="sp">見つかりませんでした</h2>
    <p class="notFound_text">お客様のお探しのページは、<br>一時的に「アクセス出来ない状態」か<br class="sp">「移動」または「削除」されました。</p>
    <a class="button"
       href="/">TOPに戻る</a>

  </div>
</section>

<?php get_footer(); ?>