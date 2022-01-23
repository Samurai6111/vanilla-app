<?php
/**
 * Template header
 * @package WordPress
 * @subpackage Vanilla
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>
      dir="ltr">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
  <meta http-equiv="Content-Type"
        content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
  <meta name="viewport"
        content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <meta name="keywords"
        content="キーワードを設定します">
  <meta name="description"
        content="<?php bloginfo('description'); ?>">
  <?php wp_head(); ?>

  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
  <script src="https://kit.fontawesome.com/6ff808ba48.js"
          crossorigin="anonymous"></script>

</head>

<body id="top"
      class="body">