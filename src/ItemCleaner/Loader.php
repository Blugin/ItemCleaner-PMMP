<?php

namespace ItemCleaner;

use pocketmine\plugin\PluginBase;

use ItemCleaner\Task\CheckTask;

class Loader extends PluginBase{
	/** @var string */
	public $prefix = '§d[ §fCleaner §d]§f ';

	public function onEnable(): void {
		$this->saveDefaultConfig();
		$this->reloadConfig();
		
		$this->getScheduler()->scheduleRepeatingTask(new CheckTask($this), 20 * 60);
	}
}
