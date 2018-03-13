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
    $answer = 'Команды:
/help - вывод справки';
    $bot->sendMessage($message->getChat()->getId(),$answer);
});

$bot->command('danbooru', function ($message) use ($bot) {
    $bot->sendMessage($message->getChat()->getId(),$param);
    if ($param == '/danbooru') {
    	$answer = 'Specify number of pics
    	to show after command:
    	ex.: /danooru 5';
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	parseDanbooru($bot,$message->getChat()->getId(),$param);
	}
});

$bot->command('reddit', function ($message) use ($bot) {
    parseReddit($bot,$message->getChat()->getId(),20);
});


$bot->run();

?>