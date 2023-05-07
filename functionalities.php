<?php

namespace Functionalities;
require_once "MsgTelegram.php";

use MsgTelegram\MsgTelegram;

class Functionalities {
    private static int     $chat_id;
    private static string  $prompt;
    private static string  $marking;

    public static function initialize(int $chat_id, string $prompt, string $marking){
        self::$chat_id = $chat_id;
        self::$prompt    = $prompt;
        self::$marking = $marking;
        self::DirectionTo();
    }

    private static function DirectionTo(){
        switch (self::$marking) {
            case '/msg':
                MsgTelegram::initialize(self::$chat_id, self::$prompt, 300);
                break;
            
            default:
                # code...
                break;
        }
    }
}
