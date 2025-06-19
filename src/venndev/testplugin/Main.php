<?php

declare(strict_types=1);

namespace venndev\testplugin;

use Generator;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use venndev\vosaka\VOsaka;
use venndev\vosakactpmmp\VOsakaComeToPMMP;

class Main extends PluginBase implements Listener
{
    
    protected function onLoad(): void
    {
        VOsakaComeToPMMP::init($this);
    }

    protected function onEnable(): void
    {
        $this->getLogger()->info("TestPlugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable(): void
    {
        $this->getLogger()->info("TestPlugin has been disabled!");
    }

    public function work(): Generator
    {
        $this->getLogger()->info("TestPlugin is working!");
        yield from VOsaka::sleep(5); // Simulate some work being done
        $this->getLogger()->info("TestPlugin has finished working!");
    }

    public function onBreak(BlockBreakEvent $e): void {
        VOsaka::spawn($this->work());
        VOsaka::run();
    }
}
