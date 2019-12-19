<?php

namespace net\battlemc\gitport;

use net\battlemc\gitport\classes\GitRepository;
use net\battlemc\gitport\task\AsyncGitPublisherTask;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;

class GitPort extends PluginBase
{
	public const BASE_PATH = "https://github.com/TobiasG-DE/BattleMC-{name}/releases/latest/download/{name}.phar";
	public static $AUTH_KEY = "";

	public function onEnable()
	{
		if (!file_exists($this->getDataFolder() . "config.yml")) $this->saveResource("config.yml");
		$config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		self::$AUTH_KEY = $config->get("username") . ":" . $config->get("api_key");
		$repos = [];
		foreach ($config->get("repositories") as $repo) {
			$repos[] = new GitRepository($repo);
		}
		$this->getServer()->getAsyncPool()->submitTask(new AsyncGitPublisherTask($repos, self::$AUTH_KEY, $this->getServer()->getDataPath() . "plugins/"));

	}
}