<?php
namespace MsgTelegram;

use OpenAiHandler\OpenAIHandler;
use TelegramOpenAI;

class MsgTelegram extends TelegramOpenAI {
    private static int     $chat_id;
    private static string  $prompt;
    private static int     $token;

    public static function initialize($chat_id, $prompt, $token = 300){
        self::$chat_id  = $chat_id;
        self::$prompt   = $prompt;
        self::$token    = $token;
        self::reply_to_telegram_message();
    }

    private static function send_telegram_message($wnswer) {
        self::$telegram->sendMessage(self::$chat_id, $wnswer);
    }

    private static function reply_to_telegram_message() {
        OpenAIHandler::initialize(self::$openai_key);
        // ...
        $answer = OpenAIHandler::prepare(
            "U".self::$chat_id,
            self::$prompt,
            self::$token
        );
        
        if(!empty($answer)){
            self::send_telegram_message($answer);
        }
    }
}


