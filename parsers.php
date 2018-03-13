<?php

function parseDanbooru($bot,$chatID,$posts) {
	$doc = new DOMDocument();
	//$doc->loadHTMLFile('https://danbooru.donmai.us/explore/posts/popular');
	$doc->loadHTMLFile('https://danbooru.donmai.us/');
	$links = array();
	foreach($doc->getElementsByTagName('a') as $link) {
		if (substr($link->getAttribute('href'),0,7) == '/posts/') {
			if ($posts > 0) {
				array_push($links,$link->getAttribute('href'));
				$posts--;
			} else {
					break;
			}
		}
	}
	foreach($links as $href) {
		$doc2 = new DOMDocument();
		$doc2->loadHTMLFile('https://danbooru.donmai.us'.$href);
		foreach($doc2->getElementsByTagName('img') as $link) {
			if (!strpos($link->getAttribute('src'), 'preview')) {
				$bot->sendPhoto($chatID,'https://danbooru.donmai.us'.$link->getAttribute('src'));
			}
		}
	}
}

function parseReddit($bot,$chatID,$posts,$topic,$order) {
	$doc = new DOMDocument();
	$doc->loadHTMLFile('https://www.reddit.com/r/'.$topic.'/'.$order.'/');
	$links = array(); 
		foreach($doc->getElementsByTagName('a') as $link) {
			if (strcmp($link->getAttribute('rel'),'nofollow next') == 0) {
				break;
			}
			if (strcmp($link->getAttribute('class'),'thumbnail invisible-when-pinned may-blank ') == 0 || 
					strcmp($link->getAttribute('class'),'thumbnail invisible-when-pinned may-blank outbound') == 0) {
				if ($posts > 0) {
					array_push($links,$link->getAttribute('href'));
					$posts--;
				} else {
					break;
				}
			}
		}
		foreach($links as $href) {
			if (substr($href,0,5) == 'https') {
				if (strpos($href, '.img') !== false) {
					$bot->sendPhoto($chatID,$href);
				}
				else if (strpos($href,'.gif') !== false) {
					$bot->sendDocument($chatID,$href);
				} else {
					$bot->sendMessage($chatID,$href);
				}
			} else {
				$caption = 'https://www.reddit.com'.$href;
				$doc2 = new DOMDocument();
				$doc2->loadHTMLFile('https://www.reddit.com'.$href);
				foreach($doc2->getElementsByTagName('a') as $link) {
					if ($link->getAttribute('class') == 'thumbnail invisible-when-pinned may-blank outbound') {
						$bot->sendPhoto($chatID,$link->getAttribute('href'),$caption);
						break;
					}
				}
			}
		}
	}

?>