<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\ServicesInterface;

use Message\Mothership\Report\Report;

class Services implements ServicesInterface
{
	public function registerServices($services)
	{
		$services['report.collection'] = function($c) {
			return new Report\Collection;
		};
	}
}