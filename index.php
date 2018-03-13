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
    $param = str_replace('/danbooru ', '', $message->getText());
    if ($param == '/danbooru') {
    	$answer = 'Specify number of pics to show\nafter the command: ex.: /danbooru 5\ntype /help danbooru for more info';
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	parseDanbooru($bot,$message->getChat()->getId(),$param);
	}
});

$bot->command('reddit', function ($message) use ($bot) {
	$param = str_replace('/reddit ', '', $message->getText());
    if ($param == '/reddit') {
    	$answer = 'Specify number of pics to show 
    after command: ex.: /reddit 5';
    	$bot->sendMessage($message->getChat()->getId(),$answer);
    } else {
    	parseReddit($bot,$message->getChat()->getId(),$param);
	}
});


$bot->run();

?>