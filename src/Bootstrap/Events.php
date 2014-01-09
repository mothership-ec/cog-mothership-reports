<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Mothership\ControlPanel\Event\BuildMenuEvent;

use Message\Cog\Bootstrap\EventsInterface;

class Events implements EventsInterface
{
	public function registerEvents($dispatcher)
	{
		$dispatcher->addListener(BuildMenuEvent::BUILD_MAIN_MENU, function(BuildMenuEvent $event) {
			$event->addItem('ms.commerce.report.dashboard', 'Reports', array('ms.report'));
		});
	}
}