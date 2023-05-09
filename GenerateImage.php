<?php
namespace GenerateImage;

use Orhanerday\OpenAi\OpenAi;
use TelegramOpenAI;

class GenerateImage extends TelegramOpenAI {
    private static OpenAi $open_ai;
    private static string $prompt;
    public static function initialieze($prompt){
        self::$open_ai = new OpenAi(self::$openai_key);
        self::$prompt  = $prompt;
        return self::Generate();
    }

    private static function Generate(){
        $complete = self::$open_ai->image([
            "prompt" => self::$prompt,
            "n" => 2,
            "size" => "256x256",
            "response_format" => "url",
        ]);
        return json_decode($complete, true)["data"][1]["url"];
    }
}
?>
