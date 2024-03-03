<?php

/**
 * Template Name: ルーレット
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tsukimi+Rounded:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<main id="pageRoulette">
	<div id="roulette-container">
		<p class="member -tac">世界一の<br>天才創造神</p>

		<p class="member">
			<img src="<?php echo get_template_directory_uri() . '/Feature-roulette/Image/logo_gucci_1.png' ?>">
		</p>

			<p class="member">
				<b>ヒューゴ</b> 26歳、独身、子なし、ブリトー好き、結婚願望あり、マーベルにハマってる、好きな食べ物はブリトー、最近はフィギュア集めに忙しい、社畜エンジニア、お父さんがドッペルゲンガー並みに似てる、あとブリトーが好き。
			</p>

			<p class="member">
			<img src="<?php echo get_template_directory_uri() . '/Feature-roulette/Image/img_utndo_1.jpeg' ?>">
			</p>
		<div id="roulette">
			<div class="sector" id="cleaning"><p class="sectorText">掃除</p></div>
			<div class="sector" id="dish-wash"><p class="sectorText">皿洗い</p></div>
			<div class="sector" id="nothing"><p class="sectorText">何もしない</p></div>
			<div class="sector" id="rubbish"><p class="sectorText">ゴミ出し</p></div>
		</div>
		<button id="spin"><span>れっつすぴんっ!!</span></button>
	</div>

<!-- 既存のHTMLに続けて -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p id="modal-text">当番は...</p>
  </div>
</div>

</main>


<script>
$(document).ready(function() {
  let sectors = ['掃除', '皿洗い', '何もしない', 'ゴミ出し'];

  $('#spin').on('click', function() {
    let spins = Math.floor(Math.random() * 8);
    let degrees = 360 * 5 + 90 * spins;
    let sectorIndex = spins % sectors.length;
    let sector = sectors[sectorIndex];

    $('#roulette').css({
      'transition': 'transform 4s cubic-bezier(0.17, 0.67, 0.83, 0.67)',
      'transform': 'rotate(' + degrees + 'deg)'
    }).one('transitionend', function() {
      // $('#modal').fadeIn();
			$('#nothing').addClass('champion')
			$('#dish-wash').addClass('loser')
    });
  });

  $('.close').on('click', function() {
    $('#modal').fadeOut();
  });
});




</script>
<?php get_footer(); ?>
