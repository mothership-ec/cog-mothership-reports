<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\RoutesInterface;

class Routes implements RoutesInterface
{
	public function registerRoutes($router)
	{
		$router['ms.report']->setParent('ms.cp')->setPrefix('/report');

		$router['ms.report']->add('ms.commerce.report.dashboard', '', 'UniformWares:Reports::Controller:Report:Dashboard#index');
		$router['ms.report']->add('ms.commerce.report.view', '/view/{slug}', 'UniformWares:Reports::Controller:Report:View#index')
			->setRequirement('slug', '[A-Za-z\-]+');
	}
}