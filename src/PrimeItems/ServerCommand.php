<?php 

namespace PrimeItems;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class ServerCommand extends Command{

    /** @var Main */
    private $plugin;
    /**
     * @param Main $plugin
    */
    
    public function __construct(Main $plugin){
        parent::__construct("servers", "Display the Servers Menu", null, ["server"]);
        $this->setPermission("primeitems.server");
        $this->plugin = $plugin;
    }
    
    public function execute(CommandSender $sender, string $label, array $args) : bool{
        $player = $sender;
        if(!($sender instanceof Player)){
            $sender->sendMessage("§5>§c Please run this command in-game.");
            return true;
        }
        $this->getListener()->onServerMenu($player);
    }
    
    public function getListener(){
        return new EventListener($this);
    }
}
