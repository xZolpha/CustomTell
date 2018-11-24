<?php
/**
 * Created by PhpStorm.
 * User: Zolpha#0001
 * Date: 24-Nov-18
 * Time: 2:29 PM
 */

namespace CustomTell;

use pocketmine\command\COmmandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;

class Main extends PluginCommand{

	public function onEnable() {
		$this->getServer()->getPluginManager->registerEvents($this, $this);
	}

	public static $lastMessaged = [];
	private $plugin;

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
		if(empty($args[1]));
		$sender->sendMessage(TextFormat::RED . "Please use /tell <player> <message>");
		return false;
}
	if(($player = $this->plugin->getServer()->getPlayer($args[0])) == null){
		$sender->sendMessage(TextFormat::RED . "Sorry, my database couldn't find that players name. Please try again");
		return false;
}
	if(!player->hasMessagesEnabled()){
		$sender->sendMessage(TextFormat::RED . "Sorry, this player has messages disabled");
		return false;
}
	$sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::GREEN . "me" . TextFormat::GRAY . " -> " . TextFormat::AQUA . "$player->getname()" . TextFormat::DARK_GRAY . "] " . TextFormat::GRAY . $this->getMessage($args));
	$player->sendMessage(TextFormat::DARK_GRAY . " [" . TextFormat::GREEN . $sender->getName() . TextFormat::GRAY . " -> " . TextFormat::AQUA . "me" . TextFormat::DARK_GRAY . "] " . TextFormat::GRAY . $this->getMessage($args));
	self::$lastMessaged[$sender->getName()] = $player->getName();
	self::$lastMessaged[$player->getName()] = $sender->getName();
	return true;
}
	public function getMessage(array $args): string{
	unset($args[]);
	return implode(" ", $args);
}
