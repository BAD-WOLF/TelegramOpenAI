<?php
namespace TerminalTelegram;

require_once "telegram.php";

use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class TerminalTelegram {
    private static Message $stts;
    private static string  $firstName;
    private static string  $username;
    private static string  $languageCode;
    private static int     $fromId;
    private static int     $chatId;
    private static string  $marking;
    private static string  $prompt;
    private static string  $response;

    public static function initialize(Update $update, string $marking, string $prompt, string $response){
        self::$stts         = $update->getMessage();
        self::$firstName    = self::$stts->getFrom()->getFirstName();
        self::$username     = self::$stts->getFrom()->getUsername();
        self::$languageCode = self::$stts->getFrom()->getLanguageCode();
        self::$fromId       = self::$stts->getFrom()->getId();
        self::$chatId       = self::$stts->getChat()->getId();
        self::$marking      = $marking;
        self::$prompt       = $prompt;
        self::$response     = $response;
        self::ShowStts();
    }

    private static function ShowStts(){
        // if(php_uname("s") == "Linux"){
        //     system("clear");
        // }
        date_default_timezone_set('America/Bahia');
        print "\n____________________________________________";
        print "\n| real time:     |".date("Y-m-d H:i")."     ";
        print "\n| first Name:    |".self::$firstName."      ";
        print "\n| user name:     |".self::$username."       ";
        print "\n| language Code: |".self::$languageCode."   ";
        print "\n| from Id:       |".self::$fromId."         ";
        print "\n| chat Id:       |".self::$chatId."         ";
        print "\n| marking:       |".self::$marking."        ";
        print "\n| prompt:        |".self::$prompt."         ";
        print "\n| response:      |".self::$response."       ";
        print "\n__________________________________________";
    }

}

?>
