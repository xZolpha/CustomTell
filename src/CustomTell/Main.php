<?php
/**
 * Created by PhpStorm.
 * User: Zolpha#0001
 * Date: 24-Nov-18
 */

namespace CustomTell;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as R;

class Main extends PluginBase implements Listener {


	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public static $lastMessaged = [];
	public $plugin;

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
		if(empty($args[1])){
			if(!$sender instanceof Player) return false;
			$sender->sendMessage(R::RED . "Please use /tell <player> <message>");
			return false;
		}
		if(($player = $this->plugin->getServer()->getPlayer($args[0])) == null){
			$sender->sendMessage(R::RED . "Sorry, my database couldn't find that players name. Please try again");
			return false;
		}
		if(!$player->hasMessagesEnabled()){
			$sender->sendMessage(R::RED . "Sorry, this player has messages disabled");
			return false;
		}
		$sender->sendMessage(R::DARK_GRAY . "[" . R::GREEN . "me" . R::GRAY . " -> " . R::AQUA . "$player->getname()" . R::DARK_GRAY . "] " . R::GRAY . $this->getMessage($args));
		$player->sendMessage(R::DARK_GRAY . " [" . R::GREEN . $sender->getName() . R::GRAY . " -> " . R::AQUA . "me" . R::DARK_GRAY . "] " . R::GRAY . $this->getMessage($args));
		self::$lastMessaged[$sender->getName()] = $player->getName();
		self::$lastMessaged[$player->getName()] = $sender->getName();
		return true;
	}

	public function getMessage(array $args): string{
		return implode(" ", $args);
	}
}