<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\ServicesInterface;

use Message\Cog\ValueObject\Collection;

class Services implements ServicesInterface
{
	public function registerServices($services)
	{
		$services['report.collection'] = function($c) {
			return new Collection;
		};
	}
}