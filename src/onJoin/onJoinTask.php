<?php

namespace onJoin;

use onJoin\onJoin;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class onJoinTask extends PluginTask{

    private $plugin;
    private $player;

    public function __construct(onJoin $plugin, Player $player){
        parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->player = $player;
    }

    public function onRun(int $currentTick){
        $player = $this->player;
        $this->mainForm($player);
    }

    public function mainForm($player) : void{
        $servername = $this->plugin->getConfig()->get("ServerName");
        $content = $this->plugin->getConfig()->get("Content");
        $button1 = $this->plugin->getConfig()->get("Button1");
        $button2 = $this->plugin->getConfig()->get("Button2");
        $form = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI")->createModalForm(function (Player $player, array $data){
            if($data[0] == true){
                // button 1 pressed
                return true;
            }
            return true;

        });
        $form->setTitle(TextFormat::BOLD . TextFormat::WHITE . "Welcome to " . $servername);
        $form->setContent($content);
        $form->setButton1($button1);
        $form->setButton2($button2);
        $form->sendToPlayer($player);
    }
}
