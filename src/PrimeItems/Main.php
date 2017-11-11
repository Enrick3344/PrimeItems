<?php

namespace PrimeItems;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
  
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("servers", new ServerCommand($this));
    }
}
