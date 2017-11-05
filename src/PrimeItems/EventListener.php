<?php

namespace PrimeItems;

use pocketmine\item\Item;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use xenialdan\customui\API;
use xenialdan\customui\API as UIAPI;
use xenialdan\customui\event\UICloseEvent;
use xenialdan\customui\event\UIDataReceiveEvent;
use xenialdan\customui\network\ModalFormResponsePacket;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\player\Inventory;
use pocketmine\inventory\BaseInventory;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use PrimeItems\Main;

class EventListener implements Listener{
	
	/** @var Main */
	private $plugin;
	
       /**
       * @param Main $plugin
       */
	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
	}
  
  public function onJoin(PlayerJoinEvent $event){
      $player = $event->getPlayer();
      $name = $player->getName();
      $item = Item::fromString(369);
      $air = Item::fromString(0);
      $player->getInventory()->setItem(4, $air);
      $event->getPlayer()->getInventory()->setItem(4, $item->setCustomName("§aServers\n§7Hit to open menu"));
  }
  
  public function onRespawn(PlayerRespawnEvent $event){
      $player = $event->getPlayer();
		  $name = $player->getName();
		  $player->getInventory()->clearAll();
		  $item = Item::fromString(369);
      $event->getPlayer()->getInventory()->setItem(4, $item->setCustomName("§aServers\n§7Hit to open menu"));
      $player->sendMessage("§e>§b Default Items Added Back!");
  }
  
  public function onInteract(PlayerInteractEvent $event) {
      $item = $event->getItem();
	  	$player = $event->getPlayer();
		  $name = $player->getName();
      if($item->getName() === "§aServers\n§7Hit to open menu" && ($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR || $event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK)) {
			    UIAPI::showUIbyID($this->getPlugin(), Main::$uis['serversUI'], $player);
			    return false;
		  }
   }
   
   /**
	 * @return Plugin
	 */
	public final function getPlugin(){
		return $this->plugin;
	}
	
	/**
	 * @return Main
	 */
	public function getMain(): Main {
		return $this->plugin;
	}
  
  /**
	 * @group UI Response Handling
	 * @param DataPacketReceiveEvent $ev
	 */
	public function onPacket(DataPacketReceiveEvent $event){
		$packet = $event->getPacket();
		$player = $event->getPlayer();
		switch ($packet::NETWORK_ID){
			case ModalFormResponsePacket::NETWORK_ID: {
				/** @var ModalFormResponsePacket $packet */
				$this->handleModalFormResponse($packet, $player);
				$packet->reset();
				$event->setCancelled(true);
				break;
			}
		}
	}
  
  /**
	 * @group UI Response Handling
	 * @param ModalFormResponsePacket $packet
	 * @param Player $player
	 * @return bool
	 */
	public function handleModalFormResponse(ModalFormResponsePacket $packet, Player $player): bool{
		$ev = new UIDataReceiveEvent($this->plugin, $packet, $player);
		if (is_null($ev->getData())) $ev = new UICloseEvent($this->plugin, $packet, $player);
		Server::getInstance()->getPluginManager()->callEvent($ev);
		return true;
	}
  
/**
	* @param UIDataReceiveEvent $event
	*/
	public function onUIDataReceiveEvent(UIDataReceiveEvent $event){
      if($event->getPlugin() !== $this->plugin) return;
		switch ($id = $event->getID()){
            case Main::$uis['serversUI']: {
				$player = $event->getPlayer();
				$server = $this->plugin->getServer();
				$data = $event->getData();
				$ui = UIAPI::getPluginUI($this->plugin, $id);
				$response = $ui->handle($data, $event->getPlayer());
				switch ($event->getData()){
					case 0: {
						$ip = "skyblock.primegames.in";
						$port = "19132";
						$event->getPlayer()->transfer($ip, $port);
						break;
					}
					case 1: {
						$ip = "play.primegames.in";
						$port = "19135";
						$event->getPlayer()->transfer($ip, $port);
						break;
					}
					case 2: {
						$ip = "play.primegames.in";
						$port = "19138";
						$event->getPlayer()->transfer($ip, $port);
						break;
					}
					case 3: {
						          $ip = "play.primegames.in";
						          $port = "19136";
						          $event->getPlayer()->transfer($ip, $port);
						          break;
					}
					case 4: {
						$ip = "play.primegames.in";
						$port = "19137";
						$event->getPlayer()->transfer($ip, $port);
						break;
					}
				}
				break;
			}	
        }
	}
}
