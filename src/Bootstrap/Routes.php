<?php

namespace UniformWares\Reports\Bootstrap;

use Message\Cog\Bootstrap\RoutesInterface;
use Message\Cog\Service\Container as ServiceContainer;

class Routes implements RoutesInterface
{

	public function registerRoutes($router)
	{
		// Create the Uniform Wares reports route collection
		$router['ms.report']->setParent('ms.cp')->setPrefix('/report');

		$router['ms.report']->add('ms.commerce.report.dashboard', '', 'UniformWares:Reports::Controller:Report:Dashboard#index');
		$router['ms.report']->add('ms.commerce.report.view', '/view/{slug}', 'UniformWares:Reports::Controller:Report:View#index')
			->setRequirement('slug', '[A-Za-z\-]+');
	}

}