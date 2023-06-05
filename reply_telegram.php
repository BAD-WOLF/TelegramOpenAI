<?php
namespace ReplyTelegram;

require_once "GenerateImage.php";

use GenerateImage\GenerateImage;
use OpenAiHandler\OpenAIHandler;
use TelegramBot\Api\BotApi;
use TelegramOpenAI;

class ReplyTelegram {

    private BotApi $telegram;
    private OpenAiHandler $OpenAiHandler;
    private int $chat_id;
    private string $openai_key;
    private GenerateImage $photo;
    private string $prompt;
    private int $token;

    public function __construct(array $array_obj, int $token = 300){
        $this->setToken($token);
        $this->setTelegram($array_obj["telegram"]);
        $this->setOpenAiHandler(new OpenAIHandler($array_obj));
        $this->setChat_id($array_obj["chat_id"]);
        $this->setOpenai_key($array_obj["openai_key"]);
        $this->setPhoto(new GenerateImage($array_obj));
        $this->setPrompt($array_obj["prompt"]);
        
    }

    // .............................SEND REPLY TELEGRAM................................

    private function send_telegram_message($wnswer): void {
        $this->getTelegram()->sendMessage($this->getChat_id(), $wnswer);
    }

    private function send_photo_telegram($photo): void {
        $this->getTelegram()->sendPhoto($this->getChat_id(), $photo);
    }

    // .............................MAKE REPLY TELEGRAM................................

    public function reply_to_telegram_message(): string {
        // ...
        $answer = $this->getOpenAiHandler()->prepare("U".$this->getChat_id(), $this->token);
        
        if(!empty($answer)){
            $this->send_telegram_message($answer);
            return $answer;
        }
    }

    public function reply_to_telegram_photo(): string{
        $url = $this->getPhoto()->Generate();
        if($url){
            $this->send_photo_telegram($url);
            return $this->getPrompt();
        }else{
            $StdMsg = "deu algum erro aqui pra gerar sua imagem";
            $this->send_telegram_message($StdMsg);
            return $StdMsg;
        }
    }
    
    /**
     * Get telegram.
     *
     * @return telegram.
     */
    public function getTelegram()
    {
        return $this->telegram;
    }
    
    /**
     * Set telegram.
     *
     * @param telegram the value to set.
     */
    public function setTelegram($telegram)
    {
        $this->telegram = $telegram;
    }
    
    /**
     * Gets the value of OpenAiHandler
     *
     * @return OpenAiHandler
     */
    public function getOpenAiHandler(): OpenAiHandler
    {
        return $this->OpenAiHandler;
    }

    /**
     * Sets the value of OpenAiHandler
     *
     * @param OpenAiHandler $OpenAiHandler description
     *
     * @return ReplyTelegram
     */
    public function setOpenAiHandler(OpenAiHandler $OpenAiHandler): ReplyTelegram
    {
        $this->OpenAiHandler = $OpenAiHandler;
        return $this;
    }
    
    /**
     * Get chat_id.
     *
     * @return chat_id.
     */
    public function getChat_id()
    {
        return $this->chat_id;
    }
    
    /**
     * Set chat_id.
     *
     * @param chat_id the value to set.
     */
    public function setChat_id($chat_id)
    {
        $this->chat_id = $chat_id;
    }
     
     /**
      * Get openai_key.
      *
      * @return openai_key.
      */
     public function getOpenai_key()
     {
         return $this->openai_key;
     }
     
     /**
      * Set openai_key.
      *
      * @param openai_key the value to set.
      */
     public function setOpenai_key($openai_key)
     {
         $this->openai_key = $openai_key;
     }
    
    /**
     * Get photo.
     *
     * @return photo.
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    /**
     * Set photo.
     *
     * @param photo the value to set.
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    
    /**
     * Get token.
     *
     * @return token.
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * Set token.
     *
     * @param token the value to set.
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
     
     /**
      * Get prompt.
      *
      * @return prompt.
      */
     public function getPrompt()
     {
         return $this->prompt;
     }
     
     /**
      * Set prompt.
      *
      * @param prompt the value to set.
      */
     public function setPrompt($prompt)
     {
         $this->prompt = $prompt;
     }
}


