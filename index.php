<?php

require_once "vendor/autoload.php";
require_once "parsers.php";
$token = "564648331:AAESJurFm1Ail3NVtXz8gs85mEvyf_807D8";

$bot = new \TelegramBot\Api\Client($token);

// команда для start
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Greetings! You can always type /help if you feel frustrated.';
    $bot->sendMessage($message->getChat()->getId(),$answer);
});

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = "List of commands:\nparameters in square brackets are obligatory! For more info on each command type:\n/help [command]\n\n/danbooru [picNumber] (popular) (date) - top images for today from danbooru\n\n/reddit [picNumber] [topic] (order) - top images for today in the given topic";
    $bot->sendMessage($message->getChat()->getId(),$answer);
});

$bot->command('danbooru', function ($message) use ($bot) {
    $param = str_replace('/danbooru ', '', $message->getText());
    $answer = "Specify number of pics to show\nafter the command: ex.: /danbooru 5\ntype /help danbooru for more info";
    if ($param == '/danbooru') {
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	parseDanbooru($bot,$message->getChat()->getId(),$param);
	}
});

$bot->command('reddit', function ($message) use ($bot) {
	$params = str_replace('/reddit ', '', $message->getText());
	$answer = "Specify number of pics to show and\ntopic, after the command:\n(you can specify order if you wish)\nex.: /reddit 5 memes top\ntype /help reddit for more info";
    if ($params == '/reddit') {
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	$paramsList = explode(" ", $params);
    	if (count($paramsList) > 1) {
    		if(!is_numeric($paramsList[0])) {
    			$bot->sendMessage($message->getChat()->getId(),$answer);
    		} else {
    			$picsNumber = intval($paramsList[0]);
    			if ($picsNumber > 20) {
    				$picsNumber = 20;
    				$bot->sendMessage($message->getChat()->getId(),'Max picsNumber is 20! Set to max.');
    			}
    			$topic = $paramsList[1];
    			$order = 'new';
    			if (count($paramsList) > 2) {
    				$order = $paramsList[2];
    			}
				parseReddit($bot,$message->getChat()->getId(),$picsNumber,$topic,$order);
			}
    	} else {
    		$bot->sendMessage($message->getChat()->getId(),$answer);
    	}
	}
});


$bot->run();

?>