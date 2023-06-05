<?php
require_once "vendor/autoload.php";

$token = '5801896630:AAENUPJKfqp_8PtuE64RRkkPiWz9y2CFcKI';

$bot = new \TelegramBot\Api\Client($token);
$bot->deleteMessage(
    -1001683013397
    ,9676
);
?>
