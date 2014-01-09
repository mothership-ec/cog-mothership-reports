<?php

namespace UniformWares\Reports\Bootstrap;

use Message\Cog\Event\SubscriberInterface;
use Message\Cog\Event\Event;
use Message\Cog\Event\EventListener as BaseListener;
use Message\Mothership\ControlPanel\Event\BuildMenuEvent;

/**
 * Event listener.
 *
 * @author Laurence Roberts <laurence@message.co.uk>
 */
class EventListener extends BaseListener implements SubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			BuildMenuEvent::BUILD_MAIN_MENU => array(
				'registerMainMenuItems'
			),
		);
	}

	public function registerMainMenuItems(BuildMenuEvent $event)
	{
		$event->addItem('ms.commerce.report.dashboard', 'Reports', array('ms.report'));
	}
}