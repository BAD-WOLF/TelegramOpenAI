<?php
namespace ReplyTelegram;

require_once "GenerateImage.php";

use GenerateImage\GenerateImage;
use OpenAiHandler\OpenAIHandler;
use TelegramOpenAI;

class ReplyTelegram extends TelegramOpenAI {
    private static int     $chat_id;
    private static string  $prompt;
    private static int     $token;

    public static function initialize($chat_id, $prompt, $token = 300){
        self::$chat_id  = $chat_id;
        self::$prompt   = $prompt;
        self::$token    = $token;
    }

    // .............................SEND REPLY TELEGRAM................................

    private static function send_telegram_message($wnswer): void {
        self::$telegram->sendMessage(self::$chat_id, $wnswer);
    }

    private static function send_photo_telegram($photo): void {
        self::$telegram->sendPhoto(self::$chat_id, $photo);
    }

    // .............................MAKE REPLY TELEGRAM................................

    public static function reply_to_telegram_message(): string {
        OpenAIHandler::initialize(self::$openai_key);
        // ...
        $answer = OpenAIHandler::prepare(
            "U".self::$chat_id,
            self::$prompt,
            self::$token
        );
        
        if(!empty($answer)){
            self::send_telegram_message($answer);
            return $answer;
        }
    }

    public static function reply_to_telegram_photo(): string{
        $url = GenerateImage::initialieze(self::$prompt);
        if($url){
            self::send_photo_telegram($url);
            return self::$prompt;
        }else{
            $StdMsg = "deu algum erro aqui pra gerar sua imagem";
            self::send_telegram_message($StdMsg);
            return $StdMsg;
        }
    }
}


