<?php
function execute_data_extraction($url = '') {
		//= ファイル読み込み ====
		require_once(get_theme_file_path() . "/External-library/phpQuery-onefile.php");

		$suumo_data_array = [];

		$html = file_get_contents('https://www.google.com/search?q=apex+legends&oq=apex+legends&aqs=chrome..69i57j69i59j35i39j0i131i433i512l2j0i433i512j0i512j69i61.5237j0j4&sourceid=chrome&ie=UTF-8');

		$document = phpQuery::newDocument($html);
	// $elements = $document->find('#cheatsheet > section.ch-section.ch-section_css > div.ch-section__content > section:nth-child(1) > dl:nth-child(2) > dt')[0];
	$elements = $document->find('#kp-wp-tab-overview > div.TzHB6b.cLjAic.K7khPe.LMRCfc > div > div > div > div > div > div.Z26q7c.UK95Uc.jGGQ5e.VGXe8 > div > a > h3')->text();

	echo '<pre>';
	var_dump($elements);
	echo '</pre>';
	// $elements = $document['td'];
	// echo '<pre>';
	// var_dump(count($elements));
	// echo '</pre>';
	// foreach ($elements as $element) {
	// 	$text = pq($element)->find('dt')->text();
		// echo '<pre>';
		// var_dump($element);
		// echo '</pre>';
	// }
	// if (is_array($elements)) {
	// 	echo 'asdfadf';

	// }
	$selectors = [
		// '#cheatsheet > section.ch-section.ch-section_css > div.ch-section__content > section:nth-child(1) > dl:nth-child(2) > dt',
		'h1',
	];

		// echo '<pre>';
		// var_dump($elements);
		// echo '</pre>';
		// exit;

	// // document.querySelector("#cheatsheet > section.ch-section.ch-section_css > div.ch-section__content > section:nth-child(1) > dl:nth-child(2) > dt")
	// foreach ($selectors as $key => $selector) {

	// 	// $elements = $html->find($selector);

	// 	// $data = ($elements->text()) ? sanitize_text_field($elements->text()) : '-';

	// 	// $data_array[] = $elements->text();
	// }

	return $data_array;
}
