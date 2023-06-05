<?php
namespace OpenAiHandler;

require_once "vendor/autoload.php";
require_once "./PromptProcessor.php";

use Orhanerday\OpenAi\OpenAi;

class OpenAIHandler
{
    private string $prompt;
    private OpenAi $openai;
    private string $model;

    public function __construct($array_obj)
    {
        $this->setOpenai(new OpenAi($array_obj["openai_key"]));
        $this->setPrompt($array_obj["prompt"]);
        $this->setModel("gpt-3.5-turbo");
    }

    public function prepare(
        string $user,
        int $conclusion_length = 100
    ){
        try {
            
            $messages = [];

            // Adiciona a mensagem do usuário em questão
            
            // Adiciona a mensagem do sistema
            /*
             $_SESSION[$u] = [
                "role" => "system",
                "content" => "you are a scientist."
             ];
             */
            $_CHAT[$user][] = [
                "role" => "user",
                "content" => $this->getPrompt()
            ];


            $max_tokens = $conclusion_length * 2;
            $response = $this->openai->chat([
                'model' => $this->getModel(),
                'messages' => $_CHAT[$user],
                'max_tokens' => $max_tokens,
                'n' => 1,
                'temperature' => 0,
                'presence_penalty' => 1,
                'frequency_penalty' => 1,
                'top_p' => 1
            ]);
            
            
        
            // Extrai o texto gerado e remove a parte do prompt
            $r = json_decode($response, true);
            if(empty($r["choices"])){
                return "Sorry, I couldn't understand your question. Please try again.";
            }
            if(!empty($r["error"])){
                return 'Sorry, there was an error processing your question. Please try again later.';
            }else{
                $text = $r["choices"][0]["message"]["content"];
                if (in_array(substr($text, 0, 1), [".",","])) {
                    $text = str_replace(substr($text, 0, 1), "", $text);
                }
                $messages[] = $r["choices"][0]["message"];
                return $text;
            }

        } catch (\Throwable $e) {
            echo $e->getMessage();
            return 'Sorry, there was an error processing your question. Please try again later.';
        }
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
     * @return OpenAiHandler
     */
    public function setPrompt(string $prompt): OpenAiHandler
    {
        $this->prompt = $prompt;
        return $this;
    }

    /**
     * Gets the value of model
     *
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * Sets the value of model
     *
     * @param string $model description
     *
     * @return OpenAiHandler
     */
    public function setModel(string $model): OpenAiHandler
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Gets the value of openai
     *
     * @return OpenAi
     */
    public function getOpenai(): OpenAi
    {
        return $this->openai;
    }

    /**
     * Sets the value of openai
     *
     * @param OpenAi $openai description
     *
     * @return OpenAiHandler
     */
    public function setOpenai(OpenAi $openai): OpenAiHandler
    {
        $this->openai = $openai;
        return $this;
    }
}

