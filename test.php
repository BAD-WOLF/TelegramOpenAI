
<?php
require_once "vendor/autoload.php";
require_once "OpenAiHandler.php";
require_once "functionalities.php";

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TelegramOpenAI {
    private static $telegram;
    private static $chat_id;

    public static function initializeAll($telegram_key) {
        self::$telegram = new BotApi($telegram_key);
        $updates = self::$telegram->getUpdates();
        foreach ($updates as $update) {
            $message = $update->getMessage();
            if($message->getText()){
                self::$chat_id = $message->getFrom()->getId();
            }
            print_r(self::$chat_id);
        }
    }
}

TelegramOpenAI::initializeAll('s5801896630:AAEKquKfl0YQGJdPway7NNYAu8YjmllS6mY');

