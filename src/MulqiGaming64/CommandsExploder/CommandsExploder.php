<?php

namespace MulqiGaming64\CommandsExploder;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\console\ConsoleCommandSender;

class CommandsExploder extends PluginBase implements Listener {
	
    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onExecuteCommand(CommandEvent $ev){
		$command = $ev->getCommand();
		$exp = explode(" && ", $command);
		$sender = $ev->getSender();
		if(!$sender->hasPermission("commandsexploder.use")) return;
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
