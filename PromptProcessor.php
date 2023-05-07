<?php
namespace PromptProcessor;

class PromptProcessor {
    public static function process(string $prompt) {

        $startWithMarker = self::startWith($prompt);

        if ($startWithMarker) {
            return [
                "prompt" => trim(str_replace($startWithMarker, '', $prompt)),
                "marking" => $startWithMarker
            ];
        }

        /*
          if (strtolower($prompt) === 'hello') {
            $punctuationMarks = ['!', '?'];
            return $prompt . $punctuationMarks[array_rand($punctuationMarks)];
        }

        return ;
         */
    }

    private static function startWith($prompt){
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

?>
