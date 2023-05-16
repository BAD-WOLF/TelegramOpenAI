<?php
namespace Functionalities;

require_once "reply_telegram.php";
require_once "ShowOnTerminal.php";

use ReplyTelegram\ReplyTelegram;
use TelegramBot\Api\Types\Update;
use TerminalTelegram\TerminalTelegram;

class Functionalities {
    private static int     $chat_id;
    private static string  $prompt;
    private static Update  $update;
    private static string  $marking;
    private static string|null $response;

    public static function initialize(int $chat_id, string $prompt, Update $update, string $marking){
        self::$chat_id = $chat_id;
        self::$prompt  = $prompt;
        self::$update  = $update;
        self::$marking = $marking;
        self::DirectionTo();
    }

    private static function DirectionTo(){
        $reply = new ReplyTelegram();
        $reply::initialize(self::$chat_id, self::$prompt);
        switch (self::$marking) {
            case '/msg':
                self::$response =  $reply::reply_to_telegram_message();
                break;

            case '/imgg':
                self::$response = $reply::reply_to_telegram_photo();
                break;
        }
        # default
        if(empty(self::$response)){
            self::$response = "por algum motivo, não teve resposta!!";
        }
        TerminalTelegram::initialize(self::$update, self::$marking, self::$prompt, self::$response);
    }
}
