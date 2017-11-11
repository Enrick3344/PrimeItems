<?php
namespace PrimeItems;

use pocketmine\item\Item;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\player\Inventory;
use pocketmine\inventory\BaseInventory;
use jojoe77777\FormAPI;
use PrimeItems\Main;

class EventListener implements Listener {

    /** @var Main */
    private $plugin;

    /**
     * @param Main $plugin
     */
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onServerMenu($player) {
        $api = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI");
        if ($api === null || $api->isDisabled()) {
        }
        $form = $api->createSimpleForm(function (Player $player, array $data) {
            $result = $data[0];
            if ($result === null) {
            }
            switch ($result) {
                case 1:
                    //SkyBlock
                    $player->transfer("skyblock.primegames.in", 19132);
                break;
                case 2:
                    //Prison
                    $player->transfer("play.primegames.in", 19135);
                break;
                case 3:
                    //Factions
                    $player->transfer("play.primegames.in", 19138);
                break;
                case 4:
                    //Survival
                    $player->transfer("play.primegames.in", 19136);
                break;
                case 5:
                    //Creative
                    $player->transfer("play.primegames.in", 19137);
                break;
            }
        });
        $form->setTitle("Server List");
        $form->setContent("Choose a Server from the list below to transfer there!");
        $form->addButton("Cancel");
        $form->addButton("SkyBlock", 1, "https://i.imgur.com/G4YNcfX.jpg");
        $form->addButton("Prison", 2, "https://i.imgur.com/G4YNcfX.jpg");
        $form->addButton("Factions", 3, "https://i.imgur.com/G4YNcfX.jpg");
        $form->addButton("Survival", 4, "https://i.imgur.com/G4YNcfX.jpg");
        $form->addButton("Creative", 5, "https://i.imgur.com/G4YNcfX.jpg");
        $form->sendToPlayer($player);
    }
}
