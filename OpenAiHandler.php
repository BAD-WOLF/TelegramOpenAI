<?php
namespace OpenAiHandler;

require_once "vendor/autoload.php";
require_once "./PromptProcessor.php";

use Orhanerday\OpenAi\OpenAi;
use \PromptProcessor\PromptProcessor;

class OpenAIHandler
{
    private static $openai;
    private static $model;
    private static $users_array = [];

    public static function initialize($openai_key)
    {
        self::$openai = new OpenAi($openai_key);
        self::$model = "gpt-3.5-turbo";
    }

    public static function prepare(
        string $user,
        string $prompt,
        string|array $marking = "/ia",
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
            $_SESSION[$user][] = [
                "role" => "user",
                "content" => $prompt
            ];
            

            $max_tokens = $conclusion_length * 2;
            $response = self::$openai->chat([
                'model' => self::$model,
                'messages' => $_SESSION[$user],
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
}

