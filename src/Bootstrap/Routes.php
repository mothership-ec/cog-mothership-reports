<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\RoutesInterface;

class Routes implements RoutesInterface
{
	public function registerRoutes($router)
	{
		$router['ms.report']->setParent('ms.cp')->setPrefix('/report');

		$router['ms.report']->add('ms.report.dashboard', '', 'Message:Mothership:Report::Controller:Report:Dashboard#index');
		$router['ms.report']->add('ms.report.view', '/view/{slug}', 'Message:Mothership:Report::Controller:Report:View#index')
			->setRequirement('slug', '[A-Za-z\-]+');
	}
}