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
            $p[] = "•––––––––––––––––––––––––––––––––––––-––-––•";
            $p[] = "•                TELEGRAM                  •";
            $p[] = "•__________________________________________•";
            $p[] = "| real time:     |".date("Y-m-d H:i")."     ";
            $p[] = "|-------------------------------------------";
            $p[] = "| first Name:    |".self::$firstName."      ";
            $p[] = "|-------------------------------------------";
            $p[] = "| user name:     |".self::$username."       ";
            $p[] = "|-------------------------------------------";
            $p[] = "| language Code: |".self::$languageCode."   ";
            $p[] = "|-------------------------------------------";
            $p[] = "| from Id:       |".self::$fromId."         ";
            $p[] = "|-------------------------------------------";
            $p[] = "| chat Id:       |".self::$chatId."         ";
            $p[] = "|-------------------------------------------";
            $p[] = "| marking:       |".self::$marking."        ";
            $p[] = "|-------------------------------------------";
            $p[] = "| prompt:        |".self::$prompt."         ";
            $p[] = "|-------------------------------------------";
            $p[] = "| response:      |".self::$response."       ";
            $p[] = "|-------------------------------------------";
            foreach ($p as $key => $value) {
                self::printCenteredText($value);
            }
    }

    private static function printCenteredText($text) {
        $larguraTela = shell_exec('tput cols');
        $espacosAntes = (int)ceil(($larguraTela - strlen($text)) / 2);

        print str_repeat(' ', $espacosAntes) . $text . PHP_EOL;
    }


}

?>
