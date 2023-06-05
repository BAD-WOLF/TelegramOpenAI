<?php
namespace Functionalities;

require_once "Default.php";
require_once "reply_telegram.php";
require_once "ShowOnTerminal.php";

use ReplyTelegram\ReplyTelegram;
use Telegram\Defaultt\ProcessDefault;
use TerminalTelegram\TerminalTelegram;

class Functionalities {

    private ProcessDefault $Default;
    private string $marking;
    private ReplyTelegram $reply;
    private string|null $response;
    private $prompt;

    public function __construct($array_obj){
        $this->setPrompt($array_obj["prompt"]);
        $this->setDefault(new ProcessDefault($array_obj));
        $this->setReply(new ReplyTelegram($array_obj));
        $this->DirectionTo();
    }

    private function DirectionTo(){
        $this->setMarking($this->startWith($this->prompt));
        
        switch ($this->getMarking()) {
            case '/msg':{
                $this->response = $this->getReply()->reply_to_telegram_message();
                break;
            }

            case '/imgg':{
                $this->response = $this->getReply()->reply_to_telegram_photo();
                break;
            }

            default:{
                print("entrou no defalut\n");
                break;
            }
            print "oi";
        }
        
        # Default ....
        $this->getDefault()->delet_link_in_general_chat();

        if(empty($this->response)){
            $this->response = "por algum motivo, não teve resposta!!";
        }else{
            print("lululululul");
        }
        // TerminalTelegram::initialize($obj);
    }

    /**
     * Gets the value of reply
     *
     * @return ReplyTelegram
     */
    public function getReply(): ReplyTelegram
    {
        return $this->reply;
    }

    /**
     * Sets the value of reply
     *
     * @param ReplyTelegram $reply description
     *
     * @return Functionalities
     */
    public function setReply(ReplyTelegram $reply): Functionalities
    {
        $this->reply = $reply;
        return $this;
    }

    /**
     * Gets the value of Default
     *
     * @return ProcessDefault
     */
    public function getDefault(): ProcessDefault
    {
        return $this->Default;
    }

    /**
     * Sets the value of Default
     *
     * @param ProcessDefault $Default description
     *
     * @return Functionalities
     */
    public function setDefault(ProcessDefault $Default): Functionalities
    {
        $this->Default = $Default;
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
     * @return Functionalities
     */
    public function setMarking(string $marking): Functionalities
    {
        $this->marking = $marking;
        return $this;
    }

     /**
     * Gets the value of marking
     *
     * @return string
     */
    public function getPromt(): string
    {
        return $this->prompt;
    }

    /**
     * Sets the value of setPromt
     *
     * @param string $setPromt description
     *
     * @return Functionalities
     */
    public function setPrompt(string $prompt): Functionalities
    {
        $this->prompt = $prompt;
        return $this;
    }

    private  function startWith($prompt){
        // Verifica se a prompt começa com uma barra
        if(substr($prompt, 0, 1) === '/'){
            // Extrai a palavra que vem depois da barra
            $palavra = substr($prompt, 0, strpos($prompt, ' '));
            return $palavra;
        }else{
            return false;
        }
    }
}
