<?php

function parseDanbooru($posts) {
	return $posts;
	// $doc = new DOMDocument();
	// $doc->loadHTMLFile('https://danbooru.donmai.us/explore/posts/popular');
	// $links = array();
	// foreach($doc->getElementsByTagName('a') as $link) {
	// 	if (substr($link->getAttribute('href'),0,7) == '/posts/') {
	// 		if ($posts > 0) {
	// 			array_push($links,$link->getAttribute('href'));
	// 			$posts--;
	// 		} else {
	// 				break;
	// 		}
	// 	}
	// }
	// $hrefs = array();
	// foreach($links as $href) {
	// 	$doc2 = new DOMDocument();
	// 	$doc2->loadHTMLFile('https://danbooru.donmai.us'.$href);
	// 	foreach($doc2->getElementsByTagName('img') as $link) {
	// 		if (!strpos($link->getAttribute('src'), 'preview')) {
	// 			array_push($hrefs,('https://danbooru.donmai.us'.$link->getAttribute('src')));
	// 		}
	// 	}
	// }
	// return $hrefs
}

?>