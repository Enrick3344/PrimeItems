<?php

namespace PrimeItems;

use PrimeItems\EventListener;
use pocketmine\item\Item;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\level\Level;
use pocketmine\network\mcpe\protocol\PacketPool;
use xenialdan\customui\API as UIAPI;
use xenialdan\customui\elements\Button;
use xenialdan\customui\elements\Label;
use xenialdan\customui\network\ModalFormRequestPacket;
use xenialdan\customui\network\ModalFormResponsePacket;
use xenialdan\customui\windows\ModalWindow;
use xenialdan\customui\windows\SimpleForm;
use xenialdan\customui\windows\CustomForm;

class Main extends PluginBase{

	/** @var int[] **/
	public static $uis = [];
  
    public function onEnable(){
            $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
            PacketPool::registerPacket(new ModalFormRequestPacket());
	    PacketPool::registerPacket(new ModalFormResponsePacket());
	    $this->reloadUIs();
    }
    
    public function reloadUIs(){
        $ui = new SimpleForm('Hit the servers to join');
        $button = new Button('Skyblocks');
        $button->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button);
        $button1 = new Button('Skyblocks2');
        $button1->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button1);
        $button2 = new Button('Prison');
        $button2->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button2);
        $button3 = new Button('Factions');
        $button3->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button3);
        $button4 = new Button('Survival');
        $button4->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button4);
        $button5 = new Button('Creative');
        $button5->addImage(Button::IMAGE_TYPE_URL, 'https://rx3jpw-dm2306.files.1drv.com/y4mUaFXVkso1vjImbApDJoRFp5Gwhi1Zq4PiJH0y0lmsaM0D1m3PTRvQQZjezmlUpUGd73foCJ0QHsw1o8-OYGtXZbu8WlmZ1Ke7JAfx_GXJ_EuFfWYPnm-GKAUsfPjem7Znf5j4Anf5C6i-U-K0dE4FW833I4bwUyqDtUHQde9aZ228s6HikoI1xN5yt5HtEZXZEPcjBZoQJDbtM_gctk510etJafc65n8JN7CgJoHw88/Logo2.jpg?psid=1');
        $ui->addButton($button5);
        self::$uis['serversUI'] = UIAPI::addUI($this, $ui);
    }
}
