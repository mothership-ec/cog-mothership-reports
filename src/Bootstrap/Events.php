<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Mothership\ControlPanel\Event\BuildMenuEvent;
use Message\Mothership\Report;
use Message\Cog\Bootstrap\EventsInterface;

class Events implements EventsInterface
{
	public function registerEvents($dispatcher)
	{
		$dispatcher->addSubscriber(new Report\Event\EventListener);
	}
}