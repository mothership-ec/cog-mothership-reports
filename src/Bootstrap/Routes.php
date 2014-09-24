<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\RoutesInterface;

class Routes implements RoutesInterface
{
	public function registerRoutes($router)
	{
		$router['ms.report']->setParent('ms.cp')->setPrefix('/report');




	}
}