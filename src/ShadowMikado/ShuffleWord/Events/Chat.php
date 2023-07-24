<?php

namespace ShadowMikado\ShuffleWord\Events;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Server;
use ShadowMikado\ShuffleWord\Main;

class Chat implements Listener
{
    public function PlayerChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $message = $event->getMessage();
        if (Main::$word !== "") {
            if ($message === Main::$word) {
                $broadcast = Main::$config->get("broadcast_win");
                $broadcast = str_replace(["{player}", "{word}"], [$player->getName(), Main::$word], $broadcast);
                Server::getInstance()->broadcastMessage($broadcast);
                foreach (Main::$config->get("rewards") as $command) {
                    $command = str_replace("{player}", $player->getName(), $command);
                    var_dump($command);
                    Server::getInstance()->getCommandMap()->dispatch(new ConsoleCommandSender(Main::getInstance()->getServer(), Server::getInstance()->getLanguage()), $command);
                }
                Main::$word = "";
            }
        }
    }
}
