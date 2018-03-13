<?php

require_once "vendor/autoload.php";
require_once "parsers.php";
$token = "564648331:AAESJurFm1Ail3NVtXz8gs85mEvyf_807D8";

$bot = new \TelegramBot\Api\Client($token);

// команда для start
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(),$answer);
});

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = "List of commands:\n\n/danbooru [picNumber] - top images for today from danbooru\n\n/reddit [picNumber] [topic] - top images for today in the given topic";
    $bot->sendMessage($message->getChat()->getId(),$answer);
});

$bot->command('danbooru', function ($message) use ($bot) {
    $param = str_replace('/danbooru ', '', $message->getText());
    if ($param == '/danbooru') {
    	$answer = "Specify number of pics to show\nafter the command: ex.: /danbooru 5\ntype /help danbooru for more info";
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	parseDanbooru($bot,$message->getChat()->getId(),$param);
	}
});

$bot->command('reddit', function ($message) use ($bot) {
	$params = str_replace('/reddit ', '', $message->getText());
    if ($params == '/reddit') {
    	$answer = "Specify number of pics to show and topic\nafter the command: ex.: /reddit 5 memes\ntype /help reddit for more info";
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	$paramsList = explode(" ", $params);
    	if (count($paramsList) == 2) {
    		if(!is_numeric($paramsList[0])) {
    			$answer = "Specify number of pics to show and topic\nafter the command: ex.: /reddit 5 memes\ntype /help reddit for more info";
    			$bot->sendMessage($message->getChat()->getId(),$answer);
    		} else {
    			$picsNumber = intval($paramsList[0]);
    			$topic = $paramsList[1];
				parseReddit($bot,$message->getChat()->getId(),$picsNumber,$topic);
			}
    	} else {
    		$answer = "Specify number of pics to show and topic\nafter the command: ex.: /reddit 5 memes\ntype /help reddit for more info";
    		$bot->sendMessage($message->getChat()->getId(),$answer);
    	}
	}
});


$bot->run();

?>