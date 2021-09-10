<?php

namespace MulqiGaming64\CommandsExploder;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\server\CommandEvent;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class CommandsExploder extends PluginBase implements Listener {
	
    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onExecuteCommand(CommandEvent $ev){
		$command = $ev->getCommand();
		$exp = explode(" && ", $command);
		$sender = $ev->getSender();
		if($sender instanceof Player){
			$ev->setCommand($exp[0]);
			unset($exp[0]);
			foreach($exp as $cmd){
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
			}
			return true;
		} else {
			$ev->setCommand($exp[0]);
			unset($exp[0]);
			foreach($exp as $cmd){
				$this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender(), $cmd);
			}
			return true;
		}
	}
}
