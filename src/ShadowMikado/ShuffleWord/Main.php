<?php

namespace ShadowMikado\ShuffleWord;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use ShadowMikado\ShuffleWord\Events\Chat;
use ShadowMikado\ShuffleWord\Tasks\Game;

class Main extends PluginBase implements Listener
{
    use SingletonTrait;

    public static Config $config;

    public static $word = "";

    public function onLoad(): void
    {
        $this->saveDefaultConfig();
        self::$config = $this->getConfig();
        self::setInstance($this);
    }

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new Chat, $this);
        $this->getScheduler()->scheduleRepeatingTask(new Game, 20 * self::$config->get("timer"));
    }
}
