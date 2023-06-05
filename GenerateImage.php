<?php
namespace GenerateImage;

use Orhanerday\OpenAi\OpenAi;
use TelegramOpenAI;

class GenerateImage {

    private OpenAi $open_ai;
    private string $prompt;

    public function __construct($array_obj){
        $this->open_ai = new OpenAi($array_obj["openai_key"]);
        $this->prompt = $array_obj["prompt"];
    }

    public function Generate(){
        $complete = $this->open_ai->image([
            "prompt" => $this->getPrompt(),
            "n" => 2,
            "size" => "256x256",
            "response_format" => "url",
        ]);
        return json_decode($complete, true)["data"][0]["url"];
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
     * @return GenerateImage
     */
    public function setPrompt(string $prompt): GenerateImage
    {
        $this->prompt = $prompt;
        return $this;
    }
}
?>
