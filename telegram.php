<?php
require_once "vendor/autoload.php";
require_once "OpenAiHandler.php";

use OpenAiHandler\OpenAIHandler;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;
use TelegramBot\Api\Types\Message;
session_start();
class TelegramOpenAI {
    private $telegram;
    private $openai_key;

    public function __construct($openai_key, $telegram_key) {
        $this->openai_key = $openai_key;
        $this->telegram = new BotApi($telegram_key);
    }

    private function send_telegram_message($chat_id, $text) {
        $this->telegram->sendMessage($chat_id, $text);
    }

    private function reply_to_telegram_message(Message $message) {
        OpenAIHandler::initialize($this->openai_key);
        // ...
        $answer = OpenAIHandler::prepare(
            "U".$message->getFrom()->getId(),
            $message->getText(),
            ["/ia", "/ai"],
            ["?", "!"]
        );
        if(!empty($answer)){
            $this->send_telegram_message($message->getChat()->getId(), $answer);
            $debug = [
                "firstName" => $message->getFrom()->getFirstName(),
                "text" => $message->getText(),
                "response" => $answer
            ];
            echo "\n\n\n";
            echo $debug["firstName"].": ".$debug["text"];
            echo "\n↓\n↓\n→";
            echo "response: ".$debug["response"];
        }else{
            echo "\n.....comndo errado......\n";
        }
    } 

    public function run() {
        $last_update_id = 0;
        while (true) {
            $updates = $this->telegram->getUpdates(['offset' => $last_update_id + 1]);
            foreach ($updates as $update) {
                $last_update_id = $update->getUpdateId();
                if ($update instanceof Update && $update->getMessage() !== null) {
                    $message = $update->getMessage();
                    if($message->getText()){
                        $this->reply_to_telegram_message($message);
                    }
                }
            }
            sleep(1);
        }
    }
}

$bot = new TelegramOpenAI(
    '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',
    '5801896630:AAEKquKfl0YQGJdPway7NNYAu8YjmllS6mY'
);
$bot->run();

