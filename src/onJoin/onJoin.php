<?php

namespace onJoin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use onJoin\onJoinTask;
use pocketmine\utils\TextFormat;

class onJoin extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getServer()->getLogger()->info("onJoin has been Enabled by QuiverlyRivalry");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->configmakerthingy();
        $this->saveDefaultConfig();
        $this->reloadConfig();
    }

    public function onDisable() : void{
        $this->getServer()->getLogger()->alert(TextFormat::RED . "Oh sh*t, plugin is disabled, can we get a R.I.P in the chat.");
    }

    public function configmakerthingy() : void{
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $this->getServer()->getScheduler()->scheduleDelayedTask(new onJoinTask($this, $player), 40);
    }
}
