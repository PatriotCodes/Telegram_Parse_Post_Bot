<?php

require_once "vendor/autoload.php";
require_once "parsers.php"
$token = "564648331:AAESJurFm1Ail3NVtXz8gs85mEvyf_807D8";

$bot = new \TelegramBot\Api\Client($token);
// команда для start
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - вывод справки';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

$bot->command('pic', function ($message) use ($bot) {
    $answer = parseDanbooru();
    $bot->sendPhoto($message->getChat()->getId(), $answer);
});

$bot->run();

?>