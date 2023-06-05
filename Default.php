<?php
#namespace TelegramOpenAI\Default;
namespace Telegram\Defaultt;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

/**
* Class Default
* @author yourname
*/
class ProcessDefault
{
    // [forumTopicCreated:protected] => oq ta abaixo vem da qui!!
    // [isTopicMessage:protected] => 1
    // [messageThreadId:protected] => 2397
    private Update $update;
    private int    $chat_id;
    private int    $messageId;
    private string $prompt;
    private BotApi $telegram;
    public function __construct(array $array_obj)
    {
        $this->update = $array_obj["update"];
        $this->chat_id = $array_obj["chat_id"];
        $this->messageId = $array_obj["messageId"];
        $this->prompt = $array_obj["prompt"];
        $this->telegram = $array_obj["telegram"];
        print "\nconstruct \n";
    }

    public function delet_link_in_general_chat()
    {
        print "dentro da funcao\n";
        if($this->is_link_hackers()){
            print "dentro do if\n";
            if (!$topic = $this->is_topic()) {
                print "dentro do outro if\n";
                $this->getTelegram()->deleteMessage(
                    $this->getChat_id(),
                    $this->getMessageId()
                );
            }
        }else{
            print "cau no else ...";
            $topic = $this->is_topic();
            print $topic;
            if($topic == 2397 || $topic == 3679){
                print "se chegou aq fudeu ...";
                $this->getTelegram()->deleteMessage(
                    $this->getChat_id(),
                    $this->getMessageId()
                );
            }
        }
    }
    


    private function is_link_hackers()
    {
        /*print_r([
             'is_link_hackers'=>$this->is_link_hackers()
            ,'$this->getPrompt()'=>$this->getPrompt()
        ]);die;*/
        $link = "https://link.hackersthegame.com";
        if(stripos($this->getPrompt(), $link) !== false){
            return true;
        }else{
            return false;
        }
    }

    private function is_topic()
    {
        if($topic = $this->getUpdate()->getMessage()->getMessageThreadId()){
            return $topic;
        }else{
            return false;
        }
    }

    /**
     * Gets the value of update
     *
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->update;
    }

    /**
     * Sets the value of update
     *
     * @param Update $update description
     *
     * @return ProcessDefault
     */
    public function setUpdate(Update $update): ProcessDefault
    {
        $this->update = $update;
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
     * @return ProcessDefault
     */
    public function setChat_id(int $chat_id): ProcessDefault
    {
        $this->chat_id = $chat_id;
        return $this;
    }

    /**
     * Gets the value of messageId
     *
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * Sets the value of messageId
     *
     * @param int $messageId description
     *
     * @return ProcessDefault
     */
    public function setMessageId(int $messageId): ProcessDefault
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
     * @return ProcessDefault
     */
    public function setPrompt(string $prompt): ProcessDefault
    {
        $this->prompt = $prompt;
        return $this;
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
     * @return ProcessDefault
     */
    public function setTelegram(BotApi $telegram): ProcessDefault
    {
        $this->telegram = $telegram;
        return $this;
    }

}
print "\n".__FILE__."\n";
?>
