<?php

require_once "bot.php";
require_once "parsers.php";

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
    parseDanbooru($bot,$message->getChat()->getId());
});

$bot->run();

?>