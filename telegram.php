<?php
// require_once "vendor/autoload.php";
require_once "OpenAiHandler.php";
require_once "functionalities.php";

use Functionalities\Functionalities;
use PromptProcessor\PromptProcessor;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TelegramOpenAI {
    private BotApi $telegram;
    private Update $Update;
    private string $openai_key;
    private int    $chat_id;
    private int    $messageId;
    private string $prompt;
    private string $marking;

    public function __construct($openai_key, $telegram_key) {
        $this->telegram = new BotApi($telegram_key);
        $this->openai_key = $openai_key;
    }


    public function Srun() {
       
        $last_update_id = 0;
        while (true) {
            try {
            $updates = $this->telegram->getUpdates(['offset' => $last_update_id + 1]);
            foreach ($updates as $update) {
                $this->Update = $update;
                $last_update_id = $update->getUpdateId();
                if ($update instanceof Update && $update->getMessage() !== null) {
                    $this->Update = $update;
                    $message = $update->getMessage();
                    
                    if($message->getText()){
                        $this->chat_id = $message->getChat()->getId();
                        //$PromptProcessor = new PromptProcessor();
                        
                            $this->setPrompt($message->getText());
                            //$this->setMarking($PromptProcessor->process($message->getText())["marking"]);
                            $this->setMessageId($message->getMessageId());
                            $ARRAY_GLOBAL["telegram"]   = $this->telegram;
                            $ARRAY_GLOBAL["update"]     = $this->Update;
                            $ARRAY_GLOBAL["openai_key"] = $this->openai_key;
                            $ARRAY_GLOBAL["chat_id"]    = $this->chat_id;
                            $ARRAY_GLOBAL["messageId"]  = $this->messageId;
                            $ARRAY_GLOBAL["prompt"]     = $this->prompt;
                            // print_r($ARRAY_GLOBAL);die('ii');
                            new Functionalities($ARRAY_GLOBAL);
                        
                    }
                }
            }
            sleep(1);
            } catch(\Throwable $e){
                print_r(".....\n");
                $this->run();
            }
        }
    }

    public function run()
    {
        while (true) {
            try {
                $this->Srun();
            } catch (\Throwable $th) {
                $this->Srun();
            }
        }
    }

    /**
     * Gets the value of telegram
     *
     * @return BotApi
     */
    public function getTelegram(): BotApi
    {
        return $this->telegram;
    }

    /**
     * Sets the value of telegram
     *
     * @param BotApi $telegram description
     *
     * @return TelegramOpenAI
     */
    public function setTelegram(BotApi $telegram): TelegramOpenAI
    {
        $this->telegram = $telegram;
        return $this;
    }

    /**
     * Gets the value of Update
     *
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->Update;
    }

    /**
     * Sets the value of Update
     *
     * @param Update $Update description
     *
     * @return TelegramOpenAI
     */

    public function setUpdate(Update $Update): TelegramOpenAI
    {
        $this->Update = $Update;
        return $this;
    }

    /**
     * Gets the value of openai_key
     *
     * @return string
     */
    public function getOpenai_key(): string
    {
        return $this->openai_key;
    }

    /**
     * Sets the value of openai_key
     *
     * @param string $openai_key description
     *
     * @return  TelegramOpenAI
     */
    public function setOpenai_key(string $openai_key): TelegramOpenAI
    {
        $this->openai_key = $openai_key;
        return $this;
    }

    /**
     * Gets the value of chat_id
     *
     * @return int
     */
    public function getChat_id(): int
    {
        return $this->chat_id;
    }

    /**
     * Sets the value of chat_id
     *
     * @param int $chat_id description
     *
     * @return TelegramOpenAI
     */
    public function setChat_id(int $chat_id): TelegramOpenAI
    {
        $this->chat_id = $chat_id;
        return $this;
    }

    /**
     * Gets the value of messageId
     *
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * Sets the value of messageId
     *
     * @param string $messageId description
     *
     * @return TelegramOpenAI
     */
    public function setMessageId(string $messageId): TelegramOpenAI
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Gets the value of prompt
     *
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * Sets the value of prompt
     *
     * @param string $prompt description
     *
     * @return TelegramOpenAI
     */
    public function setPrompt(string $prompt): TelegramOpenAI
    {
        $this->prompt = $prompt;
        return $this;
    }

    /**
     * Gets the value of marking
     *
     * @return string
     */
    public function getMarking(): string
    {
        return $this->marking;
    }

    /**
     * Sets the value of marking
     *
     * @param string $marking description
     *
     * @return TelegramOpenAI
     */
    public function setMarking(string $marking): TelegramOpenAI
    {
        $this->marking = $marking;
        return $this;
    }

}

while (true) {
    try {
        $bot = new TelegramOpenAI(
            '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',
            '5801896630:AAENUPJKfqp_8PtuE64RRkkPiWz9y2CFcKI'
        );
        $bot->run();
    } catch (\Throwable $th) {
        $bot = new TelegramOpenAI(
            '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',
            '5801896630:AAENUPJKfqp_8PtuE64RRkkPiWz9y2CFcKI'
        );
        $bot->run();
    }
}

