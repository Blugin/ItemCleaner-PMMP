<?php

namespace ItemCleaner\Task;

use pocketmine\entity\Creature;
use pocketmine\entity\Human;

use pocketmine\scheduler\Task;

use ItemCleaner\Loader;

class CheckTask extends Task{

    /** @var Loader */
    private $owner;

    /** @var int */
    private $time;

    public function __construct(Loader $owner){
        $this->owner = $owner;
        $this->time = $this->owner->db['config']['time'];
    }
    public function onRun(int $currentTick){
        if ($this->time != 0){
            $this->owner->getServer()->broadcastMessage($this->owner->prefix . 'Items will be removed after §d' . --$this->time . '§f minute.');
        }else{
			$entityCount = 0;
            foreach ($this->owner->getServer()->getLevels() as $levels){
                foreach($levels->getEntities() as $entities){
                    if (!$entities instanceof Creature && !$entities instanceof Human){
                        $entities->close();
                        ++$entityCount;
                    }
                }
            }
            $this->owner->getServer()->broadcastMessage($this->owner->prefix . '§d' . $entityCount . ' §fItems have been deleted.');
            $this->time = $this->owner->db['config']['time'];
        }
    }
}
