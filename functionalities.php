<?php
namespace Functionalities;

require_once "reply_telegram.php";

use ReplyTelegram\ReplyTelegram;

class Functionalities {
    private static int     $chat_id;
    private static string  $prompt;
    private static string  $marking;

    public static function initialize(int $chat_id, string $prompt, string $marking){
        self::$chat_id = $chat_id;
        self::$prompt  = $prompt;
        self::$marking = $marking;
        self::DirectionTo();
    }

    private static function DirectionTo(){
        $reply = new ReplyTelegram();
        $reply::initialize(self::$chat_id, self::$prompt);
        switch (self::$marking) {
            case '/msg':
                $reply::reply_to_telegram_message();
                break;

            case '/imgg':
                $reply::reply_to_telegram_photo();
                break;
            
            default:
                # code...
                break;
        }
    }
}
