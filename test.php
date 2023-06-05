<?php

use TelegramBot\Api\BotApi;

require_once "vendor/autoload.php";

$bot = new BotApi('5801896630:AAENUPJKfqp_8PtuE64RRkkPiWz9y2CFcKI');

print_r($update = $bot->getUpdates(-1));

$cahtId = $update[0]->getMessage()
                    ->getChat()
                    ->getId();

print_r($update[0]->getMessage()
                    ->getText());

print "......\n";

print_r($cahtId);
?>
