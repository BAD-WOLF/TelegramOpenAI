<?php
namespace PromptProcessor;

class PromptProcessor {
    public function process(string $prompt) {

        $startWithMarker = $this->startWith($prompt);

        if ($startWithMarker) {
            return [
                "prompt" => trim(str_replace($startWithMarker, '', $prompt)),
                "marking" => $startWithMarker
            ];
        }

    }

    private function startWith($prompt){
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
