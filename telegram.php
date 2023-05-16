<?php
require_once "vendor/autoload.php";
require_once "OpenAiHandler.php";
require_once "functionalities.php";

use Functionalities\Functionalities;
use PromptProcessor\PromptProcessor;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TelegramOpenAI {
    protected static BotApi $telegram;
    protected static Update $Update;
    protected static string $openai_key;
    private   static int    $chat_id;
    private   static string $prompt;
    private   static string $marking;


    public static function initializeAll($openai_key, $telegram_key) {
        self::$telegram = new BotApi($telegram_key);
        self::$openai_key = $openai_key;
    }


    public static function run() {
        $last_update_id = 0;
        while (true) {
            $updates = self::$telegram->getUpdates(['offset' => $last_update_id + 1]);
            foreach ($updates as $update) {
                self::$Update = $update;
                $last_update_id = $update->getUpdateId();
                if ($update instanceof Update && $update->getMessage() !== null) {
                    self::$Update = $update;
                    $message = $update->getMessage();
                    if($message->getText()){
                        self::$chat_id = $message->getChat()->getId();
                        if(PromptProcessor::process($message->getText())){
                        self::$prompt  = PromptProcessor::process($message->getText())["prompt"];
                        self::$marking = PromptProcessor::process($message->getText())["marking"];
                        Functionalities::initialize(self::$chat_id, self::$prompt, self::$Update, self::$marking);
                        }
                    }
                }
            }
            sleep(1);
        }
    }
}

TelegramOpenAI::initializeAll(
    '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',
    '5801896630:AAEKquKfl0YQGJdPway7NNYAu8YjmllS6mY'
);
TelegramOpenAI::run();

