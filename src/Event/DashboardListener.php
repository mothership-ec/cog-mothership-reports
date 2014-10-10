<?php

namespace Message\Mothership\Report\Event;

use Message\Cog\Event\SubscriberInterface;
use Message\Cog\Event\EventListener as BaseListener;
use Message\Mothership\ControlPanel\Event\Event as CPEvent;

/**
 * Dashboard event listener.
 *
 * @author Laurence Roberts <laurence@message.co.uk>
 */
class DashboardListener extends BaseListener implements SubscriberInterface
{

	/**
	 * {@inheritdoc}
	 */
	static public function getSubscribedEvents()
	{
		return array(
			CPEvent::BUILD_MAIN_MENU => array(
				'buildDashboardIndex',
			),
		);
	}

	public function buildDashboardIndex(CPEvent $event)
	{
		$event->addItem('ms.report.dashboard', 'Reports');
	}
}