<?php
require_once __DIR__ . '/vendor/autoload.php';

use TelegramBot\Api\BotApi;

// substitua <seu token aqui> pelo token do seu bot
$token = '5801896630:AAEKquKfl0YQGJdPway7NNYAu8YjmllS6mY';

// crie uma instância do objeto BotApi
$bot = new BotApi($token);

// utilize o método getUpdates para obter as atualizações mais recentes
$updates = $bot->getUpdates();

// percorra todas as atualizações e verifique se o chat é um grupo
$groups = [];
foreach ($updates as $update) {
    $chat = $update->getMessage()->getChat();
    if ($chat->getType() == 'group') {
        $groups[] = $chat->getTitle();
    }
}

// imprima os nomes dos grupos
echo "Meu bot está presente nos seguintes grupos:\n";
foreach ($groups as $group) {
    echo "- " . $group . "\n";
}
?>
