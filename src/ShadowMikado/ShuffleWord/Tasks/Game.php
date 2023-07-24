<?php

namespace ShadowMikado\ShuffleWord\Tasks;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use ShadowMikado\ShuffleWord\Main;

class Game extends Task
{
    public function onRun(): void
    {
        $words = Main::$config->get("words");
        $word = $words[array_rand($words)];
        Main::$word = $word;
        $broadcast = Main::$config->get("broadcast");
        $broadcast = str_replace("{word}", str_shuffle($word), $broadcast);
        Server::getInstance()->broadcastMessage($broadcast);
    }
}
